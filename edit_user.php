<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_GET['username'];
$users = getAllUsers();
$userToEdit = null;
foreach ($users as $user) {
    if ($user['username'] == $username) {
        $userToEdit = $user;
        break;
    }
}
if (!$userToEdit) {
    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="update_user.php">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $userToEdit['username']; ?>" readonly>
            <label>Password:</label>
            <input type="password" name="password" required>
            <label>Role:</label>
            <select name="role">
                <option value="user" <?php echo $userToEdit['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $userToEdit['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
            <button type="submit" class="btn">Update User</button>
        </form>
        <a href="manage_users.php" class="btn">Back to Manage Users</a>
    </div>
</body>
</html>
