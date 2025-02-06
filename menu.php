<?php
    session_start();
    require "src/php/db.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Menu Page</title>
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
            justify-content: space-between; /* Makes the heading and buttons adjust dynamically */
            margin-bottom: 15px;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
        }

        .category-buttons {
            display: flex;
            gap: 10px;
            flex-direction: row;
            flex-wrap: wrap; /* Wraps buttons to new lines if screen is too small */
        }

        .category-buttons button {
            background-color: transparent;
            color: black;
            border: 3px solid black;
            font-weight: bold;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px; /* Slightly reduce font size for better scaling */
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
            height:20%; 
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

        .order-label {
            font-weight: bold;
        }
        

        /* Points Menu Styling */
        .points-menu {
            background-color: #f5e7d3;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #bda98f;
            text-align: center;
        }

        .points-menu h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .points-items {
            display: flex;
            gap: 15px;
            overflow-x: auto; /* Enables horizontal scrolling */
            overflow-y: visible; /* Allows items to expand properly */
            scroll-behavior: smooth;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-top: 10px; /* Adds extra space on top */
        }

        .points-items::-webkit-scrollbar {
            height: 8px;
        }

        .points-items::-webkit-scrollbar-thumb {
            background-color: #bda98f;
            border-radius: 10px;
        }

        .points-items::-webkit-scrollbar-track {
            background-color: #f5e7d3;
        }

        .points-item {
            flex: 0 0 auto;
            width: 180px; /* Adjust size */
            background-color: #fdfdfd;
            border-radius: 8px;
            text-align: center;
            border: 2px solid #ddd;
            padding: 15px 0;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .points-item img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .points-item p {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        /* Points Badge */
        .points-badge {
            display: inline-block;
            background-color: #00cc00;
            color: beige;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 20px;
            margin-top: 8px;
            border: none;
        }

        /* Highlight Selected Item */
        .points-item:hover {
            border: 2px solid #0066ff; /* Blue border on hover */
            box-shadow: 0 0 10px rgba(0, 102, 255, 0.4);
            transform: scale(1.08); /* Slightly larger scaling to match effect */
            z-index: 10; /* Ensures it appears above other elements */
            position: relative; /* Makes sure it doesn't get cut off */
        }
        span.points-badge:hover {
            cursor: pointer;
            color: #000;
            background-color: #00ee00;
        }
    </style>
    <script>
        let currPoints = null;
        let username = null;
    </script>
    <?php 
        if (isset($_SESSION['points']) && isset($_SESSION['username'])) {
            echo "<script>currPoints = " . $_SESSION['points']  . ";";
            echo "username = " . "'". $_SESSION['username'] . "';". "</script>"; // "'" to put quote marks around username
        } else {
            echo "<script>localStorage.getItem('pts') = null;</script>";
        }
    ?>
    <script>
        if (localStorage.getItem("pts")) currPoints = localStorage.getItem("pts");
        const btnPayWithPoints = document.getElementsByClassName("points-item");
        let pointsArr = [175, 175, 500, 1000];
        let isPayingWithPoints = false;
        let currPointsPrice = 0;
        let prevInputNum = 1; // default is 1
        function openPopupWithPoints(i) {
            if (!currPoints || currPoints < pointsArr[i]) return;
            openPopup(i + 17); // offset to just promo drinks
            currPointsPrice = pointsArr[i];
            isPayingWithPoints = true;
            document.getElementById('popup-price').textContent = pointsArr[i] + "pt";
            document.getElementById('popup-price').style.color = "#00DD00";
        }
        function onPointsChange() {
                const userPoints = document.getElementById('user-and-pts');
                if (userPoints) {
                    const justPoints = getPts(userPoints);
                    if (justPoints !== currPoints) {
                        userPoints.innerHTML = `👤 ${username} | ⭐ Points: ${currPoints}`;
                    } 
                }
            }
        function getPts(userPoints) {
            let pts = "";
            let i = userPoints.textContent.indexOf(":");
            while (++i < userPoints.textContent.length) {
                pts += userPoints[i];
            }
            return Number(pts);
        }
        document.addEventListener("DOMContentLoaded", function() {
            onPointsChange();
            const cartIcon = document.querySelector(".icon-link"); // Cart button
            const cartPopup = document.getElementById("cart-popup"); // Cart popup
            const closeCart = document.querySelector(".close-cart"); // Close button

            // Show cart when clicking the cart icon
            cartIcon.addEventListener("click", function(event) {
                event.preventDefault();
                if (cartPopup.style.display === "flex") cartPopup.style.display = "none";
                else cartPopup.style.display = "flex"; // toggle showing the cart popup
            });

            // Close cart when clicking the close button
            closeCart.addEventListener("click", function() {
                cartPopup.style.display = "none";
            });


            const menuIcon = document.getElementById("menu-icon");
            const dropdownMenu = document.querySelector(".dropdown-menu");

            menuIcon.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevents click from bubbling to the document
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            });

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

            //Hide textbox and select until user press the down arrow
            const textarea= document.querySelector('textarea');
            const select = document.querySelector('select');
            const button = document.querySelector('#preference-btn');
            const label = document.getElementById('items-unavailable');

            button.addEventListener("click", function(){
                if (textarea.style.display === "none" || select.style.display === "none"){
                    textarea.style.display = "block";
                    select.style.display = "block";
                    label.innerText = "If items unavailable";
                }
                else {
                    textarea.style.display = "none";
                    select.style.display = "none";
                    label.innerText = "";
                }
            });
        });

        const foodItems = [
            { category: "steak", title: "Wagyu Beef", description:"sautéed spinach, chimichurri sauce", price: "$50.85", img: "image/wagyu_beef.jpg" },
            { category: "salad", title: "Dong Po Rou", description:"ginger, light soy sauce, dark soy sauce, shaoxing wine, spring onion", price: "$29.99", img: "image/Dong_Po_Rou.jpg" },
            { category: "salad", title: "Short Rib Ragu", description:"ragu sauce, garlic, celery, tomatoes, red wine, olive oil", price: "$29.99", img: "image/short_rib_ragu.jpg" },
            { category: "salad", title: "Steak and Charred Pear Salad", description:"pears, blue cheese, walnuts, vineger, olive oil", price: "$18.19", img: "image/steak_pear.jpg" },
            { category: "salad", title: "Braised Pork", description:"onion, garlic, soy sauce, vineger,bay leaves", price: "$29.99", img: "image/braised_pork.jpg" },
            { category: "salad", title: "Lamb Curry", description:"onion, garlic, ginger, tomatoes, cocout milk, coriander, curry powder, bay leaves", price: "$19.10", img: "image/lamb_curry.jpg" },
            { category: "steak", title: "Seared Lamb with Smoky Slather", description:"smoked paprika, garlic, olive oil, lemon juice, cumin, fresh herbs", price: "$29.99", img: "image/seared_lamb.jpg" },
            { category: "steak", title: "Roasted Lamb Leg", description:"garlic, olive oil, fresh rosemary, fresh thyme, lemon juice", price: "$29.99", img: "image/roasted_lamb_leg.webp" },
            { category: "dessert", title: "Italian Tiramisu", description:"cocoa powder, brewed espresso, whipping cream, mascarpone cheese", price: "$7.10", img: "image/italian_tiramisu.avif" },
            { category: "dessert", title: "Crème Brûlée", description:"heavy cream, egg, vanilla extract", price: "$8.15", img: "image/creme_brulee.jpg" },
            { category: "dessert", title: "Oreo Dirt Pudding", description:"crushed oreo cookies, cream cheese, butter, milk, vanilla pudding, cool whip", price: "$5.80", img: "image/oreo_dirt_pudding.jpg" },
            { category: "dessert", title: "Paganini Strawberry", description:"fresh strawberries, whipping cream, vanilla extract, gelatin", price: "$8.50", img: "image/paganini_strawberry.jpg" },
            { category: "drinks", title: "Coke", description:"", price: "$3.20", img: "image/coke.webp" },
            { category: "drinks", title: "Sprite", description:"", price: "$3.20", img: "image/sprite.webp" },
            { category: "drinks", title: "Beer", description:"", price: "$15.80", img: "image/beer.webp" },
            { category: "drinks", title: "Wine", description:"", price: "$50.80", img: "image/wine.webp" },
            { category: "steak", title: "Beef Carpaccio", description:"olive oil, lemon juice, shaved parmesan cheese", price: "$21.20", img: "image/beef_carpaccio.jpg" },
            { category: "drinks", title: "Coke(points redeemed)", description:"", price: "$0", img: "image/coke.webp" },
            { category: "drinks", title: "Sprite(points redeemed)", description:"", price: "$0", img: "image/sprite.webp" },
            { category: "drinks", title: "Beer(points redeemed)", description:"", price: "$0", img: "image/beer.webp" },
            { category: "drinks", title: "Wine(points redeemed)", description:"", price: "$0", img: "image/wine.webp" },
        ];

        function openPopup(index) {
            prevInputNum = 1;
            const item = foodItems[index]; // Get item by index
            document.getElementById('popup-title').textContent = item.title;
            document.getElementById('popup-description').textContent = item.description;
            document.getElementById('popup-price').textContent = item.price;
            document.getElementById('popup-image').src = item.img;
            document.getElementById('food-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block'; // Show overlay
            document.body.style.overflow = 'hidden';

            //Reset size selection to default ("small")
            document.querySelector("input[name='size'][value='small']").checked = true;

            //Reset meat type selection to default ("well")
            let defaultMeatOption = document.querySelector("input[name='meat-type'][value='well']");
            if (defaultMeatOption) {
                defaultMeatOption.checked = true;
            }

            // Get popup elements   
            let category = item.category;
            let popup = document.getElementById("food-popup");
            let sizeLabel = document.getElementById("size");
            let sizeOptions = document.querySelectorAll("input[name='size']");
            let preferenceText = document.getElementById("preference");
            let meattype = document.getElementById("meattype-div");

            // Reset all fields to default state
            sizeLabel.style.display = "initial";
            sizeLabel.style.display = "initial";
            sizeOptions.forEach(option => option.closest('label').style.display = "initial");
            meattype.style.display = "initial";
            document.getElementById("preference").style.display = "flex";
            document.getElementById("add-to-cart").style.display = "flex";
            
            // Customize the popup based on category
            if (category === "drinks" || category === "dessert") {
                // Hide size and meat options, only show preference
                meattype.style.display = "none";
                sizeLabel.style.display = "none";
                sizeOptions.forEach(option => option.closest('label').style.display = "none");
            } else if (category === "salad") {
                // Hide meat type, but show size
                meattype.style.display = "none";
            }
        }

        function closePopup() {
            document.getElementById('food-popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none'; // Show overlay
            document.body.style.overflow = 'auto';

            document.getElementById("input-num").value = 1;
        }

        function addValue() {
            var count = document.getElementById("input-num");
            if (isPayingWithPoints) {
                if (currPointsPrice * (Number(count.value) + 1) > currPoints) return;
            }
            count.value = Number(count.value) + 1;
        }

        function minusValue() {
        let count = document.getElementById("input-num");
            if (Number(count.value) > 1) { // Prevents negative values
                count.value = Number(count.value) - 1;  
            }
        }

        //Update cart after "add to cart"
        let cart = []; // Array to store cart items

        function addToCart() {
            isPayingWithPoints = false;
            let title = document.getElementById("popup-title").textContent;
            let basePrice = 0;
            if (document.getElementById("popup-price").textContent.endsWith("pt") === false) basePrice = parseFloat(document.getElementById("popup-price").textContent.replace('$', '')); // Convert price to number
            let quantity = Number(document.getElementById("input-num").value);
            let sizeDiv = document.getElementById("size");
            let meatDiv = document.getElementById("meattype-div");


            // Get selected size only if the sizeDiv is visible
            var size = "N/A";
            if (sizeDiv.style.display !== "none") {
                let selectedSize = document.querySelector('input[name="size"]:checked');
                size = selectedSize ? selectedSize.value : "N/A";
            }

            // Get selected meat type only if the meatDiv is visible
            var meatType = "N/A";
            if (meatDiv.style.display !== "none") {
                let selectedMeat = document.querySelector('input[name="meat-type"]:checked');
                meatType = selectedMeat ? selectedMeat.value : "N/A";
            }

            // Get preference from textarea
            var preference = document.getElementById("preference-text").value.trim();
            preference = preference ? preference : "None"; // Default to "None" if empty

            // Define additional price for each size
            let sizePriceMap = {
                "large": 15.45,
                "medium": 5.75,
                "small": 0.00
            };

            // Get the additional price based on size
            let additionalPrice = sizePriceMap[size] || 0; // Default to 0 if no match

            // Calculate final price
            let pointsPrice = 0;
            let finalPrice = additionalPrice + basePrice;
            if (basePrice === 0) { // If it's a free item
                let itemIndex = foodItems.findIndex(item => item.title === title);
                if (itemIndex !== -1 && itemIndex >= 17) {
                    pointsPrice = pointsArr[itemIndex - 17]; // Ensure valid pointsPrice
                }
                finalPrice = 0; // Ensure free item price remains 0
                currPoints -= pointsPrice * quantity;
            }

            // Check if item already exists with same options
            let existingItem = cart.find(item => 
                item.title === title && 
                item.size === size && 
                item.meatType === meatType &&
                item.preference === preference &&
                item.price[1] === pointsPrice
            );
            
            if (existingItem) {
                existingItem.quantity += quantity; // Increase quantity if item already exists
            } else {
                cart.push({ title, price: [finalPrice, pointsPrice], quantity, size, meatType, preference }); // Add new item
            }

            updateCartDisplay();
            closePopup(); // Close food selection popup
            localStorage.setItem("cart", JSON.stringify(cart));
            localStorage.setItem("pts", currPoints);
            onPointsChange();
        }

        function updateCartDisplay() {
            let cartItemsContainer = document.getElementById("cart-items");
            let subtotalElement = document.getElementById("subtotal");
            let gstElement = document.getElementById("gst");
            let totalElement = document.getElementById("total");

            cartItemsContainer.innerHTML = ""; // Clear previous items
            let subtotal = 0;

            cart.forEach((item, index) => {
                let itemTotal = item.price[0] !== 0 ? item.price[0] * item.quantity : 0;
                subtotal += itemTotal;

                // Start constructing the cart item display dynamically
                let cartItemHTML = `<div class="cart-item">
                    <span style="font-weight:bold">${item.title}</span><br>`;

                // Display size only if it's not empty or "Default"
                if (item.size && item.size !== "N/A") {
                    cartItemHTML += `<span style="font-size:14px">Size: ${item.size}</span><br>`;
                }

                // Display meat type only if it's not "N/A"
                if (item.meatType && item.meatType !== "N/A") {
                    cartItemHTML += `<span style="font-size:14px;">Meat Type: ${item.meatType}</span><br>`;
                }

                // Display preference only if it's not "None"
                if (item.preference && item.preference !== "None") {
                    cartItemHTML += `<span style="font-size:14px;">Preference: ${item.preference}</span><br>`;
                }

                cartItemHTML += `
                    <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)" onkeyup="handleEnter(event, ${index}, this.value, 0)">
                    <div class="money-bin">
                        <span>$${(itemTotal).toFixed(2)}</span>
                        <img src="image/rubbish.png" class="delete-icon" onclick="removeFromCart(${index})">
                    </div>
                </div>`;

                cartItemsContainer.innerHTML += cartItemHTML;
            });

            // Update subtotal, GST, and total
            subtotalElement.textContent = `${subtotal.toFixed(2)}`;
            let gst = subtotal * 0.09; // Assuming 10% GST
            gstElement.textContent = `${gst.toFixed(2)}`;
            totalElement.textContent = `${(subtotal + gst).toFixed(2)}`;
        }

        function updateQuantity(index, newQuantity) {
            newQuantity = Math.floor(Number(newQuantity)); // Ensure integer
            let prevQuantity = cart[index].quantity;
            if (currPoints - (newQuantity * cart[index].price[1]) < 0) newQuantity = prevQuantity;
            if (newQuantity <= 0) newQuantity = prevQuantity;
            cart[index].quantity = newQuantity;

            if (cart[index].price[1] !== 0 && currPoints) {
                currPoints += (prevQuantity - newQuantity) * cart[index].price[1];
            }

            updateCartDisplay();
            localStorage.setItem("cart", JSON.stringify(cart));
            localStorage.setItem("pts", currPoints);
            onPointsChange();
        }

        function handleEnter(event, index, value, n) {
            if (event.key === "Enter") {
                if (n === 0) updateQuantity(index, value);
                else if (n === 1) updateInputNum(value);
                event.target.blur();
            }
        }

        function updateInputNum(val) { 
            val = Math.floor(Number(val));
            if (val <= 0) val = prevInputNum;
            if (currPoints - (val * currPointsPrice) < 0) val = prevInputNum;
            document.getElementById('input-num').value = val;
            prevInputNum = val;
        }
        function removeFromCart(index) {
            const pointsUsed = cart[index].price[1] ? cart[index].price[1]*cart[index].quantity : 0;
            currPoints += pointsUsed;
            cart.splice(index, 1);
            updateCartDisplay();
            localStorage.setItem("cart", JSON.stringify(cart));
            localStorage.setItem("pts", currPoints);
            onPointsChange();
        }
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
            <?php
            // Get items if an order exists
            $items = [];
            if (isset($_SESSION['order_id'])) {
                $items = getItem($pdo);
            }
            ?>
            <?php if (isset($_SESSION['order_id']) && (!empty($items))):?>
                <a href="receipt.php">View Receipt</a>
            <?php endif ?>
            <?php if (isset($_SESSION['username'])): ?>
                <span id="user-and-pts">👤 <?php echo $_SESSION['username']; ?> | ⭐ Points: <strong><?php echo $_SESSION['points']; ?></strong></span>
                <a href="src/php/logout.php" class="head-order-button">Logout</a>
            <?php else: ?>
                <a href="menu.php" class="head-order-button" style="text-decoration: underline;">Order Here</a>
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
                    <button onclick="openPopup(0)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button onclick="openPopup(16)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/lamb_curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10 (50% off)</p>
                    <button onclick="openPopup(5)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button onclick="openPopup(16)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button onclick="openPopup(16)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/lamb_curry.jpg" alt="Lamb Curry">
                    <p>Lamb Curry</p>
                    <p>$19.10 (50% off)</p>
                    <button onclick="openPopup(6)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/wagyu_beef.jpg" alt="Wagyu Beef">
                    <p>Wagyu Beef</p>
                    <p>$50.85 (60% off)</p>
                    <button onclick="openPopup(0)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button onclick="openPopup(16)">Add</button>
                </div>
                <div class="promotion-item">
                    <img src="image/beef_carpaccio.jpg" alt="Beef Carpaccio">
                    <p>Beef Carpaccio</p>
                    <p>$21.20 (40% off)</p>
                    <button onclick="openPopup(16)">Add</button>
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
                    <span class="points-badge" onclick="openPopupWithPoints(0)">175 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/sprite.webp" alt="Sprite">
                    <p>Sprite</p>
                    <span class="points-badge" onclick="openPopupWithPoints(1)">175 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/beer.webp" alt="Beer">
                    <p>Beer</p>
                    <span class="points-badge" onclick="openPopupWithPoints(2)">500 pt</span>
                </div>
                <div class="points-item">
                    <img src="image/wine.webp" alt="Wine">
                    <p>Wine</p>
                    <span class="points-badge" onclick="openPopupWithPoints(3)">1000 pt</span>
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
                    <button onclick="openPopup(0)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/Dong_Po_Rou.jpg" alt="Dong Po Rou">
                    <p>Dong Po Rou</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(1)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/short_rib_ragu.jpg" alt="Short Rib Ragu">
                    <p>Short Rib Ragu</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(2)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/steak_pear.jpg" alt="Steak and Charred Pear Salad">
                    <p>Steak and Charred Pear Salad</p>
                    <p>$18.19</p>
                    <button onclick="openPopup(3)">Add</button>
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
                    <button onclick="openPopup(0)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/steak_pear.jpg" alt="Steak and Charred Pear Salad">
                    <p>Steak and Charred Pear Salad</p>
                    <p>$18.19</p>
                    <button onclick="openPopup(3)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/short_rib_ragu.jpg" alt="Short Rib Ragu">
                    <p>Short Rib Ragu</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(2)">Add</button>
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
                    <button onclick="openPopup(1)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/braised_pork.jpg" alt="Braised Pork">
                    <p>Braised Pork</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(4)">Add</button>
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
                    <button onclick="openPopup(5)">Add</button> 
                </div>
                <div class="food-item">
                    <img src="image/seared_lamb.jpg" alt="Seared Lamb with Smoky Slather">
                    <p>Seared Lamb with Smoky Slather</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(6)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/roasted_lamb_leg.webp" alt="Roasted Lamb Leg">
                    <p>Roasted Lamb Leg</p>
                    <p>$29.99</p>
                    <button onclick="openPopup(7)">Add</button>
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
                    <button onclick="openPopup(8)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/creme_brulee.jpg" alt="Crème Brûlée">
                    <p>Crème Brûlée</p>
                    <p>$8.15</p>
                    <button onclick="openPopup(9)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/oreo_dirt_pudding.jpg" alt="Oreo Dirt Pudding">
                    <p>Oreo Dirt Pudding</p>
                    <p>$5.80</p>
                    <button onclick="openPopup(10)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/paganini_strawberry.jpg" alt="Paganini Strawberry">
                    <p>Paganini Strawberry</p>
                    <p>$8.50</p>
                    <button onclick="openPopup(11)">Add</button>
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
                    <button onclick="openPopup(12)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/sprite.webp" alt="Sprite">
                    <p>Sprite</p>
                    <p>$3.20</p>
                    <button onclick="openPopup(13)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/beer.webp" alt="Beer">
                    <p>Beer</p>
                    <p>$15.80</p>
                    <button onclick="openPopup(14)">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/wine.webp" alt="Wine">
                    <p>Wine</p>
                    <p>$50.80</p>
                    <button onclick="openPopup(15)">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Popup HTML -->
    <div id="cart-popup" class="cart-container" style="display: none">
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

    <!-- Order Popup HTML -->
    <div id="food-popup" class="order-container">
        <img id="x-img" src="image/x-img.png" onclick="closePopup()">
        <img id="popup-image" src="" alt="Food Image">
        <h3 id="popup-title"></h3>
        <span id="popup-price"></span>
        <p id="popup-description"></p>
        
        <label id="size"  class="order-label">Size:</label><br>
        <label><input type="radio" name="size" value="large"> Large <span style="margin-left:22px; font-size:14px;">+$15.45</span><br></label>
        <label><input type="radio" name="size" value="medium"> Medium <span style="margin-left:6px; font-size:14px;">+$5.75</span><br></label>  
        <label><input type="radio" name="size" value="small" checked> Small <span style="margin-left:22px; font-size:14px;">+$0.00</span><br><br></label>
        
        <div id="meattype-div">
        <label id="meat-type"  class="order-label">How would you like your steak?</label><br>
        <label><input type="radio" name="meat-type" value="well" checked> Well</label><br>
        <label><input type="radio" name="meat-type" value="medium well"> Medium Well</label><br>      
        <label><input type="radio" name="meat-type" value="medium"> Medium</label><br>
        <label><input type="radio" name="meat-type" value="medium rare">Medium Rare<label><br>      
        <label><input type="radio" name="meat-type" value="rare">Rare<label><br><br>
        </div>

        <div id="preference" style="display:flex;">
        <label  class="order-label">Preference</label>
        <span style="color: grey; margin-left: 55%; margin-right:2%;">(Optional)</span>
        <img id="preference-btn" style=" transform: translateY(5px);margin-right:auto;" src="image/down_arrow.png">
        </div>

        <textarea id="preference-text"  class="order-label" placeholder="Enter any preferences"></textarea>
        <label id="items-unavailable"></label><br>
        <select>
            <option>Refund items</option>   
            <option>Contact Stuff</option>
        </select><br>
        <div id="add-to-cart" style="display: flex; align-items: center;">
            <img id="minus-img" src="image/minus.png" onclick="minusValue()">
            <input id="input-num" type="number" value="1" style="width: 50px; text-align: center;" onchange="updateInputNum(this.value)" onkeyup="handleEnter(event, 0, this.value, 1)">
            <img id="add-img" src="image/add.png" onclick="addValue()">
            <button onclick="addToCart()" style=" transform: translateY(5px); margin-left: 20%;" id="add-to-cart">Add to Cart</button>
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
            let input2 = document.createElement('input');
            input2.type = 'hidden';
            input2.name = 'points_data';
            input2.value = currPoints;
            this.appendChild(input);
            this.appendChild(input2);
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('paymentLoadingAlertContainer').style.display = 'flex';
            sessionStorage.clear();
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