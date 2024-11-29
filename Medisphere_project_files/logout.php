<?php
session_start(); // Start the session

// Destroy the session and remove all session data
session_unset();
session_destroy();

// Redirect to the login page or home page
header("Location: login.php"); // Change "login.php" to the appropriate page, such as "index.php"
exit();
?>
