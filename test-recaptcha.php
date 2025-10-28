<?php
/**
 * reCAPTCHA v3 Configuration Test
 * This file helps diagnose reCAPTCHA setup issues
 */

require_once 'includes/env-loader.php';

header('Content-Type: application/json');

$test_results = [
    'api_version' => 'reCAPTCHA v3 (Standard)',
    'env_file_exists' => file_exists(__DIR__ . '/.env'),
    'env_loaded' => EnvLoader::has('RECAPTCHA_SECRET_KEY'),
    'credentials' => [
        'secret_key' => getenv('RECAPTCHA_SECRET_KEY') ? '✓ Set (hidden)' : '✗ Not set',
        'site_key' => getenv('RECAPTCHA_SITE_KEY') ?: '✗ Not set',
        'min_score' => getenv('RECAPTCHA_MIN_SCORE') ?: '0.5 (default)'
    ],
    'site_key_in_frontend' => '6LdFfe8rAAAAADYCyMduHW-J8ilM70S1wqk0x5kv',
    'configuration_status' => null
];

// Check configuration
$secret_key = getenv('RECAPTCHA_SECRET_KEY');
$site_key = getenv('RECAPTCHA_SITE_KEY');

if (empty($secret_key)) {
    $test_results['configuration_status'] = '✗ RECAPTCHA_SECRET_KEY not set in .env file';
    $test_results['action_required'] = 'Add RECAPTCHA_SECRET_KEY to your .env file. Get it from https://www.google.com/recaptcha/admin';
} elseif (empty($site_key)) {
    $test_results['configuration_status'] = '⚠ RECAPTCHA_SITE_KEY not set (using hardcoded key)';
    $test_results['action_required'] = 'Add RECAPTCHA_SITE_KEY to your .env file for consistency';
} else {
    $test_results['configuration_status'] = '✓ Configuration looks good';

    // Check if keys match
    if ($site_key !== $test_results['site_key_in_frontend']) {
        $test_results['warning'] = 'Site key in .env differs from hardcoded key in footer.php';
    }
}

// Add helpful instructions
$test_results['setup_instructions'] = [
    'step1' => 'Go to https://www.google.com/recaptcha/admin',
    'step2' => 'Register a new site with reCAPTCHA v3',
    'step3' => 'Add your domain: barringtonsfunerals.co.uk',
    'step4' => 'Copy the SECRET KEY and add it to .env as RECAPTCHA_SECRET_KEY',
    'step5' => 'Copy the SITE KEY and update footer.php (currently: 6LdFfe8rAAAAADYCyMduHW-J8ilM70S1wqk0x5kv)',
    'step6' => 'Test a form submission and check /logs/error.log for reCAPTCHA scores'
];

$test_results['important_notes'] = [
    'scoring' => 'reCAPTCHA v3 scores range from 0.0 (bot) to 1.0 (human)',
    'current_threshold' => 'Currently blocking scores below ' . (getenv('RECAPTCHA_MIN_SCORE') ?: '0.5'),
    'recommendation' => 'Monitor logs to see spam scores, then adjust threshold if needed',
    'logs_location' => '/logs/error.log - check for "reCAPTCHA submission" entries'
];

echo json_encode($test_results, JSON_PRETTY_PRINT);
?>
