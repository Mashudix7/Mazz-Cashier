<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <a href="manage_users.php" class="btn">Manage Users</a>
        <a href="reports.php" class="btn">View Reports</a>
        <a href="manage_products.php" class="btn">Manage Products</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
