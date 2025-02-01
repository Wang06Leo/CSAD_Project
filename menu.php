<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Page</title>
    <style>
        .container {
            padding: 20px;
        }
        .promotion {
            background-color: #f7e3c2;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        .promotion h2 {
            margin: 0 0 10px;
        }

        .promotion-items {
            display: flex;
            gap: 15px;
            overflow-x: auto;
        }

        .food-item {
        background-color: #fff;
        border-radius: 8px;
        padding: 0px; /* Increased padding for larger size */
        padding-bottom: 20px;
        text-align: center;
        border: 1px solid #ccc;
        flex: 0 0 150px;
        }

        .promotion .food-item img {
            width: 100%; /* Ensures the image spans the full width of the container */
            height: 100px; /* Set a fixed height for all images */
            object-fit: cover; /* Ensures the image retains its aspect ratio while filling the set height and width */
            border-radius: 8px 8px 0 0; /* Keeps the rounded corners for the top of the image */
            margin: 0; /* Removes any extra margin */
            padding: 0; /* Ensures no padding is applied */
        }

        .food-item p {
        font-size: 18px; /* Larger font size for text */
        margin: 5px 0;
        }

        .food-item button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px; /* Increased button size */
        border-radius: 5px;
        font-size: 16px; /* Larger font size for buttons */
        cursor: pointer;
        }

        .food-grid .food-item img {
            width: 100%; /* Ensures the image spans the full width of its container */
            height: 300px; /* Set a fixed height for consistency */
            object-fit: cover; /* Ensures the image retains its aspect ratio while filling the set dimensions */
            border-radius: 8px 8px 0 0; /* Keeps the top corners rounded */
            margin: 0; /* Removes any default margin */
            padding: 0; /* Ensures no padding is applied */
        }

        .food-section {
            margin-bottom: 30px;
        }

        .food-section h3 {
            margin-bottom: 10px;
        }

        .food-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Maximum of 3 items per row */
        gap: 20px; /* Adjust the spacing between items */
        }


        .category-buttons {
            margin-bottom: 15px;
        }

        .category-buttons button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .category-buttons button.active {
            background-color: #333;
        }



        /* Cart Popup Styling */
        .cart-container {
            display: none; /* Initially hidden */
            position: fixed;
            top: 105px;
            right: 0;
            width: 400px;
            height: 100%;
            background-color: #F1EFEF;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.2);   
            padding: 20px;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        /* Cart content */
        .cart-content {
            position: relative;
        }

        .cart-total {
            margin-top: 300px;

        }
        /* Checkout button */
        .checkout-btn {
            background-color: #00cc00;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 40px;
        }

        .checkout-btn:hover {
            background-color: #009900;
        }
        
        .close-cart{
            width: 35px;
            height: 35px;
            position: absolute;
            top:0px;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartIcon = document.querySelector(".icon-link"); // Cart button
            const cartPopup = document.getElementById("cart-popup"); // Cart popup
            const closeCart = document.querySelector(".close-cart"); // Close button

            // Show cart when clicking the cart icon
            cartIcon.addEventListener("click", function(event) {
                event.preventDefault();
                cartPopup.style.display = "block";
            });

            // Close cart when clicking the close button
            closeCart.addEventListener("click", function() {
                cartPopup.style.display = "none";
            });

            // Close cart when clicking outside the cart
            window.addEventListener("click", function(event) {
                if (event.target === cartPopup) {
                    cartPopup.style.display = "none";
                }
            });
        });
    </script>
    
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            Steak <span class="box">Box</span>
        </div>
        <nav>
            <a href="main.html">Home</a>
            <a href="login.php" class="head-order-button" style="text-decoration: underline;" >Login</a>
            <a href="#" class="icon-link">
            <div class="icon-container">
                <img src="image/Ellipse 1.png" alt="Circle" class="background-circle">
                <img src="image/Vector.png" alt="Cart Icon" class="cart-icon">
            </div>
        </a>
    </header>
    <div class="container">
        <div class="promotion">
            <h2>Monthly Promotion</h2>
            <p>Up to 60% off for this Month!</p>
            <div class="promotion-items">
                <div class="food-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Food Menu</h3>
            <div class="category-buttons">
                <button class="active">Beef</button>
                <button>Pork</button>
                <button>Lamb</button>
            </div>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/Dong_Po_Rou.jpg" alt="Dong Po Rou">
                    <p>Dong Po Rou</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/short_rib_ragu.jpg" alt="Short Rib Ragu">
                    <p>Short Rib Ragu</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/steak_pear.jpg" alt="Steak and Charred Pear Salad">
                    <p>Steak and Charred Pear Salad</p>
                    <p>$18.19</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Beef</h3>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/steak_pear.jpg" alt="Steak and Charred Pear Salad">
                    <p>Steak and Charred Pear Salad</p>
                    <p>$18.19</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/short_rib_ragu.jpg" alt="Short Rib Ragu">
                    <p>Short Rib Ragu</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Pork</h3>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/Dong_Po_Rou.jpg" alt="Dong Po Rou">
                    <p>Dong Po Rou</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/braised_pork.jpg" alt="Braised Pork">
                    <p>Braised Pork</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Lamb</h3>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/lamb_curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/seared_lamb.jpg" alt="Seared Lamb with Smoky Slather">
                    <p>Seared Lamb with Smoky Slather</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/roasted_lamb_leg.webp" alt="Roasted Lamb Leg">
                    <p>Roasted Lamb Leg</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Dessert</h3>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/italian_tiramisu.avif" alt="Italian Tiramisu">
                    <p>Italian Tiramisu</p>
                    <p>$7.10</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/creme_brulee.jpg" alt="Crème Brûlée">
                    <p>Crème Brûlée</p>
                    <p>$8.15</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/oreo_dirt_pudding.jpg" alt="Oreo Dirt Pudding">
                    <p>Oreo Dirt Pudding</p>
                    <p>$5.80</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/paganini_strawberry.jpg" alt="Paganini Strawberry">
                    <p>Paganini Strawberry</p>
                    <p>$8.50</p>
                    <button>Add</button>
                </div>
            </div>
        </div>

        <div class="food-section">
            <h3>Drinks</h3>
            <div class="food-grid">
                <div class="food-item">
                    <img src="image/coke.webp" alt="Coke">
                    <p>Coke</p>
                    <p>$3.20</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/sprite.webp" alt="Sprite">
                    <p>Sprite</p>
                    <p>$3.20</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/beer.webp" alt="Beer">
                    <p>Beer</p>
                    <p>$15.80</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="image/wine.webp" alt="Wine">
                    <p>Wine</p>
                    <p>$50.80</p>
                    <button>Add</button>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-popup" class="cart-container">
        <div class="cart-content">
            <h1 style="text-align: center;">Your Cart</h1>
            <img src="image/back.png" class="close-cart"></img>    
            <hr style="height:2px; border:none;background-color: #333;">
            <div id="cart-items">
                <p>No items added</p>
            </div>
            <div class="cart-total">
            <hr style="height:1px; border:none;background-color: #333;">
                <p><strong>Subtotal:</strong> $<span id="subtotal">0.00</span></p>
                <p><strong>GST (inclusive):</strong> $<span id="gst">0.00</span></p>
                <p><strong>Total:</strong> $<span id="total">0.00</span></p>
            </div>
            <button class="checkout-btn">Payment</button>
        </div>
    </div>
</body> 