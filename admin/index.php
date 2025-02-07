<?php
    session_start();
    if (isset($_SESSION['admin_user'])) {
        header('Location: panel.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4e2c2;
        }

        /* Header Styling */
        header {
            position: sticky;
            top: 0px;
            background-color: #a58e71;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        header .logo {
            font-size: 30px;
            font-weight: bold;
        }

        header .logo #cube {
            height:40px;
            width:auto;
            transform: translateY(8px); 
        }

        header .logo .box {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            border: 2px solid white;
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
        #error,
        .error {
            margin-top: 20px;
            color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            height: 0px;
            margin-top: 20px;
        }
        .error {
            height: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img id="cube" src="../image/cube.png">
            Steak <span class="box">Box</span>
        </div>
    </header>
    <div class="login-container">
        <h1>Steak</h1>
        <div class="box">Box</div>
        <form class="login-form" action="../src/php/server.php" method="POST" onsubmit="return validateLoginForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" placeholder="Enter your username" name="admin_user">
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter your password" name="admin_password">
            <button type="submit" name="submitbtn">Login</button>

            <!-- Display error messages -->
            <?php if (isset($_SESSION['err']) && $_SESSION['err'] !== ''): ?>
                <div class="error"><?php echo $_SESSION['err']; ?></div>
            <?php endif ?>
            <div id="error"></div>
        </form>
    </div>
    <script src="../js/form_validate.js"></script>
</body>
</html>
<?php
    $_SESSION['err'] = '';
?>