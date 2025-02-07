<?php
    session_start();
    if (!isset($_SESSION['admin_user'])) {
        header('Location: index.php');
        exit();
    }
    require "../src/php/db.php";
    $promotions = getPromoItems($pdo);
    $uploadsDir = "../uploads/";
    $images = [];

    if (is_dir($uploadsDir)) {
        $files = scandir($uploadsDir);
        foreach ($files as $file) {
            if ($file !== "." && $file !== ".." && getimagesize($uploadsDir . $file)) {
                $images[] = $file; // Only store valid image files
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4e2c2;
        }

        /* Header Styling */
        header {
            position: sticky;
            top: 0px;
            background-color: #a58e71;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        header .logo {
            font-size: 30px;
            font-weight: bold;
        }

        header .logo #cube {
            height:40px;
            width:auto;
            transform: translateY(8px); 
        }

        header .logo .box {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            border: 2px solid white;
        }

        header nav a.head-order-button {
            background-color: #00cc00;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
        }

        /* Main Content Styling */
        h2, h3 {
            text-align: center;
            color: #4b3832;
            margin-top: 20px;
        }

        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
        }

        .form-container, .table-container {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
            margin: 10px;
        }

        .form {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form textarea,
        form select {
            width: 100%;
            padding-top:5px;
            padding-bottom: 5px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .promotion-btn {
            width: 100%;
            background-color: #00cc00;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        label {
            font-weight: bold;
            color: #4b3832;
        }

        textarea {
            height: 21.33px; 
            width: 100%;
            max-height: 60px; 
            max-width: 200px; 
            min-width: 75px; 
            transform: translateY(10px);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table img {
            border-radius: 6px;
        }

        /* Button Styling */
        .delete-btn {
            background-color: #00cc00;
            border-radius: 6px;
            padding: 10px 16px;
            border: none; 
            color: white;
            cursor: pointer;
        }

        h5 {
            text-align: center;
            color: #888;
            font-style: italic;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img id="cube" src="../image/cube.png">
            Steak <span class="box">Box</span>
        </div>
        <nav>
            <a href="../src/php/logout.php" class="head-order-button">Logout</a>
        </nav>
    </header>
    <h2>Manage Seasonal Promotions</h2>

    <div class="container">
        <div class="form-container">
            <form class="form" action="../src/php/promo/addPromo.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Promotion Name" required>
                <br>
                <textarea name="description" placeholder="Description"></textarea>
                <br>
                <br>
                <input type="number" name="discount" placeholder="Discount %" required>
                <br><br>
                Start date: <input type="date" name="start_date" required>
                <br><br>
                End date: <input type="date" name="end_date" required>
                <br><br>
                <input type="file" name="image1" accept="image/*" id="upload-img" onchange="allowOnlyOneImg(false)">
                <br><br>
                <label for="imageSelect">Choose an existing image:</label>
                <select name="image2" id="imageSelect" onchange="allowOnlyOneImg(true)">
                    <option value="">-- Select an image --</option>
                    <?php foreach ($images as $image): ?>
                        <option value="uploads/<?= htmlspecialchars($image) ?>"><?= htmlspecialchars($image) ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <label><input type="checkbox" name="is_active"> Active</label>
                <br><br>
                <button class="promotion-btn" type="submit">Add Promotion</button>
            </form>
        </div>

        <div class="table-container">
            <h3>Current Promotions</h3>
            <?php if (count($promotions) > 0) :?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Discount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($promotions as $promo): ?>
                    <tr>
                        <td><?= htmlspecialchars($promo['name']) ?></td>
                        <td><?= $promo['discount'] ?>%</td>
                        <td><?= $promo['start_date'] ?></td>
                        <td><?= $promo['end_date'] ?></td>
                        <td>
                            <?php if ($promo['image']): ?>
                                <img src="<?php echo "../" . htmlspecialchars($promo['image']) ?>" width="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="../src/php/promo/deletePromo.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $promo['id'] ?>">
                                <button class="delete-btn" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php else: ?>
            <h5>No promotions posted</h5>
            <?php endif ?>
        </div>
    </div>

    <script>
        function allowOnlyOneImg(isExistingImg) {
            if (isExistingImg) {
                document.getElementById('upload-img').value = null;
            } else {
                document.getElementById('imageSelect').selectedIndex = 0;
            }
        }
    </script>
</body>
</html>