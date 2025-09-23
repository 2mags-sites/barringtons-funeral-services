<?php
/**
 * Simple error logger for debugging
 */

class ErrorLogger {
    private static $logFile = __DIR__ . '/../logs/debug.log';

    public static function log($message, $context = []) {
        $logDir = dirname(self::$logFile);

        // Create logs directory if it doesn't exist
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] {$message}";

        if (!empty($context)) {
            $logEntry .= " | Context: " . json_encode($context, JSON_PRETTY_PRINT);
        }

        $logEntry .= "\n" . str_repeat('-', 80) . "\n";

        // Write to log file
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }

    public static function logRequest($script) {
        $data = [
            'script' => $script,
            'method' => $_SERVER['REQUEST_METHOD'],
            'uri' => $_SERVER['REQUEST_URI'],
            'query_string' => $_SERVER['QUERY_STRING'] ?? '',
            'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'not set',
            'referer' => $_SERVER['HTTP_REFERER'] ?? 'not set',
            'session' => isset($_SESSION) ? array_keys($_SESSION) : [],
            'post_data' => $_POST,
            'raw_input' => substr(file_get_contents('php://input'), 0, 1000)
        ];

        self::log("Request to {$script}", $data);
    }

    public static function clear() {
        if (file_exists(self::$logFile)) {
            file_put_contents(self::$logFile, '');
            return true;
        }
        return false;
    }

    public static function getLog($lines = 100) {
        if (!file_exists(self::$logFile)) {
            return "Log file does not exist yet.";
        }

        $content = file_get_contents(self::$logFile);
        $allLines = explode("\n", $content);

        // Get last N lines
        if (count($allLines) > $lines) {
            $allLines = array_slice($allLines, -$lines);
        }

        return implode("\n", $allLines);
    }
}
?>