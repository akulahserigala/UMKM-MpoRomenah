
<?php
session_start();
include '../config/db.php';

$status_filter = isset($_GET['status']) ? $_GET['status'] : 'semua';
$where = '';
if ($status_filter !== 'semua') {
    $where = "WHERE o.status = '$status_filter'";
}

// Ambil semua data pesanan & produk
$query = mysqli_query($conn, "
SELECT 
  o.order_id, o.product_id, o.nama_pemesan, o.alamat, o.jumlah, o.tanggal_order, o.status, o.token, o.bukti_bayar,
  p.product_name, p.product_image, p.product_price
FROM tb_order o
JOIN tb_product p ON o.product_id = p.product_id
$where
ORDER BY o.tanggal_order DESC
");

// Kelompokkan berdasarkan token
$pesanan = [];
while ($row = mysqli_fetch_assoc($query)) {
  $pesanan[$row['token']]['tanggal'] = $row['tanggal_order'];
  $pesanan[$row['token']]['status'] = $row['status'];
  $pesanan[$row['token']]['nama'] = $row['nama_pemesan'];
  $pesanan[$row['token']]['alamat'] = $row['alamat'];
  $pesanan[$row['token']]['bukti'] = $row['bukti_bayar'];
  $pesanan[$row['token']]['items'][] = $row;
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Masuk - Admin UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .table img {
      width: 100px;
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



<div class="container mt-5">
  <h3 class="mb-4">📥 Pesanan Masuk</h3>

<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
    <a class="nav-link <?= $status_filter == 'semua' ? 'active' : '' ?>" href="pesanan.php">Semua</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $status_filter == 'pending' ? 'active' : '' ?>" href="pesanan.php?status=pending">Pending</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $status_filter == 'selesai' ? 'active' : '' ?>" href="pesanan.php?status=selesai">Selesai</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $status_filter == 'dibatalkan' ? 'active' : '' ?>" href="pesanan.php?status=dibatalkan">Dibatalkan</a>
  </li>
</ul>

    <table class="table table-bordered table-striped mt-3"></table>

  <?php if (count($pesanan) > 0): ?>
    <?php foreach ($pesanan as $token => $data): ?>
      <?php 
        $total = 0; 
        foreach ($data['items'] as $item) {
          $total += $item['product_price'] * $item['jumlah'];
        }
      ?>
      <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <strong><?= date('d M Y H:i', strtotime($data['tanggal'])) ?></strong><br>
            <span class="text-muted small"><?= $data['nama'] ?> - <?= $data['alamat'] ?></span>
          </div>
          <div>
            <span class="badge 
              <?= $data['status'] == 'selesai' ? 'badge-success' : ($data['status'] == 'pending' ? 'badge-warning' : 'badge-danger') ?>">
              <?= ucfirst($data['status']) ?>
            </span>
          </div>
        </div>
        <div class="card-body">
          <?php foreach ($data['items'] as $item): ?>
            <div class="d-flex mb-3">
              <img src="../img/<?= $item['product_image'] ?>" width="60" class="mr-3" alt="">
              <div class="flex-grow-1">
                <div><strong><?= $item['product_name'] ?></strong></div>
                <div class="text-muted small">x<?= $item['jumlah'] ?></div>
              </div>
              <div class="text-right font-weight-bold">
                Rp<?= number_format($item['product_price'] * $item['jumlah'], 0, ',', '.') ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
        <div>
          <?php
          $buktiPath = "../img/" . $data['bukti'];
          if (!empty($data['bukti']) && file_exists($buktiPath)) {
            echo "📎 <a href='$buktiPath' target='_blank'>Lihat Bukti Bayar</a>";
          } else {
            echo "<span class='text-muted'>Belum ada bukti bayar</span>";
          }
          ?>
        </div>

          <div class="d-flex align-items-center">
            <form method="post" action="ubah_status.php" class="mr-2">
              <input type="hidden" name="token" value="<?= $token ?>">
              <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                <option value="">Ubah Status</option>
                <option value="pending">Pending</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
              </select>
            </form>
            <form method="post" action="hapus_pesanan.php" onsubmit="return confirm('Yakin ingin hapus pesanan ini?')">
              <input type="hidden" name="token" value="<?= $token ?>">
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </div>
        </div>
        <div class="card-footer text-right font-weight-bold">
          Total: Rp<?= number_format($total, 0, ',', '.') ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info">Belum ada pesanan.</div>
  <?php endif; ?>
</div>
</body>
</html>
