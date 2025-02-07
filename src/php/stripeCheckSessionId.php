<?php
if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}
require dirname(__DIR__) . "/vendor/autoload.php";
require "secrets.php";
\Stripe\Stripe::setApiKey($stripeSecretKey);
try {
    // Retrieve the Stripe session
    $session = \Stripe\Checkout\Session::retrieve($_SESSION['session_id']);

    // Check if the payment was successful
    if ($session->payment_status === 'paid') {
        $_SESSION['payment_success'] = true;
    } else {
        $_SESSION['payment_success'] = false;
    }
} catch (Exception $e) {
    unset($_SESSION['payment_success']);
    //die("Invalid session ID.");
}