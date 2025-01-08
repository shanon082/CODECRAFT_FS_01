
<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header("Location: loginhtml.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<p>Your role: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
<a href="logout.php">Logout</a>

</body>
</html>