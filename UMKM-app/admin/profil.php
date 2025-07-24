<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$id = $_SESSION['admin_id'];

// Ambil data admin
$data = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '$id'");
$admin = mysqli_fetch_assoc($data);

// Update profil
if (isset($_POST['update'])) {
  $nama     = $_POST['nama'];
  $username = $_POST['username'];
  $no_wa    = $_POST['no_wa'];

  mysqli_query($conn, "UPDATE tb_admin SET 
    nama_admin = '$nama',
    username = '$username',
    no_wa = '$no_wa'
    WHERE admin_id = '$id'");

  $_SESSION['nama_admin'] = $nama; // Update session juga
  echo "<script>alert('Profil berhasil diperbarui'); location.href='profil.php';</script>";
  exit();
}

// Ganti password
if (isset($_POST['ganti_password'])) {
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];

  if ($pass1 === $pass2) {
    $hashed = md5($pass1);
    mysqli_query($conn, "UPDATE tb_admin SET password = '$hashed' WHERE admin_id = '$id'");
    echo "<script>alert('Password berhasil diubah'); location.href='profil.php';</script>";
  } else {
    echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Profil Admin</title>
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
    <h4>Ubah Profil Admin</h4>
    <form method="post">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $admin['nama_admin'] ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?= $admin['username'] ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>No. WhatsApp</label>
        <input type="text" name="no_wa" value="<?= $admin['no_wa'] ?>" class="form-control" required>
      </div>
      <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
    </form>

    <hr>

    <h5>Ganti Password</h5>
    <form method="post">
      <div class="form-group">
        <label>Password Baru</label>
        <input type="password" name="pass1" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="pass2" class="form-control" required>
      </div>
      <button type="submit" name="ganti_password" class="btn btn-warning">Ubah Password</button>
    </form>
  </div>
</div>

</body>
</html>
