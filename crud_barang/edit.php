<!DOCTYPE html>
<html>
<head>
  <title>Edit Barang</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Barang</h2>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "crud_barang";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
      die("Koneksi database gagal: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM barang WHERE id = $id";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
      } else {
        echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
      }
    }

    mysqli_close($conn);
    ?>
    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required><?php echo $row['deskripsi']; ?></textarea>
      </div>
      <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" step="0.01" value="<?php echo $row['harga']; ?>" required>
      </div>
      <div class="form-group">
        <label>Kualitas</label>
        <select name="kualitas" class="form-control" required>
          <option value="Bagus" <?php if ($row['kualitas'] === 'Bagus') echo 'selected'; ?>>Bagus</option>
          <option value="Sedang" <?php if ($row['kualitas'] === 'Sedang') echo 'selected'; ?>>Sedang</option>
          <option value="Rusak" <?php if ($row['kualitas'] === 'Rusak') echo 'selected'; ?>>Rusak</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>
