<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check if the username and password are correct
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform the necessary checks and validation for username and password
    // ...

    // If the username and password are correct, set the user session variable and redirect to the dashboard page
    $_SESSION['user'] = $username;
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
