<?php
session_start();
include 'functions.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_GET['username'];
deleteUser($username);
header("Location: manage_users.php");
?>
