<?php
session_start();
include 'functions.php';

// Aktifkan pelaporan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$transactions = getAllTransactions(); // Pastikan fungsi ini ada dan benar
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sales Reports</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sales Reports</h1>
        <?php if (empty($transactions)): ?>
            <p class="message">No transactions available.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($transaction['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['quantity']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($transaction['price'], 2)); ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y, H:i', strtotime($transaction['date']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
