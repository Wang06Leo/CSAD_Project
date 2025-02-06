<?php
    session_start();
    if(isset($_SESSION['username'])) {
        header('Location: main.php'); // dont allow user to go login page if logged in
        exit();
    }
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
        #alert {
            height: 150px;
            width: 250px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: yellow;
            border: 1px solid black;
            border-radius: 10px;
            z-index: 11;
            position: absolute;
        }
        #alert > span {
            text-align: center;
        }
        #alert > button {
            border: 0;
            background-color: #009900;
            width: 70px;
            height: 30px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .overlay {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark semi-transparent background */
            z-index: 10; /* Ensure it's above other elements */
        }
    </style>

    <?php
    // LOGIN USER
    $errors = array();
    if (isset($_POST['submitbtn'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if (empty($username)) {
                array_push($errors, " username");
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
    <script src="js/urlParams.js"></script>
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
            <a href="menu.php" class="head-order-button">Order Here</a>
            <a href="#" class="head-order-button" style="text-decoration: underline;" >Login</a>
            <a href="#" class="icon-link">
            <div class="icon-container">
                <img src="image/Ellipse 1.png" alt="Circle" class="background-circle">  
                <img src="image/Vector.png" alt="Cart Icon" class="cart-icon">
            </div>
        </a>
    </header>

    <!-- Login Container -->
    <div class="login-container">
        <h1>Steak</h1>
        <div class="box">Box</div>
        <form class="login-form" action="login.php" method="POST" onsubmit="return validateLoginForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" placeholder="Enter your username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter your password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
            <button type="submit" name="submitbtn">Login</button>

            <!-- Display error messages -->
            <?php if (count($errors) > 0) : ?>
            <div class="error">
                <p style="color:red;">Enter your 
                    <?php echo implode(" and ", $errors); ?>
                </p>
            </div>
            <!-- Error from server.php -->
            <?php endif; ?>
            <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') : ?>
                <div class="error">
                <p style="color:red;">
                    <?php echo $_SESSION['error'] ?>
                </p>
            </div>
            <?php endif; ?>
            <div id="error"></div>
            <p>Don’t have an account? <a href="sign_up.php">Sign up</a></p>
        </form>
    </div>
    <div id="alert" style="display: none;">
        <span>Sign up successful! Login here</span>
        <button onclick="hideAlert()">OK</button>
    </div>
    <div class="overlay"></div>
    <script src="js/form_validate.js"></script>
</body>
</html>
<?php
    $_SESSION['error'] = ''; // if user refreshes, clears php error message
?>
