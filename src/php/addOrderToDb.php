<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout_data'])) {
    header("Content-Type: application/json");
    //echo "<h1>Received Checkout Data:</h1>";
    $data = json_decode($_POST['checkout_data'], true);
    $orderId = addOrderToDb($data, $pdo);
    $_SESSION['order_id'] = $orderId; // session_start() in db.php, so not needed here
    $total_price = 0;
    foreach ($data as $item) {
        $total_price += $item['price'][0];
    }
    $pointsIncVal = ceil($total_price * 3); // e.g. user order is $49.99, adds 150 points 
    addUserPoints($pointsIncVal, $pdo);
    header("Location: ../../success.php");
    exit();
    
}