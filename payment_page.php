<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5e7d3;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .payment-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        
        .header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
        
        .cart-summary {
            margin-bottom: 15px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        
        .form-group {
            margin-bottom: 10px;
        }
        
        label {
            font-weight: bold;
        }
        
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .checkout-btn {
            width: 100%;
            background-color: #00cc00;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .checkout-btn:hover {
            background-color: #009900;
        }
        
        /* Popup Styling */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .popup button {
            margin-top: 10px;
            background-color: #00cc00;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #009900;
        }
    </style>
    <script>
        function showPopup() {
            const receiptId = 'REC' + Math.floor(Math.random() * 1000000);
            document.getElementById('receiptId').innerText = receiptId;
            document.getElementById('popup').style.display = 'block';
        }
        
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="payment-container">
        <div class="header">Payment</div>
        
        <div class="cart-summary">
            <div class="cart-item">
                <span>Wagyu Beef</span>
                <span>$50.85</span>
            </div>
            <div class="cart-item">
                <span>Dong Po Rou</span>
                <span>$25.90</span>
            </div>
            <hr>
            <div class="cart-item">
                <span>Subtotal</span>
                <span>$76.75</span>
            </div>
            <div class="cart-item">
                <span>GST (inclusive)</span>
                <span>$6.90</span>
            </div>
            <div class="cart-item total">
                <span>Total</span>
                <span>$83.66</span>
            </div>
        </div>
        
        <div class="payment-form">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" placeholder="Enter first name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" placeholder="Enter last name">
            </div>
            <div class="form-group">
                <label>Credit Card Number</label>
                <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX">
            </div>
            <div class="form-group">
                <label>Card Expiration</label>
                <input type="text" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label>Security Code</label>
                <input type="text" placeholder="CVV">
            </div>
        </div>
        
        <button class="checkout-btn" onclick="showPopup()">Checkout</button>
    </div>
    
    <!-- Popup for Payment Success -->
    <div class="popup" id="popup">
        <h3>Payment Successful!</h3>
        <p>Your receipt ID: <strong id="receiptId"></strong></p>
        <button onclick="closePopup()">OK</button>
    </div>
</body>
</html>