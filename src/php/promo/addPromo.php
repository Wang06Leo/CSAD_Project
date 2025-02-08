<?php
require "../db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $discount = $_POST["discount"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $is_active = isset($_POST["is_active"]) ? 1 : 0;

        // Handle Image Upload
        $imagePath = "";

        if (!is_dir("../../../uploads/")) {
            mkdir("../../../uploads/", 0777, true); // Creates the directory if it doesn't exist
        }
        if (!empty($_FILES["image1"]["name"])) {
            $imageName = basename($_FILES["image1"]["name"]);
            $targetDir = "../../../uploads/"; // Correct directory
            $imagePath = "uploads/" . $imageName; // Store relative path
            move_uploaded_file($_FILES["image1"]["tmp_name"], $targetDir . $imageName);
        } else if (!empty($_FILES["image2"]["name"])) {
            $imageName = basename($_FILES["image2"]["name"]);
            $targetDir = "../../../uploads/"; // Correct directory
            $imagePath = "uploads/" . $imageName; // Store relative path
            move_uploaded_file($_FILES["image2"]["tmp_name"], $targetDir . $imageName);
        }

        $sql = "INSERT INTO promotions (name, description, image, discount, start_date, end_date, is_active, price, type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $imagePath, $discount, $start_date, $end_date, $is_active, $price, $type]);

        //echo json_encode(["success" => true, "message" => "Promotion added successfully"]);
        header('Location: ../../../admin/panel.php');
}