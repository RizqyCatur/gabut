<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Fungsi untuk mendapatkan daftar produk
function getProdukList()
{
    global $koneksi;
    $query = "SELECT * FROM produk";
    $result = mysqli_query($koneksi, $query);
    $produkList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $produkList[] = $row;
    }
    return $produkList;
}

// Fungsi untuk menambahkan produk
function tambahProduk($nama, $harga, $stok)
{
    global $koneksi;
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $harga = mysqli_real_escape_string($koneksi, $harga);
    $stok = mysqli_real_escape_string($koneksi, $stok);
    $query = "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk mengubah produk
function ubahProduk($id, $nama, $harga, $stok)
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $id);
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $harga = mysqli_real_escape_string($koneksi, $harga);
    $stok = mysqli_real_escape_string($koneksi, $stok);
    $query = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus produk
function hapusProduk($id)
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $id);
    $query = "DELETE FROM produk WHERE id='$id'";
    mysqli_query($koneksi, $query);
}

// Proses form tambah produk
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    tambahProduk($nama, $harga, $stok);
    header("Location: admin.php");
    exit;
}

// Proses form ubah produk
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    ubahProduk($id, $nama, $harga, $stok);
    header("Location: admin.php");
    exit;
}

// Proses hapus produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    hapusProduk($id);
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Page</h1>
    <h2>Daftar Produk</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getProdukList() as $produk): ?>
                <tr>
                    <td><?= $produk['id']; ?></td>
                    <td><?= $produk['nama']; ?></td>
                    <td><?= $produk['harga']; ?></td>
                    <td><?= $produk['stok']; ?></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $produk['id']; ?>">Edit</a>
                        <a href="admin.php?hapus=<?= $produk['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Tambah Produk</h2>
    <form method="post" action="admin.php">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
        <br>
        <label for="harga">Harga:</label>
        <input type="text" name="harga" id="harga" required>
        <br>
        <label for="stok">Stok:</label>
        <input type="text" name="stok" id="stok" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>
