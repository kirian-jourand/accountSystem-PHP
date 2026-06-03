<?php
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

session_set_cookie_params([
    'lifetime' => 1800, // 30 minutes
    'domain' => 'localhost',
    'path' => '/',
    'secure' => $isSecure,
    'httponly' => true,
]);
session_start();

if (!isset($_SESSION['last_regeneration'])) {
    regenerateSessionId();
} else {
    $interval = 1800; // 30 minutes
    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        regenerateSessionId();
    }
}

function regenerateSessionId(): void {
    session_regenerate_id();
    $_SESSION['last_regeneration'] = time();
}
