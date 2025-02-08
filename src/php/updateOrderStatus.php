<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["id"]) && !isset($_POST["orderStatus"])) die("Invalid req");
    $id = $_POST["id"];
    $orderStatus = $_POST["orderStatus"];
    $id = (int) $id;
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        die("Order not found.");
    }
    $updateStmt = $pdo->prepare("UPDATE orders SET order_status = :orderStatus WHERE id = :id");
    $success = $updateStmt->execute([':orderStatus' => $orderStatus,':id' => $id]);
    if ($success) {
        header("Location: ../../admin/panel.php");
        exit();
    } else echo "Something went wrong";
}