<!DOCTYPE html>
<html>
<head>
  <title>Tambah Barang</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Tambah Barang</h2>
    <form action="process.php" method="POST">
      <input type="hidden" name="action" value="add">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" step="0.01" required>
      </div>
      <div class="form-group">
        <label>Kualitas</label>
        <select name="kualitas" class="form-control" required>
          <option value="Bagus">Bagus</option>
          <option value="Sedang">Sedang</option>
          <option value="Rusak">Rusak</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>
