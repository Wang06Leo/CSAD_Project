<?php
require "../db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $discount = $_POST["discount"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $is_active = isset($_POST["is_active"]) ? 1 : 0;

    $sql = "UPDATE promotions SET name=?, description=?, discount=?, start_date=?, end_date=?, is_active=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $discount, $start_date, $end_date, $is_active, $id]);

    //echo json_encode(["success" => true, "message" => "Promotion updated successfully"]);
    header('Location: ../../../admin/panel.php');
}