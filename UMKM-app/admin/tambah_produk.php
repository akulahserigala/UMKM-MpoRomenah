<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama     = $_POST['nama'];
  $harga    = $_POST['harga'];
  $deskripsi = $_POST['deskripsi'];

  // Upload gambar
  $gambarName = $_FILES['gambar']['name'];
  $gambarTmp  = $_FILES['gambar']['tmp_name'];
  $gambarBaru = time() . '_' . $gambarName;

  move_uploaded_file($gambarTmp, '../img/' . $gambarBaru);

  // Simpan ke database
  $query = mysqli_query($conn, "INSERT INTO tb_product (product_name, product_price, product_image, product_desc)
            VALUES ('$nama', '$harga', '$gambarBaru', '$deskripsi')");

  if ($query) {
    echo "<script>alert('Produk berhasil ditambahkan'); location.href='produk.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan produk');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk - Admin UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .form-box {
      max-width: 600px;
      margin: 30px auto;
      background: #fff;
      border: 1px solid #ddd;
      padding: 25px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
  <a class="navbar-brand" href="dashboard.php">Admin UMKM</a>
  <div class="ml-auto">
    <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
  </div>
</nav>

<div class="container">
  <div class="form-box">
    <h4>Tambah Produk Baru</h4>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label>Gambar Produk</label>
        <input type="file" name="gambar" class="form-control-file" required accept="image/*">
      </div>
      <button type="submit" class="btn btn-success">Simpan Produk</button>
      <a href="produk.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
