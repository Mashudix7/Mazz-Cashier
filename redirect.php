<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user.php");
        exit();
    }
}
header("Location: index.html"); // Redirect to HTML page if no role is set
exit();
?>
