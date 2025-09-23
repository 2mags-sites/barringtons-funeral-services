<?php
session_start();
require_once 'includes/env-loader.php';

// Check if env-loader works
echo "1. EnvLoader test:<br>";
echo "ADMIN_SECRET_KEY from env: " . (EnvLoader::get('ADMIN_SECRET_KEY') ? 'Found' : 'NOT FOUND') . "<br>";
echo "Actual value length: " . strlen(EnvLoader::get('ADMIN_SECRET_KEY')) . "<br><br>";

// Check session
echo "2. Session test:<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Session admin_mode: " . (isset($_SESSION['admin_mode']) ? $_SESSION['admin_mode'] : 'not set') . "<br><br>";

// Check GET parameter
echo "3. GET parameter test:<br>";
echo "admin param: " . (isset($_GET['admin']) ? $_GET['admin'] : 'not set') . "<br>";
echo "Expected: barringtons_2024_secure_admin_key_x7Kp9Lm3<br><br>";

// Test activation logic
if (isset($_GET['admin']) && $_GET['admin'] === EnvLoader::get('ADMIN_SECRET_KEY')) {
    echo "4. Admin activation: SHOULD WORK<br>";
    $_SESSION['admin_mode'] = true;
    echo "Session set to: " . $_SESSION['admin_mode'] . "<br>";
} else {
    echo "4. Admin activation: FAILED<br>";
    if (isset($_GET['admin'])) {
        echo "Keys don't match!<br>";
        echo "GET length: " . strlen($_GET['admin']) . "<br>";
        echo "ENV length: " . strlen(EnvLoader::get('ADMIN_SECRET_KEY')) . "<br>";
    }
}

// Check if .env file exists
echo "<br>5. File checks:<br>";
echo ".env exists: " . (file_exists('.env') ? 'YES' : 'NO') . "<br>";
echo ".env readable: " . (is_readable('.env') ? 'YES' : 'NO') . "<br>";

// Check current directory
echo "Current dir: " . getcwd() . "<br>";

// Try reading .env directly
echo "<br>6. Direct .env read test:<br>";
if (file_exists('.env') && is_readable('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, 'ADMIN_SECRET_KEY') === 0) {
            echo "Found line: " . substr($line, 0, 30) . "...<br>";
            break;
        }
    }
}

phpinfo();
?>