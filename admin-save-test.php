<?php
// Simple test to check if POST requests work
header('Content-Type: text/plain');

echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST request received successfully!\n";
    echo "Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? 'not set') . "\n";
    echo "Raw input: " . file_get_contents('php://input') . "\n";
} else {
    echo "This endpoint expects POST requests.\n";
}
?>