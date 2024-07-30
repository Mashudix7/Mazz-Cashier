<?php
session_start();
include 'functions.php';

// Pastikan hanya pengguna dengan peran 'user' yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$message = '';
$product_name = '';
$quantity = '';

// Ambil nama produk dari parameter URL jika tersedia
if (isset($_GET['product_name'])) {
    $product_name = htmlspecialchars(trim($_GET['product_name']));
}

// Proses formulir jika ada pengiriman POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = intval($_POST['quantity']);

    if ($quantity <= 0) {
        $message = "Quantity must be greater than zero.";
    } else {
        $products = getAllProducts();
        $product_found = false;
        $price_per_unit = 0;

        // Cari produk dalam daftar produk
        foreach ($products as $product) {
            if ($product['product_name'] === $product_name) {
                $price_per_unit = $product['price'];
                $product_found = true;
                break;
            }
        }

        if ($product_found) {
            $total_price = $price_per_unit * $quantity;
            if (purchaseProduct($_SESSION['username'], $product_name, $quantity, $total_price)) {
                $message = "Purchase successful! Total price: " . formatRupiah($total_price);
            } else {
                $message = "Failed to save transaction.";
            }
        } else {
            $message = "Product not found.";
        }
    }
}

// Fungsi untuk format harga dalam rupiah
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buy Product</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Buy Product</h1>
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>" readonly>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" min="1" required>
            <button type="submit" class="btn">Buy Product</button>
        </form>
        <a href="user.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
