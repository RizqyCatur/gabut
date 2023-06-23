<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "crud_barang";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
  
    if ($action === 'delete') {
      $sql = "DELETE FROM barang WHERE id = $id";
      if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  }
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
      $nama = $_POST['nama'];
      $deskripsi = $_POST['deskripsi'];
      $harga = $_POST['harga'];
      $kualitas = $_POST['kualitas'];

      $sql = "INSERT INTO barang (nama, deskripsi, harga, kualitas) VALUES ('$nama', '$deskripsi', '$harga', '$kualitas')";
      if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    } elseif ($action === 'edit') {
      $id = $_POST['id'];
      $nama = $_POST['nama'];
      $deskripsi = $_POST['deskripsi'];
      $harga = $_POST['harga'];
      $kualitas = $_POST['kualitas'];

      $sql = "UPDATE barang SET nama = '$nama', deskripsi = '$deskripsi', harga = '$harga', kualitas = '$kualitas' WHERE id = $id";
      if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  }
}

mysqli_close($conn);
?>
