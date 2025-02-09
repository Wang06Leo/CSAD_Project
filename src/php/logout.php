<?php
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    return "$protocol://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['points']) && isset($_SESSION['admin_user'])) {
    if ($_SERVER['HTTP_REFERER'] === (dirname(getBaseUrl(), 3) . "/admin/panel.php")) {
        unset($_SESSION['admin_user']);
        header("Location: ../../admin/index.php");
        exit();
    } else {
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['points']);
        header("Location: ../../login.php"); // Redirect to login page
        exit();
    }
}
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['points'])) {
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['points']);
}
if (isset($_SESSION['admin_user'])) {
    unset($_SESSION['admin_user']);
    header("Location: ../../admin/index.php");
    exit();
}
header("Location: ../../login.php"); // Redirect to login page
exit();
?>
