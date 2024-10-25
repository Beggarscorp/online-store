<?php
session_start(); // Start the session

// Destroy all session data
$_SESSION = array();

// If using cookies to store the session ID, delete the cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// Redirect to the login page or home page
header("Location: /login.php"); // Change to your login page URL
exit();
?>
