<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $users = getAllUsers();
    $file = fopen('data/users.txt', 'w');
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            fwrite($file, "$username|$password|$role\n");
        } else {
            fwrite($file, "{$user['username']}|{$user['password']}|{$user['role']}\n");
        }
    }
    fclose($file);
    header("Location: manage_users.php");
}
?>
