<!DOCTYPE html>
<html>
<head>
  <title>CRUD Barang</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>CRUD Barang</h2>
    <a href="create.php" class="btn btn-primary mb-3">Tambah Barang</a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Harga</th>
          <th>Kualitas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "crud_barang";

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
          die("Koneksi database gagal: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM barang";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td>' . $row['deskripsi'] . '</td>';
            echo '<td>' . $row['harga'] . '</td>';
            echo '<td>' . $row['kualitas'] . '</td>';
            echo '<td>';
            echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>';
            echo ' <a href="process.php?action=delete&id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';

            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="6">Tidak ada data</td></tr>';
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
