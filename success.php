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