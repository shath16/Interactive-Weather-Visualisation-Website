<?php
require_once __DIR__ . '/includes/session.php';

$_SESSION = []; //logging the user out 
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy(); //destroying session on server

//user is sent to home page after logging out 
header('Location: index.php');
exit;