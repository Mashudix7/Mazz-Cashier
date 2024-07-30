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
    <title>Manage Users</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php
            $users = getAllUsers();
            foreach ($users as $user) {
                echo "<tr>
                    <td>{$user['username']}</td>
                    <td>{$user['role']}</td>
                    <td>
                        <a href='edit_user.php?username={$user['username']}' class='btn'>Edit</a>
                        <a href='delete_user.php?username={$user['username']}' class='btn'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
