<?php
session_start();

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    http_response_code(403); // Access denied
    header('Content-Type: text/html; charset=utf-8');
    echo "<h1>Access Denied</h1><p>You are not logged in.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Webservice</title>
</head>
<body>
    <h1>Webservice</h1>
    <p>Only visible if the session is valid.</p>
</body>
</html>
