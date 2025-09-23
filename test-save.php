<?php
session_start();
require_once 'includes/admin-config.php';

header('Content-Type: text/plain');

echo "Test Save Endpoint\n";
echo "==================\n\n";

echo "1. Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "2. IS_ADMIN constant: " . (IS_ADMIN ? 'TRUE' : 'FALSE') . "\n";
echo "3. isAdminMode() function: " . (isAdminMode() ? 'TRUE' : 'FALSE') . "\n";
echo "4. Session admin_mode: " . (isset($_SESSION['admin_mode']) ? $_SESSION['admin_mode'] : 'not set') . "\n";
echo "5. Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "6. Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "7. Server Protocol: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'HTTPS' : 'HTTP') . "\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n8. POST Test: Can receive POST requests\n";
    $input = file_get_contents('php://input');
    echo "9. Raw input: " . substr($input, 0, 100) . "\n";
}

echo "\n10. Functions check:\n";
echo "  - isAdminMode: " . (function_exists('isAdminMode') ? 'exists' : 'missing') . "\n";
echo "  - loadContent: " . (function_exists('loadContent') ? 'exists' : 'missing') . "\n";
echo "  - saveContent: " . (function_exists('saveContent') ? 'exists' : 'missing') . "\n";
echo "  - validateCSRFToken: " . (function_exists('validateCSRFToken') ? 'exists' : 'missing') . "\n";
?>