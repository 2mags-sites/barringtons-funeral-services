<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/config.php';
require_once 'includes/email-service.php';

// Set JSON response header
header('Content-Type: application/json');

// Initialize response
$response = ['success' => false, 'message' => ''];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Check honeypot (anti-spam)
if (!empty($_POST['website'])) {
    $response['message'] = 'Spam detected.';
    echo json_encode($response);
    exit;
}

// Time-based validation (bots submit too fast)
if (isset($_POST['form_loaded_time'])) {
    $form_load_time = (int)$_POST['form_loaded_time'];
    $time_spent = time() - $form_load_time;

    if ($time_spent < 3) {
        $response['message'] = 'Form submitted too quickly. Please try again.';
        echo json_encode($response);
        exit;
    }
}

// Verify reCAPTCHA token
if (isset($_POST['recaptcha_token']) && !empty($_POST['recaptcha_token'])) {
    $recaptcha_token = $_POST['recaptcha_token'];
    $recaptcha_api_key = getenv('RECAPTCHA_API_KEY');
    $recaptcha_project_id = getenv('RECAPTCHA_PROJECT_ID');
    $recaptcha_site_key = getenv('RECAPTCHA_SITE_KEY');
    $min_score = (float)(getenv('RECAPTCHA_MIN_SCORE') ?: 0.5);

    // Verify with Google reCAPTCHA Enterprise API
    $assessment_url = "https://recaptchaenterprise.googleapis.com/v1/projects/{$recaptcha_project_id}/assessments?key={$recaptcha_api_key}";

    $assessment_data = [
        'event' => [
            'token' => $recaptcha_token,
            'siteKey' => $recaptcha_site_key,
            'expectedAction' => 'contact_form'
        ]
    ];

    $ch = curl_init($assessment_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($assessment_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $assessment_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        $assessment = json_decode($assessment_response, true);

        // Check if token is valid and score is above threshold
        if (isset($assessment['tokenProperties']['valid']) && $assessment['tokenProperties']['valid'] === true) {
            $score = $assessment['riskAnalysis']['score'] ?? 0;

            if ($score < $min_score) {
                $response['message'] = 'Security validation failed. Please try again.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Security validation failed. Please try again.';
            echo json_encode($response);
            exit;
        }
    }
}

// Verify CSRF token (skip in development for testing)
$skip_csrf = (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'localhost');

if (!$skip_csrf) {
    if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) ||
        $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
        $response['message'] = 'Security validation failed. Please refresh and try again.';
        echo json_encode($response);
        exit;
    }
} else {
    // In development, generate token if missing
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// Validate required fields
$required_fields = ['name', 'email', 'message', 'privacy_consent'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $response['message'] = 'Please fill in all required fields.';
        echo json_encode($response);
        exit;
    }
}

// Sanitize input
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'Please provide a valid email address.';
    echo json_encode($response);
    exit;
}

// Check for Cyrillic characters (common in Russian spam)
function hasCyrillic($text) {
    return preg_match('/[\x{0400}-\x{04FF}]/u', $text);
}

if (hasCyrillic($name) || hasCyrillic($message)) {
    $response['message'] = 'Invalid characters detected. Please use English characters only.';
    echo json_encode($response);
    exit;
}

// Check for excessive links (common spam pattern)
$link_count = preg_match_all('/(http|https|www\.)/i', $message);
if ($link_count > 2) {
    $response['message'] = 'Too many links detected. Please remove links from your message.';
    echo json_encode($response);
    exit;
}

// IP-based rate limiting (more effective than session-based)
$user_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$ip_rate_limit_file = __DIR__ . '/cache/rate_limit_' . md5($user_ip) . '.json';

// Create cache directory if it doesn't exist
if (!file_exists(__DIR__ . '/cache')) {
    mkdir(__DIR__ . '/cache', 0755, true);
}

// Load IP submission history
$ip_submissions = [];
if (file_exists($ip_rate_limit_file)) {
    $ip_submissions = json_decode(file_get_contents($ip_rate_limit_file), true) ?: [];
}

// Clean old submissions (older than 1 hour)
$ip_submissions = array_filter($ip_submissions, function($time) {
    return $time > (time() - 3600);
});

// Check if IP has exceeded rate limit (3 per hour)
if (count($ip_submissions) >= 3) {
    $response['message'] = 'Too many submissions from your IP address. Please try again later.';
    echo json_encode($response);
    exit;
}

// Also keep session-based rate limiting as backup
if (!isset($_SESSION['form_submissions'])) {
    $_SESSION['form_submissions'] = [];
}

$_SESSION['form_submissions'] = array_filter($_SESSION['form_submissions'], function($time) {
    return $time > (time() - 3600);
});

if (count($_SESSION['form_submissions']) >= 5) {
    $response['message'] = 'Too many submissions. Please try again later.';
    echo json_encode($response);
    exit;
}

// Prepare form data for email service
$formData = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message
];

// Initialize email service
$emailService = new EmailService();

// Send email using the email service (SendGrid with fallback to mail())
$result = $emailService->sendContactFormEmail($formData);

if ($result['success']) {
    // Log submission time for session-based rate limiting
    $_SESSION['form_submissions'][] = time();

    // Log submission time for IP-based rate limiting
    $ip_submissions[] = time();
    file_put_contents($ip_rate_limit_file, json_encode($ip_submissions));

    $response['success'] = true;
    $response['message'] = 'Thank you for your message. We will be in touch soon.';
} else {
    $response['message'] = 'Sorry, there was an error sending your message. Please call us directly on ' . SITE_PHONE . '.';
    error_log('Contact form email error: ' . $result['message']);
}

// Generate new CSRF token for next submission
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

echo json_encode($response);
?>