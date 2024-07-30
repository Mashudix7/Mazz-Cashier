<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Available Products</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php
            $products = getAllProducts();
            foreach ($products as $product) {
                echo "<tr>
                    <td>{$product['product_name']}</td>
                    <td>{$product['price']}</td>
                    <td>
                        <a href='buy_product.php?product_name={$product['product_name']}' class='btn'>Buy</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <a href="user.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
