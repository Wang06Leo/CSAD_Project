<?php
session_start(); // Ensure session starts at the beginning
require "db.php";

/** @var bool $isLoggingIn
 *  @var bool $isSigningIn
 * @var bool $isadmin
 *  @var object $pdo
 *  @var string $username
 *  @var string $password
 *  @var string $email */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($isLoggingIn) { // User is logging in
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['error'] = '';
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['points'] = $user['points'];

            header("Location: ../../menu.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
        }
    } else {
        $_SESSION['error'] = "Invalid username";
    }
    header("Location: ../../login.php");
    exit();
}

if ($isSigningIn) { // User is signing up
    try {
        $pdo->beginTransaction(); // Start transaction for atomicity

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Check if username already exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error'] = "Username is taken";
            header("location: ../../sign_up.php");
            exit();
        }

        // Check if email already exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error'] = "Email is taken";
            header("location: ../../sign_up.php");
            exit();
        }

        // Insert new user with 100 starting points
        $_SESSION['error'] = '';
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, points) VALUES(?, ?, ?, 100)");
        $stmt->execute([$username, $email, $password_hashed]);

        $pdo->commit(); // Commit transaction

        header('location: ../../login.php?alert=login');
        exit();
    } catch (Exception $e) {
        $pdo->rollBack(); // Rollback transaction on error
        $_SESSION['error'] = "An error occurred. Please try again.";
        header("location: ../../sign_up.php");
        exit();
    }
}
if ($isadmin) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM admin WHERE username = :username');
        $stmt->execute([':username' => $adm_username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($adm_password, $user['password'])) {
            $_SESSION['admin_user'] = $user['username'];
            header('Location: ../../admin/panel.php');
            exit();
        } else {
            $_SESSION['err'] = 'Invalid credentials';
            header('Location: index.php');
            exit();
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    $_SESSION['err'] = 'Please fill in all fields';
    header('Location: index.php');
    exit();
}
}

?>
