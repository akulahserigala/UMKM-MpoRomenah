<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

// Hapus produk
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '$id'");
  header("Location: produk.php");
  exit();
}

// Ambil semua produk
$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_name ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Produk - Admin UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .table img {
      width: 80px;
      height: auto;
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
  <h4>Kelola Produk</h4>
  <a href="tambah_produk.php" class="btn btn-success mb-3">+ Tambah Produk</a>

  <table class="table table-bordered table-striped">
    <thead class="thead-light">
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($p = mysqli_fetch_assoc($produk)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $p['product_name'] ?></td>
        <td>Rp<?= number_format($p['product_price']) ?></td>
        <td><img src="../img/<?= $p['product_image'] ?>" alt="<?= $p['product_name'] ?>"></td>
        <td><?= $p['product_desc'] ?></td>
        <td>
          <a href="edit_produk.php?id=<?= $p['product_id'] ?>" class="btn btn-sm btn-info">Edit</a>
          <a href="produk.php?hapus=<?= $p['product_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
