<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>User Dashboard</h1>
        <a href="profile.php" class="btn">View Profile</a>
        <a href="support.php" class="btn">Request Support</a>
        <a href="view_products.php" class="btn">View Products</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
