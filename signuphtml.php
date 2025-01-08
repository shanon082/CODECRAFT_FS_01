<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="login-form">
                <form action="signup.php" method="post">
                    <h2>Sign Up</h2>
                    <label for="name">User name</label>
                    <input type="name" placeholder="Enter your name" name="username" required>

                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter your email" name="email" required>

                    <label for="role">Role</label>
                    <select name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>

                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter your password" name="password"
                        required>

                    <label for="password">Confirm Password</label>
                    <input type="password" placeholder="re-enter password" name="confirm_password"
                        required>

                        <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']); 
                        }
                        ?>    

                    <button type="submit">Sign Up</button>
                </form>
            </div>

            <div class="some-info">
                <h2>Create your Account</h2>
                <p>Users account security is our first priority, please sign up
                    to contunie.</p>
                <h2>already have an account, <br>press the button below to
                    <span>connect</span></h2>
                <a href="loginhtml.php">Login</a>
            </div>
        </div>
    </body>
</html>