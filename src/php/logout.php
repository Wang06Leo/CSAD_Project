<?php
session_start();
session_destroy(); // Destroy session and log out user
header("Location: login.php"); // Redirect to login page
exit();
?>
