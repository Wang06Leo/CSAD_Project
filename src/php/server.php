<?php
require "db.php";
/** @var bool $isLoggingIn
 *  @var bool $isSigningIn
 *  @var object $pdo
 *  @var string $username
 *  @var string $password
 *  @var string $email */
if ($isLoggingIn) { // is logging in, no email
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
        } else {
            $_SESSION['error'] = "Invalid password";
            header("Location: ../../login.php");
        }
    } else {
        $_SESSION['error'] = "Invalid username";
        header("Location: ../../login.php");
    }
    exit();
}
if ($isSigningIn) { // is signing in
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute([ 'username' => $username ]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['error'] = "Username is taken";
        header("location: ../../sign_up.php");
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([ 'email' => $email ]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error'] = "Email is taken";
            header("location: ../../sign_up.php");
        }
        else {
            $_SESSION['error'] = '';
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, points) VALUES(?, ?, ?, ?)");
            $stmt->execute([$username, $email, $password_hashed, 100]);
            header('location: ../../login.php?alert=login');
        }
    }
    exit();
}
