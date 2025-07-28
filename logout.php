<?php
//logout.php

//always start the session to access it
session_start();

//unset all session variables
$_SESSION = array();

//destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//destroy the session (about time hehe)
session_destroy();

//redirect to the homepage
header("Location: index.php");
exit();
?>