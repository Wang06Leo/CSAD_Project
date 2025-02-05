<?php
session_start();
$_SESSION['paying'] = false;
// Redirect to login page if not logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Page</title>
    <style>
        /* Login Form Styling */
        .login-container {
            text-align: center;
            padding: 100px 20px;
        }

        .login-container h1 {
            font-size: 64px;
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-container .box {
            display: inline-block;
            background-color: #333;
            border: 4px solid white;
            color: white;
            font-size: 48px;
            font-weight: bold;
            padding: 10px 20px;
            margin-bottom: 40px;
        }

        .login-form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .login-form label {
            font-size: 20px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .login-form button {
            width: 100%;
            padding: 15px;
            font-size: 20px;
            color: white;
            background-color: #00cc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-form button:hover {
            background-color: #009900;
        }

        .login-form p {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }

        .login-form a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }

        .login-form a:hover {
            text-decoration: underline;
        }
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
            overflow-x: auto; /* Enables horizontal scrolling */
            scroll-behavior: smooth; /* Adds smooth scrolling effect */
            padding-bottom: 10px; /* Avoids scrollbar overlapping content */
        }

        .promotion-items::-webkit-scrollbar {
            height: 8px; /* Custom scrollbar height */
        }

        .promotion-items::-webkit-scrollbar-thumb {
            background-color: #a58e71;
            border-radius: 10px;
        }

        .promotion-items::-webkit-scrollbar-track {
            background-color: #f7e3c2;
        }

        .promotion .food-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            margin: 0;
            padding: 0;
        }

        .promotion-item {
            flex: 0 0 auto; /* Prevents items from shrinking or growing */
            width: 200px; /* Set a consistent width for items */
            background-color: white;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .promotion-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .promotion-item button, .food-item button {
            background-color: #00cc00; /* Bright Green */
            color: darkgreen;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        .promotion-item button:hover, .food-item button:hover {
            background-color: #009900; /* Darker Green on Hover */
            color: white;
        }

                /* Food Menu Styling */
                .food-section {
            margin-bottom: 30px;
            padding: 0 20px; /* Adds padding to the sides */
        }

        .food-section h3 {
            margin-bottom: 10px;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .food-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 0;
            padding-bottom: 20px;
            text-align: center;
            border: 1px solid #ccc;
        }

        .food-grid .food-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            margin: 0;
            padding: 0;
        }

        .food-item p {
            font-size: 18px;
            margin: 5px 0;
        }

        .food-item button {
            background-color: #4CAF50;
            color: darkgreen;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition for hover */
        }

        .food-item button:hover {
            background-color: #3e8e41; /* Darker green on hover */
            color: white;
        }

        .most-ordered-container {
            display: flex;
            align-items: center; /* Aligns items vertically */
            gap: 895px; /* Adjust spacing between heading and buttons */
            margin-bottom: 15px;
        }

        .category-buttons {
            display: flex;
            gap: 10px;
        }

        .category-buttons button {
            background-color: transparent;
            color: black;
            border: 3px solid black;
            font-weight: bold;
            border-width: 3px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
        }

        .category-buttons button:hover {
            background-color: #333; 
            color: #fff;
            border-color: #333; 
        }


        /* Cart Popup Styling */
        .cart-container {
            display: none; /* Initially hidden */
            position: fixed;
            top: 105px;
            right: 0;
            width: 400px;
            height: calc(100% - 140px); /* Adjust to avoid overlap with header */
            background-color: #F1EFEF;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column; /* Enable column layout */
        }

        /* Cart content */
        .cart-content {
            flex-grow: 1; /* Take available space */
            display: flex;
            flex-direction: column;
        }

        /* Cart items */
        #cart-items {
            flex-grow: 1; /* Expands to fit items */    
            overflow: hidden; /* Prevents scrolling */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cart-total {
            padding-top: 15px;
            background-color: #F1EFEF;
            position: relative; /* Default position */
            bottom: 0; /* Keep it at the bottom */
            flex-shrink: 0; /* Prevent shrinking */
        }

        .cart-item input {
            width:40px;
            margin-top: 15px;
        }

        .delete-icon {
            height:30px;
            transform: translateY(30%);
        }

        .money-bin {
            float: right;
        }

        .cart-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari, Edge */
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
            top:20px;
            cursor: pointer;
        }


        /* Menu Dropdown Styling */
        #menu-icon {
            height: 47px;
            margin-left: 15px;
            cursor: pointer;
         }

        .dropdown {
            position: relative;
            display: inline-block;
            z-index: 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            /* box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); */
            min-width: 150px;
            right: 0;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
            font-size: 16px;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }


        /* Overlay Background */
        .overlay {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark semi-transparent background */
            z-index: 20; /* Ensure it's above other elements */
        }


        /* Order Popup Styling */
        .order-container{   
            display: none; /* Ensure it remains visible */
            position: fixed;
            top: 57%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 28%;
            height: 80%;
            background-color: #F1EFEF;
            padding: 8px 12px;
            /* margin-top: 55px; */
            overflow-y:auto;
            z-index:21; /* Above the overlay */
        }

        #x-img {
            position: absolute;
            height: 30px;
            top:2%;
            left:89%;
        }

        #popup-image {
            width: 100%; /* Ensures the image spans the full width of its container */
            height: 250px; /* Set a fixed height for consistency */
            object-fit: cover; /* Ensures the image retains its aspect ratio while filling the set dimensions */
        }

        .order-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari, Edge */
        }
        
        .order-container h3 {
            display: inline-block;
            margin-bottom:0px;
        }

        .order-container label {
            font-weight: bold;
        }

        #popup-price {
            float:right;
            margin-top: 20px;
            margin-right: 10px;
            font-weight: bold;
        }
        
        #minus-img {
            height: 40px; 
            transform: translateY(0); 
            margin-right: 16px; 
            margin-left: 5px;
        }
        
        #add-img {
            height: 51px; 
            transform: translateY(5px);
        }

        .order-container textarea {
            display: none;
            height: 20%; 
            width:98%;
        }

        #input-num {
            width: 30px; 
            height:30px; 
            border-radius: 5px; 
            margin-right: 16px;
            text-align: center; 
            font-weight:bold; 
            font-size: 22px;
        }
         
        

        .order-container select {
            display: none;
            height: 6%; 
            width:99%;
        }

        .order-container button {
            background-color: #00cc00;
            border-radius: 40px;
            margin-left: 98px;
            height: 40px;
            width: 150px;
            margin-bottom: 16px;
            color: white;
            font-weight: bold;
            border: none;
            transform: translateY(-10%);
        } 

        .order-container [type='number']::-webkit-inner-spin-button, 
        .order-container [type='number']::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            margin: 0;
        }
        
        #paymentLoadingAlertContainer {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 170px;
            background-color: yellow;
            z-index: 30;
            border-radius: 10px;
        }
        #paymentLoadingAlert {
            width: 300px;
            height: 170px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: transparent;
            border-radius: 50%;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            margin-top: 20px;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        } 
        .center-container {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Adjust based on your needs */
        }
        #preference-btn {
            height: 10px;
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
                if (cartPopup.style.display === "block") cartPopup.style.display = "none";
                else cartPopup.style.display = "block"; // toggle showing the cart popup
            });

            // Close cart when clicking the close button
            closeCart.addEventListener("click", function() {
                cartPopup.style.display = "none";
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".category-buttons a").forEach(anchor => {
                anchor.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent default anchor behavior
                    const targetId = this.getAttribute("href").substring(1); // Remove #
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        const navbarHeight = document.querySelector("header").offsetHeight; // Get navbar height
                        window.scrollTo({
                            top: targetElement.offsetTop - navbarHeight - 20, // Adjust with extra space
                            behavior: "smooth"
                        });
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const menuIcon = document.getElementById("menu-icon");
            const dropdownMenu = document.querySelector(".dropdown-menu");

            menuIcon.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevents click from bubbling to the document
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            });

            // Close dropdown when clicking on any dropdown option
            const dropdownLinks = document.querySelectorAll(".dropdown-menu a");
            dropdownLinks.forEach(link => {
                link.addEventListener("click", function () {
                    dropdownMenu.style.display = "none"; // Close the dropdown when an option is clicked
                });
            });

            // Hide dropdown when clicking outside of it
            document.addEventListener("click", function (event) {
                if (!menuIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = "none";
                }
            });
        });
    </script>
    
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

            <?php if (isset($_SESSION['username'])): ?>
                <span>👤 <?php echo $_SESSION['username']; ?> | ⭐ Points: <strong><?php echo $_SESSION['points']; ?></strong></span>
                <a href="src/php/logout.php" class="head-order-button">Logout</a>
            <?php else: ?>
                <a href="login.php" class="head-order-button">Login</a>
            <?php endif; ?>

            <a href="#" class="icon-link">
                <div class="icon-container">
                    <img src="image/Ellipse 1.png" alt="Circle" class="background-circle">
                    <img src="image/Vector.png" alt="Cart Icon" class="cart-icon">
                </div>
            </a>
        </nav>

    </header>

    <!-- Promotion Section -->
    <div class="container">
        <div class="promotion">
            <h2>Monthly Promotion</h2>
            <p>Up to 60% off for this Month!</p>
            <div class="promotion-items">
                <div class="promotion-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/lamb_curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10 (50% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/lamb_curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10 (50% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button>Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button>Add</button>
                </div>
            </div>
        </div>
        <!-- Points Menu Section -->
        <div class="points-menu">
            <h2>Redeem with Points</h2>
            <p>Use your points to get free items!</p>
            <div class="points-items">
                <div class="points-item selected">
                    <img src="image/coke.webp" alt="Coke">
                    <p>Coke</p>
                    <span class="points-badge">175 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/sprite.webp" alt="Sprite">
                    <p>Sprite</p>
                    <span class="points-badge">175 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/beer.webp" alt="Beer">
                    <p>Beer</p>
                    <span class="points-badge">500 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/wine.webp" alt="Wine">
                    <p>Wine</p>
                    <span class="points-badge">1000 pt</span>
                </div>
            </div>
        </div>

        <!-- Food Menu Section -->
        <div class="food-section">
            <h3>Food Menu</h3>
            <div class="most-ordered-container">
            <h1>Most Ordered</h1>
                <div class="category-buttons">
                    <a href="#beef">
                    <button>Beef</button>
                    </a>
                    <a href="#pork">
                    <button>Pork</button>
                    </a>
                    <a href="#lamb">
                    <button>Lamb</button>
                    </a>
                    <div class="dropdown">
                        <img id="menu-icon" src="image/menu.png">
                        <div class="dropdown-menu">
                            <a href="#beef">Beef</a>
                            <a href="#pork">Pork</a>
                            <a href="#lamb">Lamb</a>
                            <a href="#dessert">Dessert</a>
                            <a href="#drinks">Drinks</a>
                        </div>
                    </div>
                </div>
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

        <div class="food-section" id="beef">
            <h1>Beef</h1>
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

        <div class="food-section" id="pork">
            <h1>Pork</h1>
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

        <div class="food-section" id="lamb">
            <h1>Lamb</h1>
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

        <div class="food-section" id="dessert">
            <h1>Dessert</h1>
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

        <div class="food-section" id="drinks">
            <h1>Drinks</h1>
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

    <div id="cart-popup" class="cart-container" style="display: flex">
        <div class="cart-content">
            <div style="position: relative; display: flex; justify-content: space-between;">
                <h1 style="text-align: center;  flex-grow: 1 ; border-bottom: 2px solid black; padding-bottom: 10px;">Your Cart</h1>
                <img src="image/back.png" class="close-cart"></img>  
                  
            </div>
        
            <div id="cart-items">
                <p>No items added</p>
            </div>
            <div class="cart-total">
            <hr style="height:2px; border:none; background-color: #333;">
                <p><strong>Subtotal:</strong> $<span id="subtotal">0.00</span></p>
                <p><strong>GST (inclusive):</strong> $<span id="gst">0.00</span></p>
                <p><strong>Total:</strong> $<span id="total">0.00</span></p>
            <form method="POST" action="src/php/checkout.php" id="goToPayment">
                <button class="checkout-btn" type="submit">Payment</button>
            </form>
            </div>
        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <div id="food-popup" class="order-container">
        <img id="x-img" src="image/x-img.png" onclick="closePopup()">
        <img id="popup-image" src="" alt="Food Image">
        <h3 id="popup-title"></h3>
        <span id="popup-price"></span>
        <p id="popup-description"></p>
        <label>Size:</label><br>
        <input type="radio" name="size" value="large">Large<br>
        <input type="radio" name="size" value="medium">Medium<br>    
        <input type="radio" name="size" value="small" checked>Small<br><br>
        <label>How would you like your steak?</label><br>
        <input type="radio" name="meat-type" value="well" checked>Well<br>
        <input type="radio" name="meat-type" value="medium well">Medium Well<br>      
        <input type="radio" name="meat-type" value="medium">Medium<br>
        <input type="radio" name="meat-type" value="medium rare">Medium Rare<br>      
        <input type="radio" name="meat-type" value="rare">Rare<br><br>
        <div style="display:flex;">
        <label>Preference</label>
        <span style="color: grey; margin-left: 60%; margin-right:auto">(Optional)</span>
        <img id="preference-btn" style=" transform: translateY(5px);margin-right:auto;" src="image/down_arrow.png">
        </div>
        <textarea id="preference-text"></textarea><br><br>
        <label id="items-unavailable"></label><br>
        <select>
            <option>Refund items</option>   
            <option>Contact Stuff</option>
        </select><br>
        <div style="display: flex; align-items: center;  transform: translateY(110px);">
            <img id="minus-img" src="image/minus.png" onclick="minusValue()">
            <input id="input-num" type="number" value="1" style="width: 50px; text-align: center;">
            <img id="add-img" src="image/add.png" onclick="addValue()">
            <button onclick="addToCart()" style=" transform: translateY(5px); margin-left: 40%;">Add to Cart</button>
        </div>

    </div>
    <div id="paymentLoadingAlertContainer" style="display: none">
        <div id="paymentLoadingAlert">
        <div>Loading Payment...</div>
        <span class="loader"></span>
        </div>
    </div>
    <script>
        document.getElementById('goToPayment').addEventListener('submit', function(e) {
            e.preventDefault();

            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'checkout_data';
            input.value = JSON.stringify(cart);
            
            this.appendChild(input);
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('paymentLoadingAlertContainer').style.display = 'flex';
            setTimeout(() => {
                this.submit();
                setTimeout(() => {
                    input.remove();
                }, 1);
            }, 1);
        });
        function getJsonFromLocalStrorage() {
            if (localStorage.getItem("cart") !== null) {
                cart = JSON.parse(localStorage.getItem("cart"));
                updateCartDisplay();
            }
        }
        getJsonFromLocalStrorage();
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('paymentLoadingAlertContainer').style.display = 'none'; 
        // hide overlay and loading payment alert if user presses back on back button
    </script>
</body> 
</html>