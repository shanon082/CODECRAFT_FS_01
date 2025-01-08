<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="some-info">
            <h2>Welcome</h2>
            <p>Users account security is our first priority, please log in to continue.</p>
            <h2>First time to visit us? <br>Press the button below to <span>register/sign up</span></h2>
            <a href="signuphtml.php">Sign Up</a>
        </div>

        <div class="login-form">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <label for="email">Email</label>
                <input type="email" placeholder="Enter your email" name="email" required>

                <label for="password">Password </label>
                <input type="password" placeholder="Enter your password" name="password" required>

                
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                }
                ?>

                <a href="forgot_password.html">Forgot password?</a>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
