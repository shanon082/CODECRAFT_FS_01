<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    unset($_SESSION['error']);
    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: signuphtml.php");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format. Please enter a valid email.";
        header("Location: signuphtml.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email is already registered. Please use a different email.";
        header("Location: signuphtml.php");
        exit();
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Suggest alternative usernames
        $namePart = explode('@', $email)[0];
        $suggestions = [
            $namePart . rand(10, 99),
            $namePart . "_user",
            $namePart . "_2025",
            $username . rand(1, 100)
        ];

        $_SESSION['error'] = "Username already exists. Suggested usernames: ";
        foreach ($suggestions as $suggestion) {
            header( "Location: signuphtml.php");
            $_SESSION['error'] = htmlspecialchars($suggestion);
        }
        exit;
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password_hash, $role);

    if ($stmt->execute()) {
        header("Location: loginhtml.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
