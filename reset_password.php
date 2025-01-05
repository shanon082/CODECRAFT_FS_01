<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    $stmt = $conn->prepare("UPDATE users SET password_hash = :password_hash WHERE email = :email");
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "Password reset successfully. <a href='login.html'>Login</a>";
}
?>
