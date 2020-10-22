<?php
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $par = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $par["path"], $par["domain"], $par["secure"], $par["httponly"]);
}
session_destroy();
header("Location: prihlasenie.php");