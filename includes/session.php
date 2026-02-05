
<?php

//includes/session.php
if (session_status() === PHP_SESSION_NONE) {

    //setting session cookie options
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',   //cookie works across the whole websote
        'secure' => $secure,   //only sending cookie over HTTPS when available 
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

//true when user is logged in and is admin
function is_admin(): bool {
    return !empty($_SESSION['logged_in']) && !empty($_SESSION['is_admin']);
}

//non-admin user resdirected to login 
function require_admin(): void {
    if (!is_admin()) {
        $next = $_SERVER['REQUEST_URI'] ?? 'addweather.php';
        header('Location: login.php?next=' . urlencode($next));
        exit;
    }
}

//used for AJAX requestes, returns a 301 error in JSON if the user is not an admin
function require_admin_json(): void {
    if (!is_admin()) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => false, 'error' => 'Admin login required']);
        exit;
    }
}
