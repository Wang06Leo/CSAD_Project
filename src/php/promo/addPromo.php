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
        } else if (isset($_POST['image2'])) {
            $imageName = basename($_POST['image2']);
            $targetDir = "../../../uploads/"; // Correct directory
            $imagePath = "uploads/" . $imageName; // Store relative path
            move_uploaded_file($_POST['image2'], $targetDir . $imageName);
        }
        if (!isset($imagePath)) $imagePath = "";

        $sql = "INSERT INTO promotions (name, description, image, discount, start_date, end_date, price, type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $imagePath, $discount, $start_date, $end_date, $price, $type]);

        //echo json_encode(["success" => true, "message" => "Promotion added successfully"]);
        header('Location: ../../../admin/panel.php');
}