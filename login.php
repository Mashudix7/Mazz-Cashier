<?php
session_start();
include 'functions.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = getAllUsers();
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            if ($user['role'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: user.php");
            }
            exit();
        }
    }
    $message = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <a href="index.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
