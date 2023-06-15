<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

// Fungsi untuk mendapatkan detail produk berdasarkan ID
function getProdukDetail($id)
{
    global $koneksi;
    $query = "SELECT * FROM produk WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    $produkDetail = mysqli_fetch_assoc($result);
    return $produkDetail;
}

// Proses form edit produk
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    ubahProduk($id, $nama, $harga, $stok);
    header("Location: admin.php");
    exit;
}

$produkDetail = getProdukDetail($id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form method="post" action="edit_produk.php">
        <input type="hidden" name="id" value="<?= $produkDetail['id']; ?>">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?= $produkDetail['nama']; ?>" required>
        <br>
        <label for="harga">Harga:</label>
        <input type="text" name="harga" id="harga" value="<?= $produkDetail['harga']; ?>" required>
        <br>
        <label for="stok">Stok:</label>
        <input type="text" name="stok" id="stok" value="<?= $produkDetail['stok']; ?>" required>
        <br>
        <input type="submit" name="ubah" value="Simpan">
    </form>
</body>
</html>
