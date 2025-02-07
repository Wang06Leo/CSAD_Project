<?php
require "../src/php/db.php";
$user1 = "Hello";
$pass1 = "World";
$hashedPass1 = password_hash($pass1, PASSWORD_DEFAULT);
$user2 = "Me";
$pass2 = "verysecurepass";
$hashedPass2 = password_hash($pass2, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");
$stmt->execute([
    ':username' => $user1,
    ':password' => $hashedPass1
]);
$stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");
$stmt->execute([
    ':username' => $user2,
    ':password' => $hashedPass1
]);

echo "Admin user created successfully.";
