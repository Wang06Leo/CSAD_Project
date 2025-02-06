<?php 
session_start(); 
require "src/php/db.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Receipt Page</title>
</head>
<style>
    /* General Reset */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f8f8;
    }

    /* Receipt Container */
    .receipt-container {
        width: 50%;
        background: white;
        padding: 20px;
        margin: 50px auto;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Title */
    .receipt-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline;
    }

    /* Receipt Table */
    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .receipt-table th, .receipt-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .receipt-table th {
        background-color: #e0e0e0;
        font-weight: bold;
    }

    /* Receipt Summary */
    .receipt-summary {
        display: flex;
        flex-direction: column;
        margin-left: 56%;
        font-size: 16px;
        margin-top: 20px;
    }

    /* Each row inside the summary */
    .receipt-summary p {
        display: flex;
        justify-content: space-between; /* Spreads text evenly */
        width: 100%;
        max-width: 270px;
        font-size: 16px;
        margin: 5px 0;
    }

    /* Span to position values on the right */
    .receipt-summary span {
        flex: 1;
        text-align: right;
    }

    /* Total Styling */
    .receipt-summary .total {
        font-size: 20px;
        font-weight: bold;
    }
    .order-id {
        margin-left:68%;
    }
    
    .back-img {
        height:47px;
        transform: translate(20px, 20px);
    }
    </style>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img id="cube" src="image/cube.png">
            Steak <span class="box">Box</span>
        </div>
        <nav>
            <a href="main.php">Home</a>
            <a href="menu.php" class="head-order-button">Order Here</a>
            <a href="login.php" class="head-order-button">Login</a>
            <a href="#">
                <div class="icon-container">
                    <img src="image/Ellipse 1.png" alt="Circle" class="background-circle">
                    <img src="image/Vector.png" alt="Cart Icon" class="cart-icon">
                </div>
            </a>
        </nav>
    </header>

    <?php
        $items = getItem($pdo); // Capture the returned items array
    ?>
        <!-- Receipt Section -->
        <section class="receipt-container">
        <h2 class="receipt-title">🧾 Receipt</h2>
        <span class="order-id">Order ID: <?php echo htmlspecialchars($_SESSION['order_id']) ?></span>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Items Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="receipt-summary">
            <p>Subtotal:<span>
            <?php 
                $subtotal = 0;
                foreach ($items as $item) {
                    $subtotal += $item['price'] * $item['quantity']; // Calculate the subtotal
                }
                echo htmlspecialchars(number_format(($subtotal), 2));
            ?>
            </span></p>
            <p>GST (Inclusive):<span>
            <?php
            $gst = $subtotal * 0.10; // Example 10% GST
            echo htmlspecialchars(number_format(($gst), 2));
            ?>
            </span> </p>
            <p class="total">Total: <span><?php echo htmlspecialchars(number_format(($subtotal + $gst), 2)); ?></span></p>
        </div>
    </section>
</body>
</html>