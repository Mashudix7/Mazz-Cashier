<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$users = getAllUsers();
$userProfile = null;
foreach ($users as $user) {
    if ($user['username'] == $username) {
        $userProfile = $user;
        break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Profile</h1>
        <p>Username: <?php echo $userProfile['username']; ?></p>
        <p>Role: <?php echo $userProfile['role']; ?></p>
        <a href="user.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
