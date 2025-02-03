<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Page</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7e3c2;
            color: #333;
        }

        /* Header Styling */
        header {
            background-color: #a58e71;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }

        header .logo {
            font-size: 30px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }

        header .logo .box {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            border: 2px solid white;
        }

        header nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
        }

        header nav a.head-order-button {
            background-color: #00cc00;
            color: white;
            padding: 10px 20px;
        }

        header nav a:hover {
            text-decoration: underline;
        }
        header .logo #cube {
            height:40px;
            width:auto;
            transform: translateY(8px); 
        }

        /* Cart Icon Styling */
        .icon-container {
            position: relative;
            width: 50px;
            height: 50px;
            display: inline-block;
        }

        .background-circle {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .cart-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            height: 60%;
            z-index: 2;
        }

        /* Promotion Section Styling */
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

        /* Category Buttons */
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
            <a href="main.html">Home</a>
            <a href="menu.php" class="head-order-button" style="text-decoration: underline;">Order Here</a>
            <a href="login.php" class="head-order-button">Login</a>
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

    <div id="cart-popup" class="cart-container">
        <div class="cart-content">
            <h1 style="text-align: center;">Your Cart</h1>
            <img src="image/back.png" class="close-cart"></img>    
            <hr style="height:2px; border:none; background-color: #333;">
            <div id="cart-items">
                <p>No items added</p>
            </div>
            <div class="cart-total">
            <hr style="height:1px; border:none; background-color: #333;">
                <p><strong>Subtotal:</strong> $<span id="subtotal">0.00</span></p>
                <p><strong>GST (inclusive):</strong> $<span id="gst">0.00</span></p>
                <p><strong>Total:</strong> $<span id="total">0.00</span></p>
            </div>
            <button class="checkout-btn">Payment</button>
        </div>
    </div>
</body> 
</html>
</body>
</html>
