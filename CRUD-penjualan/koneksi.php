<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_penjualan';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}
?>
