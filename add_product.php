<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    addProduct($product_name, $price);
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form method="POST" action="">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required>
            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>
            <button type="submit" class="btn">Add Product</button>
        </form>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
