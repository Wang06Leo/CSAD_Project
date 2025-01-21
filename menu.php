<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* header.css */
header {
    background-color: #a58e71;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header .logo {
    font-size: 30px;
    font-weight: bold;
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
            overflow-x: auto;
        }

        .food-item {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px; /* Increased padding for larger size */
        text-align: center;
        border: 1px solid #ccc;
        flex: 0 0 150px;
        }

        .food-item img {
        max-width: 100%;
        border-radius: 8px;
        margin-bottom: 15px; /* Slightly larger spacing between image and text */
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
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            Steak <span class="box">Box</span>
        </div>
        <nav>
            <a href="main.html">Home</a>
            <a href="login.html" class="head-order-button" style="text-decoration: underline;" >Login</a>
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
                    <img src="wagyu-beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="beef-carpaccio.jpg" alt="Beef Carpaccio">
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
                    <img src="wagyu.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="dong-po-rou.jpg" alt="Dong Po Rou">
                    <p>Dong Po Rou</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="short-rib-ragu.jpg" alt="Short Rib Ragu">
                    <p>Short Rib Ragu</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="steak-pear.jpg" alt="Steak and Charred Pear Salad">
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
                    <img src="wagyu.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="steak-pear.jpg" alt="Steak and Charred Pear Salad">
                    <p>Steak and Charred Pear Salad</p>
                    <p>$18.19</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="short-rib-ragu.jpg" alt="Short Rib Ragu">
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
                    <img src="dong-po-rou.jpg" alt="Dong Po Rou">
                    <p>Dong Po Rou</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="braised-pork.jpg" alt="Braised Pork">
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
                    <img src="lamb-curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="smoky-slather.jpg" alt="Seared Lamb with Smoky Slather">
                    <p>Seared Lamb with Smoky Slather</p>
                    <p>$29.99</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="roasted-lamb.jpg" alt="Roasted Lamb Leg">
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
                    <img src="tiramisu.jpg" alt="Italian Tiramisu">
                    <p>Italian Tiramisu</p>
                    <p>$7.10</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="creme-brulee.jpg" alt="Crème Brûlée">
                    <p>Crème Brûlée</p>
                    <p>$8.15</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="oreo-pudding.jpg" alt="Oreo Dirt Pudding">
                    <p>Oreo Dirt Pudding</p>
                    <p>$5.80</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="strawberry.jpg" alt="Paganini Strawberry">
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
                    <img src="coke.jpg" alt="Coke">
                    <p>Coke</p>
                    <p>$3.20</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="sprite.jpg" alt="Sprite">
                    <p>Sprite</p>
                    <p>$3.20</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="beer.jpg" alt="Beer">
                    <p>Beer</p>
                    <p>$15.80</p>
                    <button>Add</button>
                </div>
                <div class="food-item">
                    <img src="wine.jpg" alt="Wine">
                    <p>Wine</p>
                    <p>$50.80</p>
                    <button>Add</button>
                </div>
            </div>
        </div>
    </div>
</body>