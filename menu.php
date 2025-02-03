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
            gap: 877px; /* Adjust spacing between heading and buttons */
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
            transform: translateY(10px); 
            margin-right: 16px; 
            margin-left: 5px;
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
         
        #add-img {
            height: 51px; 
            transform: translateY(20px);
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
            { title: "Wagyu Beef", description:"sautéed spinach, chimichurri sauce", price: "$50.85", img: "image/wagyu_beef.jpg" },
            { title: "Dong Po Rou", description:"ginger, light soy sauce, dark soy sauce, shaoxing wine, spring onion", price: "$29.99", img: "image/Dong_Po_Rou.jpg" },
            { title: "Short Rib Ragu", description:"ragu sauce, garlic, celery, tomatoes, red wine, olive oil", price: "$29.99", img: "image/short_rib_ragu.jpg" },
            { title: "Steak and Charred Pear Salad", description:"pears, blue cheese, walnuts, vineger, olive oil", price: "$18.19", img: "image/steak_pear.jpg" },
            { title: "Braised Pork", description:"onion, garlic, soy sauce, vineger,bay leaves", price: "$29.99", img: "image/braised_pork.jpg" },
            { title: "Lamb Curry", description:"onion, garlic, ginger, tomatoes, cocout milk, coriander, curry powder, bay leaves", price: "$19.10", img: "image/lamb_curry.jpg" },
            { title: "Seared Lamb with Smoky Slather", description:"smoked paprika, garlic, olive oil, lemon juice, cumin, fresh herbs", price: "$29.99", img: "image/seared_lamb.jpg" },
            { title: "Roasted Lamb Leg", description:"garlic, olive oil, fresh rosemary, fresh thyme, lemon juice", price: "$29.99", img: "image/roasted_lamb_leg.webp" }
        ];

        function openPopup(index) {
            const item = foodItems[index]; // Get item by index
            document.getElementById('popup-title').textContent = item.title;
            document.getElementById('popup-description').textContent = item.description;
            document.getElementById('popup-price').textContent = item.price;
            document.getElementById('popup-image').src = item.img;
            document.getElementById('food-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block'; // Show overlay
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('food-popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none'; // Show overlay
            document.body.style.overflow = 'auto';

            document.getElementById("input-num").value = 1;
        }

        function addValue() {
            var count = document.getElementById("input-num");
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
            let title = document.getElementById("popup-title").textContent;
            let price = parseFloat(document.getElementById("popup-price").textContent.replace('$', '')); // Convert price to number
            let quantity = Number(document.getElementById("input-num").value);

            // Get selected size
            let size = document.querySelector('input[name="size"]:checked');
            size = size ? size.value : "Default";

            // Get selected meat type (if available)
            let meatType = document.querySelector('input[name="meat-type"]:checked');
            meatType = meatType ? meatType.value : "N/A";

            // Get preference from textarea
            let preference = document.getElementById("preference-text").value.trim();
            preference = preference ? preference : "None"; // If empty, set to "None"

            // Check if item already exists with same options
            let existingItem = cart.find(item => 
                item.title === title && 
                item.size === size && 
                item.meatType === meatType &&
                item.preference === preference  
            );
            
            if (existingItem) {
                existingItem.quantity += quantity; // Increase quantity if item already exists
            } else {
                cart.push({ title, price, quantity, size, meatType, preference }); // Add new item
            }

            updateCartDisplay();
            closePopup(); // Close food selection popup
        }

        function updateCartDisplay() {
            let cartItemsContainer = document.getElementById("cart-items");
            let subtotalElement = document.getElementById("subtotal");
            let gstElement = document.getElementById("gst");
            let totalElement = document.getElementById("total");

            cartItemsContainer.innerHTML = ""; // Clear previous items

            let subtotal = 0;

            cart.forEach((item, index) => {
                let itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                cartItemsContainer.innerHTML += `
                    <div class="cart-item">
                        <span style="font-weight:bold">${item.title}</span><br>
                        <span style="font-size:14px">Size: ${item.size}</span><br>
                        <span style="font-size:14px;">Meat Type: ${item.meatType}</span><br>
                        <span style="font-size:14px;">Preference: ${item.preference}</span><br>
                        <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)">
                        <div class="money-bin">
                        <span>$${(itemTotal).toFixed(2)}</span>
                        <img src="image/rubbish.png" class="delete-icon" onclick="removeFromCart(${index})">
                        </div>
                    </div>
                `;
            });

            let gst = subtotal * 0.09; // 9% GST
            let total = subtotal + gst;

            subtotalElement.textContent = subtotal.toFixed(2);
            gstElement.textContent = gst.toFixed(2);
            totalElement.textContent = total.toFixed(2);
        }

        function updateQuantity(index, newQuantity) {
            cart[index].quantity = Number(newQuantity);
            updateCartDisplay();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
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
                    <button onclick="addToCart()">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/sprite.webp" alt="Sprite">
                    <p>Sprite</p>
                    <p>$3.20</p>
                    <button onclick="addToCart()">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/beer.webp" alt="Beer">
                    <p>Beer</p>
                    <p>$15.80</p>
                    <button onclick="addToCart()">Add</button>
                </div>
                <div class="food-item">
                    <img src="image/wine.webp" alt="Wine">
                    <p>Wine</p>
                    <p>$50.80</p>
                    <button onclick="addToCart()">Add</button>
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
                <p>No item(s) added</p>
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
        <label>Preference</label>
        <span style="color: grey; margin-left: 230px;">(Optional)</span>
        <img id="preference-btn" style="height:10px; margin-left:5px;" src="image/down_arrow.png"><br>
        <textarea id="preference-text"></textarea><br><br>
        <label id="items-unavailable"></label><br>
        <select>
            <option>Refund items</option>   
            <option>Contact Stuff</option>
        </select><br>
        <img id="minus-img" src="image/minus.png" onclick="minusValue()">
        <input id="input-num" type="number" value="1">
        <img id="add-img" src="image/add.png" onclick="addValue()">
        <button onclick="addToCart()">Add to Cart</button>
    </div>
</body> 
</html>
