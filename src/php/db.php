<?php
if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}
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

function addOrderToDb($items, $pdo) {
    try {
        // Insert new order
        $stmt = $pdo->prepare("INSERT INTO orders (created_at) VALUES (NOW())");
        $stmt->execute();
        $orderId = $pdo->lastInsertId();
    
        // Insert each item into order_items
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, title, price, quantity, size, meat_type, preference) 
                               VALUES (:order_id, :title, :price, :quantity, :size, :meatType, :preference)");
    
        foreach ($items as $item) {
            $stmt->execute([
                ':order_id' => $orderId,
                ':title' => $item['title'],
                ':price' => $item['price'],
                ':quantity' => $item['quantity'],
                ':size' => $item['size'],
                ':meatType' => $item['meatType'],
                ':preference' => $item['preference']
            ]);
        }
    
        return $orderId;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
function addUserPoints($points, $pdo) {
    if (!isset($_SESSION['username'])) return; // no user logged in, dont need modify db
    $stmt = $pdo->prepare("UPDATE users SET points = points + :points WHERE username = :username");
    $stmt->execute([':points' => $points, ':username' => $_SESSION['username']]);
    $stmt = $pdo->prepare("SELECT points FROM users WHERE username = :username");
    $stmt->execute([':username' => $_SESSION['username']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['points'] = $row ? $row['points'] : -1; // should not be -1, if points = -1 somewhere, error is here
}