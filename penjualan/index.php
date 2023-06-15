<!DOCTYPE html>
<html>
<head>
  <title>Website Penjualan</title>
</head>
<body>
  <h1>Website Penjualan</h1>

  <?php
  // Koneksi ke database
  $koneksi = mysqli_connect("localhost", "root", "", "penjualan");

  // Cek koneksi
  if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
  }

  // Ambil daftar produk
  $query = "SELECT * FROM produk";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<h2>Daftar Produk</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<li>" . $row["nama"] . " - Rp " . $row["harga"] . "</li>";
    }
    echo "</ul>";
  } else {
    echo "Tidak ada produk.";
  }

  // Tampilkan form pesanan
  echo "<h2>Pesanan</h2>";
  echo "<form method='post' action='proses_pesanan.php'>";
  echo "<label for='produk_id'>Produk:</label>";
  echo "<select name='produk_id' id='produk_id'>";
  mysqli_data_seek($result, 0);
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
  }
  echo "</select>";
  echo "<br>";
  echo "<label for='jumlah'>Jumlah:</label>";
  echo "<input type='number' name='jumlah' id='jumlah'>";
  echo "<br>";
  echo "<input type='submit' value='Pesan'>";
  echo "</form>";

  // Tutup koneksi
  mysqli_close($koneksi);
  ?>
</body>
</html>
