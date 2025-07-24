<?php
session_start();
include '../config/db.php';

// Cek login admin
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

// Tambah kategori
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES ('$nama')");
  header("Location: kategori.php");
  exit();
}

// Hapus kategori
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$id'");
  header("Location: kategori.php");
  exit();
}

// Ambil data
$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Kategori - Admin UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .form-inline input {
      margin-right: 10px;
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

<div class="container mt-4">
  <h4>Kelola Kategori Produk</h4>

  <!-- Form Tambah -->
  <form action="" method="post" class="form-inline my-3">
    <input type="text" name="nama" class="form-control mr-2" placeholder="Nama Kategori" required>
    <button type="submit" name="tambah" class="btn btn-success">+ Tambah</button>
  </form>

  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($k = mysqli_fetch_assoc($kategori)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $k['category_name'] ?></td>
        <td>
          <a href="edit_kategori.php?id=<?= $k['category_id'] ?>" class="btn btn-sm btn-info">Edit</a>
          <a href="kategori.php?hapus=<?= $k['category_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
