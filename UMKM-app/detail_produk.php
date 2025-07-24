<?php
include 'config/db.php';

$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
$p = mysqli_fetch_assoc($produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $p['product_name'] ?> - Detail Produk</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <img src="img/logo.png" width="40" alt="Logo"> Dapur Kue Betawi Mpo Romenah
  </a>
</nav>

<!-- Detail Produk -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-5">
      <img src="img/<?= $p['product_image'] ?>" class="img-fluid" alt="<?= $p['product_name'] ?>">
    </div>
    <div class="col-md-7">
      <h3><?= $p['product_name'] ?></h3>
      <h4 class="text-danger mb-3">Rp<?= number_format($p['product_price']) ?></h4>
      <p><?= nl2br($p['product_desc']) ?></p>

      <!-- Tombol Aksi -->
      <a href="https://wa.me/6281234567890?text=Halo%20Saya%20ingin%20pesan%20<?= urlencode($p['product_name']) ?>" target="_blank" class="btn btn-success mt-3">
        Pesan via WhatsApp
      </a>
      <a href="tambah_keranjang.php?id=<?= $p['product_id'] ?>" class="btn btn-primary mt-3">
        Tambah ke Keranjang
      </a>
    </div>
  </div>
</div>

</body>
</html>
