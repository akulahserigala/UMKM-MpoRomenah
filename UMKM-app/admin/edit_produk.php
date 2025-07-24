<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

// Ambil data produk
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
$p = mysqli_fetch_assoc($produk);

if (!$p) {
  echo "<script>alert('Produk tidak ditemukan'); location.href='produk.php';</script>";
  exit();
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama      = $_POST['nama'];
  $harga     = $_POST['harga'];
  $deskripsi = $_POST['deskripsi'];

  // Cek apakah gambar baru diupload
  if (!empty($_FILES['gambar']['name'])) {
    $gambarName = $_FILES['gambar']['name'];
    $gambarTmp  = $_FILES['gambar']['tmp_name'];
    $gambarBaru = time() . '_' . $gambarName;
    move_uploaded_file($gambarTmp, '../img/' . $gambarBaru);

    // Hapus gambar lama jika ada
    if (file_exists('../img/' . $p['product_image'])) {
      unlink('../img/' . $p['product_image']);
    }
  } else {
    $gambarBaru = $p['product_image']; // pakai gambar lama
  }

  $query = mysqli_query($conn, "UPDATE tb_product SET 
    product_name = '$nama',
    product_price = '$harga',
    product_desc = '$deskripsi',
    product_image = '$gambarBaru'
    WHERE product_id = '$id'");

  if ($query) {
    echo "<script>alert('Produk berhasil diperbarui'); location.href='produk.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui produk');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk - Admin UMKM</title>
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
    <h4>Edit Produk</h4>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?= $p['product_name'] ?>" required>
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" value="<?= $p['product_price'] ?>" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3" required><?= $p['product_desc'] ?></textarea>
      </div>
      <div class="form-group">
        <label>Gambar Produk (kosongkan jika tidak ingin ganti)</label><br>
        <img src="../img/<?= $p['product_image'] ?>" width="120" class="mb-2">
        <input type="file" name="gambar" class="form-control-file" accept="image/*">
      </div>
      <button type="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="produk.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
