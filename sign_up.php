<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register Page</title>
    <style>
        /* Register Form Styling */
        .register-container {
            text-align: center;
            padding: 80px 20px;
        }

        .register-container h1 {
            font-size: 64px;
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .register-container .box {
            display: inline-block;
            background-color: #333;
            border: 4px solid white;
            color: white;
            font-size: 48px;
            font-weight: bold;
            padding: 10px 20px;
            margin-bottom: 40px;
        }

        .register-form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .register-form label {
            font-size: 20px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        .register-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-form button {
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

        .register-form button:hover {
            background-color: #009900;
        }

        .register-form p {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }

        .register-form a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }

        .register-form a:hover {
            text-decoration: underline;
        }

        #error {
            margin-top: 20px;
            color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            height: 0px;
            margin-top: 20px;
        }
    </style>

    <?php
    // LOGIN USER
    session_start();
    $errors = array();
    if (isset($_POST['register_user'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if (empty($username)) {
            array_push($errors, " username");
        }
        if (empty($email)){
            array_push($errors, " email");
        }
        if (empty($password)) {
            array_push($errors, " password");
        }

        if (empty($errors)){
            header('HTTp/1.1 307 Temporary Redirect');
            header('Location: src/php/server.php');
            exit();
        }
    }
    ?>
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

    <!-- Register Container -->
    <div class="register-container">
        <h1>Steak</h1>
        <div class="box">Box</div>
        <form class="register-form" action="sign_up.php" method="POST" onsubmit="return validateSignUpForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" placeholder="Enter your username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter your email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter your password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" placeholder="Confirm your password" value="<?php echo isset($_POST['confirm-password']) ? htmlspecialchars($_POST['confirm-password']) : ''; ?>">
            <!-- Display error messages -->
            <?php if (count($errors) > 0) : ?>
            <div class="error">
                <p style="color:red;">Enter your 
                    <?php echo implode(" and ", $errors); ?>
                </p>
            </div>
            <?php endif; ?>
            <!-- Error from server.php -->
            <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') : ?>
                <div class="error">
                <p style="color:red;">
                    <?php echo $_SESSION['error'] ?>
                </p>
            </div>
            <?php endif; ?>
            <button type="submit" name="register_user">Register</button>
            <div id="error"></div>
            <p>Already have an account? <a href="login.php">Sign in</a></p>
        </form>
    </div>
    <script src="js/form_validate.js"></script>
    <script src="js/urlParams.js"></script>
</body>
</html>
<?php
    $_SESSION['error'] = ''; // if user refreshes, clears php error message
?>
