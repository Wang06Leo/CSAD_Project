<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['points'])) {
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['points']);
}
if (isset($_SESSION['admin_user'])) {
    unset($_SESSION['admin_user']);
    header("Location: ../../admin/panel.php");
    exit();
}
header("Location: ../../login.php"); // Redirect to login page
exit();
?>
