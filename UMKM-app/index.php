<?php
include 'config/db.php';
$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_name ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda - Dapur Kue Betawi Mpo Romenah</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

  <!-- Katalog Produk -->
<div class="container mt-5">
  <h3 class="text-center text-danger mb-4">Katalog Produk</h3>

  <div class="row justify-content-center">
    <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
  <img src="img/<?= $p['product_image'] ?>" class="card-img-top" alt="<?= $p['product_name'] ?>" style="height: 180px; object-fit: cover;">
    <div class="card-body text-center">
        <h5 class="card-title text-danger font-weight-bold mb-1"><?= $p['product_name'] ?></h5>
        <p class="text-muted small mb-2"><?= $p['product_desc'] ?></p>
        <p class="font-weight-bold text-dark mb-0">Rp<?= number_format($p['product_price'], 0, ',', '.') ?></p>
    </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Cara Pemesanan -->
  <div class="container mt-5">
    <h3 class="text-center text-danger mb-3">Cara Pemesanan</h3>
    <ul class="list-unstyled text-center">
      <li>📅 Pemesanan dilakukan minimal 7 hari sebelum tanggal acara. Masukkan tanggal pengambilan barang saat checkout</li>
      <li>💸 Dikenakan pembayaran pertama (DP) minimal 50% dari total harga pesanan</li>
      <li>💰 Pelunasan pembayaran pada saat pengambilan pesanan</li>
      <li>📞 Konfirmasi pengiriman: dapat diambil sendiri atau menggunakan GoSend</li>
      <li>🔔 Jika Anda memiliki pertanyaan terkait pesanan, silakan hubungi admin melalui WhatsApp</li>
    </ul>
  </div>

  <!-- Tentang UMKM -->
<div class="container mt-5 mb-5">
  <h2 class="text-center text-primary mb-4">Tentang UMKM</h2>

  <div class="row justify-content-center mb-5">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-body">
          <h4 class="card-title text-success">Dapur Kue Betawi Mpo Romenah</h4>
          <p><strong>Alamat:</strong> Jln. Kedoya Raya No.21 B Rt 03/003, Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat 16424</p>
          <p><strong>WhatsApp:</strong> 0812-3456-7890</p>
          <p><strong>Jam Operasional:</strong> Senin - Sabtu, 08.00 - 17.00 WIB</p>
          <p><strong>Deskripsi:</strong> Kami menjual aneka kue tradisional khas Betawi yang dibuat secara rumahan, fresh setiap hari dan halal.</p>
        </div>
      </div>
    </div>
  </div>

</div>

</body>
</html>
