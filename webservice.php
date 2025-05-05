<?php
session_start();

if (empty($_SESSION["authenticated"])) {
    http_response_code(403); // Zugriff verweigert
    echo "<h1>Zugriff verweigert</h1><p>Du bist nicht eingeloggt.</p>";
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
    <p>Nur sichtbar, wenn Session gültig ist.</p>
</body>
</html>