<?php
session_start();
require_once 'includes/admin-config.php';

// Force admin mode for testing
$_SESSION['admin_mode'] = true;
$_SESSION['admin_login_time'] = time();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Admin Save</title>
    <meta name="csrf-token" content="<?php echo getCSRFToken(); ?>">
</head>
<body>
    <h1>Test Admin Save</h1>

    <p>Admin Mode: <?php echo IS_ADMIN ? 'YES' : 'NO'; ?></p>
    <p>CSRF Token: <?php echo getCSRFToken(); ?></p>

    <button onclick="testSave()">Test Save</button>
    <button onclick="window.location='view-logs.php'">View Logs</button>

    <div id="result"></div>

    <script>
    function testSave() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        console.log('Testing save with CSRF token:', csrfToken);

        fetch('admin-save.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                page: 'test',
                fields: { 'test.field': 'test value' },
                csrf_token: csrfToken
            })
        })
        .then(response => {
            console.log('Response:', response);
            document.getElementById('result').innerHTML = `
                <p>Status: ${response.status} ${response.statusText}</p>
                <p>URL: ${response.url}</p>
                <p>Redirected: ${response.redirected}</p>
            `;
            return response.text();
        })
        .then(text => {
            console.log('Response text:', text);
            document.getElementById('result').innerHTML += `<pre>${text}</pre>`;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerHTML = `<p>Error: ${error}</p>`;
        });
    }
    </script>
</body>
</html>