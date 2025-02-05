<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Steak box</title>
    <style>

        .steak {
            font-weight: bold; 
            color: white; 
            text-transform: uppercase; 
        }

        header .box {
            display: inline-block;
            background-color: #333; 
            color: white; 
            font-size: 120px; 
            font-weight: bold; 
            padding: 0px 18px; 
            border: 9px solid white; 
            text-transform: uppercase; 
            margin-left: 300px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4e2c2;
        }

        header {
            background-image: url('image/main_img.png'); 
            background-size: cover;
            background-position: center;
            height: 600px;
            color: white;
            text-align: center;
            position: relative;
        }

        header h1 {
            font-size: 150px;
            margin: 0;
            padding-top: 150px;
            padding-right: 200px;
        }

        header nav {
            position: absolute;
            top: 10px; /* Align closer to the top */
            right: 20px; /* Align closer to the right */
            display: flex; /* Arrange links horizontally */
            align-items: center;
            gap: 15px;;
        }

        .icon-container {
            position: relative; /* Set the container as the positioning reference */
            width: 50px; /* Adjust size of the icon */
            height: 50px; /* Match the width for a perfect circle */
            display: inline-block;
        }
        .background-circle {
            position: absolute; /* Allows positioning within the container */
            top: 0;
            left: 0;
            width: 100%; /* Fill the container */
            height: 100%; /* Maintain circular shape */
            z-index: 1; /* Place behind the cart icon */
        }

        .cart-icon {
            position: absolute; /* Position within the container */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Offset to align center */
            width: 60%; /* Adjust size relative to the container */
            height: 60%; /* Keep aspect ratio */
            z-index: 2; /* Place above the circle */
        }

        .icon-link {
            display: inline-block;    
            text-decoration: none; 
        }

        header nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px; 
            font-size: 25px;
            font-weight: bold;
            background-color: transparent; 
            border: none; /* Remove any borders */
            border-radius: 5px; 
        }

        header nav a:hover {
            text-decoration: underline;
        }

        header nav a.head-order-button {
            background-color: #00cc00; 
            color: white;
            padding: 10px 20px; 
        }

        .head-order-button:hover {
            background-color: #009900;
        }

        .section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 10px;
            max-width: 3000px;
            margin-bottom: 25px;
            margin-right: 100px;
        }

        .section img {
            border-radius: 10px;
            margin-right: 75px;
            max-height: 550px;
            max-width: 800px;
            margin-left: 50px;
            margin-top: 55px;
        }

        .section div {
            max-width: 5000px;
            text-align: center;
        }

        .section h2 {
            margin: 0 0 15px;
            font-size: 60px;
        }
        .section2 {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 10px;
            max-width: 3000px;
            margin-bottom: 50px;
            margin-left: 100px;
        }

        .section2 img {
            border-radius: 10px;
            margin-left: 30px;
            max-height: 680px;
            max-width: 800px;
            margin-right: 50px;
        }

        .section2 div {
            max-width: 5000px;
            text-align: center;
            margin-right: 150px;
        }

        .section2 h2 {
            margin: 0 0 15px;
            font-size: 60px;
        }
        
        .readMore {
            background-color: transparent; 
            color: #333; 
            border: 2px solid #333; 
            padding: 10px 20px; 
            font-size: 30px; 
            font-weight: bold; 
            text-transform: uppercase; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            align-self: center;
        }

        .readMore:hover {
            background-color: #333; 
            color: #fff;
            border-color: #333; 
        }

        .favorites {
            text-align: center;
            margin: 40px 20px;
        }

        .favorites h2 {
            font-size: 70px;
        }

        .favorites .items {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .favorites .item {
            margin: 15px;
            text-align: center;
        }

        .favorites .items .item p {
            font-size: 30px;
        }

        .favorites img {
            width: 300px;
            height: 300px;
            border-radius: 10px;
        }

        .order-button {
            display: inline-block; /* Makes it behave like a button */
            background-color: #00cc00; /* Green background */
            color: white; /* White text color */
            text-decoration: none; /* Removes underline */
            padding: 15px 30px; /* Adds padding inside the button */
            font-size: 50px; /* Adjust font size */
            font-weight: bold; /* Makes the text bold */
            border-radius: 5px; /* Rounds the corners */
            text-align: center; /* Centers the text */
            transition: all 0.3s ease; /* Smooth transition for hover effects */
            margin-top: 20px; /* Adds space above the button */
        }

        .order-button:hover {
            background-color: #009900;
            text-decoration: underline;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 0;
        }

    </style>
</head>
<body>

    <header>
        <h1>Steak</h1><span class="box">Box</span>
        
        <nav>
            <a href="main.php" style="text-decoration: underline;">Home</a>
            <a href="menu.php" class="head-order-button">Order Here</a>
            <?php if (isset($_SESSION['username'])): ?>
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
    
    <section class="section">
        <img src="image/beef_wellington.avif" alt="Our Restaurant">
        <div>
            <h2 style="text-align: center;">Our Restaurant</h2>
            <p style="text-align: center; font-size: 30px;">
                Steak Box is a restaurant that serves stomach-filling dishes inspired by 4 chefs from Singapore Polytechnic. It is an all-in-one restaurant that serves food from a variety of cultures, ensuring it fits every customer’s food palate.
            </p>
        </div>
    </section>
    
    <section class="section2">
        <div>
            <h2 style="text-align: center;">Our Menu</h2>
            <p style="text-align: center; font-size: 30px;">
                Our menu consists of a variety of fine meats ranging from A5 Wagyu beef to fresh chicken. With every meat carefully sourced and imported directly, ensuring the freshness of the meat.
            </p>
            <a href="menu.php">
                <button class="readMore">View Menu</button>
            </a>
        </div>
        <img src="image/our_menu.jpg" alt="Our Menu"> 
    </section>
    
    <div class="favorites">
        <h2>Favourites</h2>
        <div class="items">
            <div class="item">
                <img src="image/Wagyu.webp" alt="Wagyu Beef"> 
                <p>Wagyu Beef</p>
            </div>
            <div class="item">
                <img src="image/mushroom_steak.jpg" alt="Mushroom Steak Burger"> 
                <p>Mushroom Steak Burger</p>
            </div>
            <div class="item">
                <img src="image/caprese_steak.jpg" alt="Caprese Steak Salad"> 
                <p>Caprese Steak Salad</p>
            </div>
            <div class="item">
                <img src="image/crispy_pork.webp" alt="Crispy Pork Belly">
                <p>Crispy Pork Belly</p>
            </div>
            <div class="item">
                <img src="image/smoked_duck.webp" alt="Tea Smoked Duck Breast"> 
                <p>Tea Smoked Duck Breast</p>
            </div>
            <div class="item">
                <img src="image/Dong_Po_Rou.jpg" alt="Dong Po Rou"> 
                <p>Dong Po Rou</p>
            </div>
        </div>
        <a href="menu.php" class="order-button">ORDER NOW!</a>
    </div>
    
    <footer>
        <p>&copy; 2025 Steak Box. All Rights Reserved.</p>
    </footer>
    
    </body>
    </html>