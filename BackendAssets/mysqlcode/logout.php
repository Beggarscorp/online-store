
<?php
include("../../config/config.php");
require_once("../../config/google_config.php");
session_start(); // Start the session

// Unset specific session variables
unset($_SESSION['user']);
unset($_SESSION['id']);
$google_client->revokeToken();

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

// Redirect to the login page or home page
header("Location: ".BASE_URL."login"); // Change to your login page URL
exit();
?>
