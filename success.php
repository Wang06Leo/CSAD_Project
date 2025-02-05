<?php
    require "src/php/stripeCheckSessionId.php";
    require "src/php/addOrderToDb.php";
    /**
     * @var int $orderId 
     * */
    if (!isset($_SESSION['payment_success'])) {
        header("Location: main.php");
        exit();
    }
    if ($_SESSION['payment_success'] === false) {
        header("Location: src/php/checkout.php");
        exit();
    }
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
        margin-left: 50%;
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
    
    <form method="POST" action="src/php/addOrderToDb.php" id="submit-form"></form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (sessionStorage.getItem("formSubmitted")) {
                localStorage.clear(); // print receipt before here... or u can print a blank receipt
                return;
            }
            let items = JSON.parse(localStorage.getItem("cart"));
            console.log("Cart items:", items);
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'checkout_data';
            input.value = JSON.stringify(items);
            if (document.getElementById("submit-form")) {
                let form = document.getElementById("submit-form");
                form.appendChild(input);
                sessionStorage.setItem("formSubmitted", "true");
                form.submit();
            }
        });
    </script>
    <?php
        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        if (isset($_SESSION['order_id'])) {
            if (!isset($_SESSION['last_order_id']) || $_SESSION['order_id'] !== $_SESSION['last_order_id']) {
                echo "<h2>Your order id is " . $_SESSION['order_id'] . "</h2>";
                $_SESSION['last_order_id'] = $_SESSION['order_id']; // Update last order ID after displaying
            }
        } else {
            echo "<h2>Weird</h2>";
        }
    ?>
    <button onclick="window.location.href='main.php'">go to main.php</button>

        <!-- Receipt Section -->
        <section class="receipt-container">
        <h2 class="receipt-title">🧾 Receipt</h2>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Items Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="receipt-summary">
            <p>Subtotal:<span>$76.75</span></p>
            <p>GST (Inclusive):<span>$6.90</span> </p>
            <p class="total">Total: <span>$83.66</span></p>
        </div>
    </section>
</body>
</html>