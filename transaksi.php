<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submission to add a new transaction
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $date = date('Y-m-d');

    $file = fopen('data/transactions.txt', 'a');
    fwrite($file, "$product_name|$quantity|$price|$date\n");
    fclose($file);

    header("Location: transactions.php");
    exit();
}

// Fetch all transactions
$transactions = getAllTransactions();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Transactions</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Transactions</h1>
        
        <!-- Form to add a new transaction -->
        <div class="form-container">
            <h2>Add New Transaction</h2>
            <form method="POST" action="">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" required>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
                <label for="price">Price:</label>
                <input type="number" name="price" step="0.01" required>
                <button type="submit" class="btn">Add Transaction</button>
            </form>
        </div>

        <!-- Table to display all transactions -->
        <h2>All Transactions</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['price']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
