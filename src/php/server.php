<?php
$host = 'localhost';
$dbname = 'restaurantDB';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
$username = "";
$email = "";
$password = "";
if (isset($_POST["username"])&& isset($_POST["password"]) && !isset($_POST["email"])) { // is logging in, no email
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute([ 'username' => $username ]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE password = :password');
        $stmt->execute([ 'password' => $password ]);
        if (password_verify($password, $stmt->fetch(PDO::FETCH_ASSOC))) header("location: menu.html");
        else {
            header("location: ../../login.html?e=p");
        }
    } else {
        header("location: ../../login.html?e=u");
    }
}
if (isset($_POST["username"])&& isset($_POST["password"]) && isset($_POST["email"])) { // is signing in
    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute([ 'username' => $username ]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        header("location: ../../sign_up.html?e=t");
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES(?, ?, ?)");
        $stmt->execute([$username, $email, $password_hashed]);
        header('location: ../../login.html');
    }
}
