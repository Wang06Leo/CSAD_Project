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
    $orders = getAllOrders($pdo);
    //var_dump($orders);
    function addZerosInFront($n) {
        $s = '';
        if ($n >= 100) return $n;
        else if ($n < 10) $s = '00' . $n; 
        else if ($n < 100) $s = '0' . $n;
        return $s;
    }
    function printItems($cnt, $size, $title, $prefer, $type) {
        $s = $cnt . ' ';
        $size[0] = strtoupper($size[0]);
        if ($size !== 'N/A') $s .= $size . ' ';
    
        // Check if the title ends with "(points redeemed)"
        if (str_ends_with($title, '(points redeemed)')) {
            $baseTitle = substr($title, 0, -17); // Remove "(points redeemed)"
            if ($cnt > 1) $baseTitle .= 's'; // Proper pluralization
            $s .= $baseTitle . '(points redeemed)';
        } else {
            if ($cnt > 1) $s .= $title . 's';
            else $s .= $title;
        }
    
        if ($type !== 'N/A') $s .= " ($type done";
        if ($prefer === 'None' && $type !== 'N/A') return $s . ')';
        else if ($prefer === 'None' && $type === 'N/A') return $s;
        else if ($prefer !== 'None' && $type === 'N/A') return $s . " ($prefer)";
        return $s . " ,$prefer)";
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
            min-width: 75px; 
            transform: translateY(10px);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            transform: translateX(-8%);
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

        .both-container {
            display: flex;
            justify-content: center;
            flex-direction: row;
            gap: 30px;
        }

        .order-container,
        .finished-container {
            width: 400px;
            max-width: 700px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 500px;
            overflow-y: auto;
        }
        .order {
            border-bottom: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }
        .order:last-child {
            border-bottom: none;
        }
        .order h3 {
            margin: 0;
            color: #333;
        }
        .order p {
            margin: 5px 0;
        }
        .status {
            font-weight: bold;
            color: orange;
        }
        .button {
            background: #007bff;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background: #0056b3;
        }
        span.orderItems:nth-child(n+3) {
            margin-left: 51px;
        }

        @media (max-width:1024px){
            table th, table td {
                padding: 3px 2px;
                font-size: 12px;
            }
            table{
                transform: translateX(0%);
            }
        }

        @media (max-width:431px) {
            table th, table td {
                padding: 3px 2px;
                font-size: 8px;
            }
            table{
                transform: translateX(0%);
            }
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
    <h2>Current Orders</h2>
    <div class="both-container">
        <div class="order-container">
            <h1>Preparing Orders</h1>
            <?php if(isset($orders['incompleted'])): ?>
            <?php foreach($orders['incompleted'] as $id => $items): ?>
                <div class="order">
                <h3>Order #<?= addZerosInFront($id) ?></h3>
                <p style="overflow-wrap: break-word">
                    <strong>Items:</strong> <?php foreach($items as $item): ?>
                    <span class="orderItems"><?= htmlspecialchars(printItems($item['quantity'], $item['size'], $item['title'], $item['preference'], $item['meat_type']))?></span>
                    <br>
                    <?php endforeach; ?>
                </p>
                <p class="status">Preparing</p>
                <button class="button" onclick="createFormAndSendToDb(<?=$id?>, 'completed')">Mark as Ready</button>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="finished-container">
        <h1>Finished Orders</h1>
            <?php if(isset($orders['completed'])): ?>
            <?php foreach($orders['completed'] as $id => $items): ?>
                <div class="order">
                <h3>Order #<?= addZerosInFront($id) ?></h3>
                <p style="overflow-wrap: break-word">
                    <strong>Items:</strong> <?php foreach($items as $item): ?>
                    <span class="orderItems"><?= printItems($item['quantity'], $item['size'], $item['title'], $item['preference'], $item['meat_type'])?></span>
                    <br>
                    <?php endforeach; ?>
                </p>
                <p class="status" style="color: green">Completed</p>
                <button class="button" onclick="createFormAndSendToDb(<?=$id?>, 'incompleted')">Undo Mark as Ready</button>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <h2>Manage Seasonal Promotions</h2>

    <div class="container">
        <div class="form-container">
            <form class="form" action="../src/php/promo/addPromo.php" method="POST" enctype="multipart/form-data" id="submit-items" onsubmit="return checkImg()">
                <input type="text" name="name" placeholder="Promotion Name" required>
                <br>
                <textarea name="description" placeholder="Description"></textarea>
                <br>
                <br>
                <p>Select food type:</p>
                <input type="radio" id="steak" name="type" value="steak" required>
                <label for="steak">Steak</label><br>
                <input type="radio" id="salad" name="type" value="salad">
                <label for="salad">Salad</label><br>
                <input type="radio" id="dessert" name="type" value="dessert">
                <label for="dessert">Dessert</label><br>
                <input type="radio" id="drinks" name="type" value="drinks">
                <label for="drinks">Drinks</label>
                <input type="number" step="0.01"name="price" placeholder="Price $" required>
                <input type="number" name="discount" placeholder="Discount %" required>
                <br><br>
                Start date: <input type="date" name="start_date" id="start" onchange="checkDate(true)"required>
                <br><br>
                End date: <input type="date" name="end_date" id="end" onchange="checkDate(false)" required>
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
                <button class="promotion-btn" type="submit">Add Promotion</button>
            </form>
        </div>

        <div class="table-container">
            <h3>Current Promotions</h3>
            <?php if (count($promotions) > 0) :?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($promotions as $promo): ?>
                    <tr>
                        <td><?= htmlspecialchars($promo['name']) ?></td>
                        <td><?= $promo['price'] ?></td>
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
                let showImg = document.getElementById('show-img');
                let e = document.getElementById('imageSelect');
                let text = e.options[e.selectedIndex].text;
                if (!showImg) {
                    let createImg = document.createElement('img');
                    createImg.src = "../uploads/" + text;
                    createImg.alt = "Uploaded image";
                    createImg.id = 'show-img';
                    createImg.style.width = "100%";
                    let btn = document.getElementsByClassName('promotion-btn')[0];
                    document.getElementById('submit-items').insertBefore(createImg, btn);
                } else {
                    showImg.src = "../uploads/" + text;
                }
            } else {
                document.getElementById('imageSelect').selectedIndex = 0;
                const [file] = document.getElementById('upload-img').files
                let showImg = document.getElementById('show-img');
                if (file && showImg) {
                    showImg.src = URL.createObjectURL(file);
                } else if (file) {
                    let createImg = document.createElement('img');
                    createImg.src = URL.createObjectURL(file);
                    createImg.alt = "Uploaded image";
                    createImg.id = 'show-img';
                    createImg.style.width = "100%";
                    let btn = document.getElementsByClassName('promotion-btn')[0];
                    document.getElementById('submit-items').insertBefore(createImg, btn);
                }
            }
        }
        function createFormAndSendToDb(orderId, status) {
            if (!(status === 'completed' || status === 'incompleted')) return;
            let form = document.createElement('form');
            let input = document.createElement('input');
            let status_input = document.createElement('input');
            form.method = 'POST';
            form.action = '../src/php/updateOrderStatus.php';
            input.value = orderId;
            input.name = 'id';
            input.type = 'hidden';
            form.appendChild(input);
            status_input.value = status;
            status_input.name = 'orderStatus';
            status_input.type = 'hidden';
            form.appendChild(status_input);
            document.body.appendChild(form);
            form.submit();
        }
        function checkDate(isStart) {
            let start = new Date(document.getElementById('start').value);
            let end = new Date(document.getElementById('end').value);
            if (isStart && start.getTime() > end.getTime()) {
                document.getElementById('start').value = null;
                alert('Start date later than end date. Please put a valid date');
            } else if (!isStart && start.getTime() > end.getTime()) {
                document.getElementById('end').value = null;
                alert('End date eariler than satrt date. Please put a valid date');
            }
        }
        function checkImg() {
            if(!document.getElementById('upload-img').value && document.getElementById('imageSelect').selectedIndex === 0) {
                alert("Please insert image");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>