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
    <h1>Success Page</h1>
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
</body>
</html>