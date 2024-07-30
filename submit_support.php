<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $issue = $_POST['issue'];
    saveSupportRequest($_SESSION['username'], $issue);
    $message = "Support request submitted successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Support Request Submitted</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Support Request Submitted</h1>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <a href="user.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
