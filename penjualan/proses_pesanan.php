<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

// Cek koneksi
if (mysqli_connect_errno()) {
  echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
  exit();
}

// Tangkap data pesanan dari form
$produk_id = $_POST["produk_id"];
$jumlah = $_POST["jumlah"];

// Masukkan pesanan ke database
$query = "INSERT INTO pesanan (produk_id, jumlah) VALUES ('$produk_id', '$jumlah')";
if (mysqli_query($koneksi, $query)) {
  echo "Pesanan berhasil ditambahkan.";
} else {
  echo "Gagal menambahkan pesanan: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
