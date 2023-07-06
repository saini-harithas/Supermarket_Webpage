<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['logout'])) {
    // Unset the user session variable and destroy the session
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
    <form method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>
