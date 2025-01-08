<?php
session_start();
require 'db.php';

unset($_SESSION['error']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: reset_passwordhtml.php");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
    $stmt->bind_param("ss", $password_hash, $email);
    $stmt->execute();

    header("Location: loginhtml.php");
}
?>
