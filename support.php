<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Support</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Support</h1>
        <form method="POST" action="submit_support.php">
            <label for="issue">Issue:</label>
            <textarea name="issue" rows="5" required></textarea>
            <button type="submit" class="btn">Submit</button>
        </form>
        <a href="user.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
