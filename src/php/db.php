<?php
session_start();
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
isset($_POST['username']) ? $username = $_POST['username'] : $username = NULL;
isset($_POST['email']) ? $email = $_POST['email'] : $email = NULL;
isset($_POST['password']) ? $password = $_POST['password'] : $password = NULL;
$isSigningIn = isset($username) && isset($password) && isset($email);
$isLoggingIn = isset($username) && isset($password) && !isset($email);