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

    <form action="../src/php/promo/addPromo.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Promotion Name" required>
        <br>
        <textarea name="description" placeholder="Description" style="height: 21.33px; max-height: 60px; max-width: 200px; min-width: 75px; transform: translateY(10px);"></textarea>
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
        <button type="submit">Add Promotion</button>
    </form>
    <h3>Current Promotions</h3>
    <?php if (count($promotions) > 0) :?>
    <table border="1">
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
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <h5>No promotions posted</h5>
    <?php endif ?>
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