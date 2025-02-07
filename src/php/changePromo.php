<?php
require "db.php";
function addPromo($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $discount = $_POST["discount"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $is_active = isset($_POST["is_active"]) ? 1 : 0;

        // Handle Image Upload
        $imagePath = "";
        if (!empty($_FILES["image"]["name"])) {
            $targetDir = "uploads/";
            $imagePath = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }

        $sql = "INSERT INTO promotions (name, description, image, discount, start_date, end_date, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $imagePath, $discount, $start_date, $end_date, $is_active]);

        echo json_encode(["success" => true, "message" => "Promotion added successfully"]);
    }
}

function updatePromo($pdo) {
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
    
        echo json_encode(["success" => true, "message" => "Promotion updated successfully"]);
    }
}

function deletePromo($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
    
        $sql = "DELETE FROM promotions WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    
        echo json_encode(["success" => true, "message" => "Promotion deleted successfully"]);
    }
}