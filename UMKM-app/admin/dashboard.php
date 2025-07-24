<?php
session_start();
include '../config/db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$nama = $_SESSION['nama_admin'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .dashboard-box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 25px;
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .dashboard-link {
      display: block;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 10px;
      background-color: #f8f9fa;
      color: #333;
      text-decoration: none;
    }

    .dashboard-link:hover {
      background-color: #e2f4e6;
      border-color: #4CAF50;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
  <a class="navbar-brand" href="#">Admin UMKM</a>
  <div class="ml-auto">
    <span class="text-white mr-3">Halo, <?= $nama ?></span>
    <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
  </div>
</nav>

<div class="container mt-5">
  <div class="dashboard-box">
    <h4>Selamat datang, <?= $nama ?>!</h4>
    <p>Pilih menu berikut untuk mengelola website:</p>

    <a href="produk.php" class="dashboard-link">📦 Kelola Produk</a>
    <a href="pesanan.php" class="dashboard-link">📝 Lihat Pesanan</a>
    <a href="laporan_pemasukan.php" class="dashboard-link">💰 Laporan Pemasukan</a>
    <!-- <a href="kategori.php" class="dashboard-link">📂 Kelola Kategori</a>-->
    <a href="profil.php" class="dashboard-link">👤 Ubah Profil Admin</a>
  </div>
</div>

</body>
</html>
