<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>
        <form method="POST" action="add_product.php">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>
            <button type="submit" class="btn">Add Product</button>
        </form>
        <h2>Existing Products</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            <?php
            $products = getAllProducts();
            foreach ($products as $product) {
                echo "<tr>
                    <td>{$product['product_name']}</td>
                    <td>{$product['price']}</td>
                </tr>";
            }
            ?>
        </table>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
