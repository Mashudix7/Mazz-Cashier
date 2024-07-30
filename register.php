<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user'; // Default role is user
    addUser($username, $password, $role);
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn">Register</button>
        </form>
        <a href="index.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
