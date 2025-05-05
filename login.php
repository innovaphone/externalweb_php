<?php
session_start();

$appPwd = "pwd";

if (!isset($_SESSION["challenge"])) {
    $_SESSION["challenge"] = bin2hex(random_bytes(8));
}

$challenge = $_SESSION["challenge"];
$mt = $_GET["mt"] ?? null;

if ($mt === "AppChallenge") {
    header('Content-Type: application/json');
    echo json_encode(["mt" => "AppChallengeResult", "challenge" => $challenge]);
}
elseif ($mt === "AppLogin") {
    $app = $_GET["app"] ?? "";
    $domain = $_GET["domain"] ?? "";
    $sip = $_GET["sip"] ?? "";
    $guid = $_GET["guid"] ?? "";
    $dn = $_GET["dn"] ?? "";
    $info = $_GET["info"] ?? "";
    $digest = $_GET["digest"] ?? "";

    $data = "$app:$domain:$sip:$guid:$dn:$info:$challenge:$appPwd";
    $hash = strtolower(hash("sha256", $data));

    header('Content-Type: application/json');
    if ($hash === $digest) {
        $_SESSION["authenticated"] = true;
        $_SESSION["app"] = $_GET["app"] ?? "";
        $_SESSION["domain"] = $_GET["domain"] ?? "";
        $_SESSION["sip"] = $_GET["sip"] ?? "";
        $_SESSION["guid"] = $_GET["guid"] ?? "";
        $_SESSION["dn"] = $_GET["dn"] ?? "";
        $_SESSION["infojson"] = $_GET["info"] ?? "";
        echo json_encode(["mt" => "AppLoginResult", "ok" => true]);
    } else {
        echo json_encode(["mt" => "AppLoginResult", "ok" => false, "error" => "Digest stimmt nicht."]);
    }
}
else {
    if (!empty($_SESSION["authenticated"])) {
        echo "<h1>Willkommen zurück!</h1><p>Du bist bereits eingeloggt.</p>";
    } else {
        echo "<h1>Innovaphone External App Service</h1><p>Bitte mt=AppChallenge oder mt=AppLogin senden.</p>";
    }
}
