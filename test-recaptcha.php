<?php
/**
 * reCAPTCHA Configuration Test
 * This file helps diagnose reCAPTCHA setup issues
 */

require_once 'includes/env-loader.php';

header('Content-Type: application/json');

$test_results = [
    'env_file_exists' => file_exists(__DIR__ . '/.env'),
    'env_loaded' => EnvLoader::has('RECAPTCHA_API_KEY'),
    'credentials' => [
        'api_key' => getenv('RECAPTCHA_API_KEY') ? '✓ Set (hidden)' : '✗ Not set',
        'project_id' => getenv('RECAPTCHA_PROJECT_ID') ?: '✗ Not set',
        'site_key' => getenv('RECAPTCHA_SITE_KEY') ?: '✗ Not set',
        'min_score' => getenv('RECAPTCHA_MIN_SCORE') ?: '✗ Not set (default: 0.5)'
    ],
    'api_test' => null
];

// Test API connectivity if credentials are present
if (getenv('RECAPTCHA_API_KEY') && getenv('RECAPTCHA_PROJECT_ID')) {
    $project_id = getenv('RECAPTCHA_PROJECT_ID');
    $api_key = getenv('RECAPTCHA_API_KEY');

    // Try to list assessments (this will fail with permissions error but confirms API connectivity)
    $test_url = "https://recaptchaenterprise.googleapis.com/v1/projects/{$project_id}/keys?key={$api_key}";

    $ch = curl_init($test_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $test_results['api_test'] = [
        'http_code' => $http_code,
        'response' => json_decode($response, true),
        'status' => $http_code === 200 ? '✓ API accessible' :
                   ($http_code === 403 ? '⚠ API key may be invalid or lacks permissions' :
                   ($http_code === 404 ? '⚠ Project ID may be incorrect' :
                   '✗ API error'))
    ];
}

// Add helpful instructions
$test_results['instructions'] = [
    'step1' => 'Verify all credentials are set in .env file',
    'step2' => 'Check that the site key in footer.php matches RECAPTCHA_SITE_KEY',
    'step3' => 'Ensure the Google Cloud project "' . getenv('RECAPTCHA_PROJECT_ID') . '" has reCAPTCHA Enterprise API enabled',
    'step4' => 'Verify the API key has reCAPTCHA Enterprise API permissions',
    'step5' => 'Check error logs at /logs/error.log for reCAPTCHA validation errors'
];

echo json_encode($test_results, JSON_PRETTY_PRINT);
?>
