<?php
require "../db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM promotions WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    //echo json_encode(["success" => true, "message" => "Promotion deleted successfully"]);
    header('Location: ../../../admin/panel.php');
}