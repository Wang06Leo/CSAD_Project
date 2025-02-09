<?php
    require "src/php/stripeCheckSessionId.php";
    require "src/php/db.php";
    /**
     * @var int $orderId 
     * */
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    }
    if (!isset($_SESSION['payment_success'])) {
        header("Location: main.php");
        exit();
    }
    if ($_SESSION['payment_success'] === false) {
        header("Location: src/php/checkout.php");
        exit();
    }
?>

    <form method="POST" action="src/php/addOrderToDb.php" id="submit-form"></form>

    <script>
        if (sessionStorage.getItem("formSubmitted")) {
            localStorage.clear();
        }
        document.addEventListener("DOMContentLoaded", function () {
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
                //echo "<h2>Your order id is " . $_SESSION['order_id'] . "</h2>";
                $_SESSION['last_order_id'] = $_SESSION['order_id']; // Update last order ID after displaying
            }
        }


        // Check if 'order_id' exists in the session
        else {
            //echo "<h2>No order ID found.</h2>";
            exit();
        }

        $order_id = $_SESSION['order_id']; // Get the order ID from the session
        $stmt = $pdo->prepare("SELECT title, price, quantity FROM order_items WHERE order_id = ?");
        $stmt->execute([$order_id]); // Bind the order_id to the query
        // Fetch the result
        $items  = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any items were found
        if (empty($items)) {
            //echo "<h2>No items found for this order.</h2>";
        }
        // if (isset($_SESSION['order_id']) && !empty($items) && ($_SESSION['order_id'] !== $_SESSION['last_order_id'] || !isset($_SESSION['last_order_id']))) {
        //     header("Location: receipt.php");
        //     exit();
        // }
        if (isset($_SESSION['order_done']) && $_SESSION['order_done'] === TRUE && isset($order_id)) {
            unset($_SESSION['order_done']);
            echo "<script>
                    localStorage.clear();
                    window.location.href = 'receipt.php';
                </script>";
            exit();
        }
    ?>
