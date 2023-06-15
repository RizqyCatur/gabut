<?php
session_start();

$admin_username = 'admin';
$admin_password = 'admin123';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $admin_username && $password == $admin_password) {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
} else {
    echo "Login gagal. Silakan coba lagi.";
}
?>
