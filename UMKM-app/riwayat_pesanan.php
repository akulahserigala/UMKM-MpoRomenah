
<?php
include 'config/db.php';
$token = isset($_GET['token']) ? $_GET['token'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cek Riwayat Pesanan</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5 mb-5">
  <h3 class="text-center mb-4">🔍 Cek Status Pesanan Anda</h3>

  <form method="get" class="mb-4 d-flex justify-content-center">
    <input type="text" name="token" class="form-control w-50 mr-2" placeholder="Masukkan token pesanan..." value="<?= htmlspecialchars($token) ?>" required>
    <button type="submit" class="btn btn-success">Cek</button>
  </form>

  <?php
  if ($token != '') {
    $data = mysqli_query($conn, "SELECT o.*, p.product_name, p.product_image, p.product_price 
      FROM tb_order o 
      JOIN tb_product p ON o.product_id = p.product_id 
      WHERE o.token = '$token'");

    if (mysqli_num_rows($data) > 0) {
      $total = 0;
      $row_all = mysqli_fetch_all($data, MYSQLI_ASSOC);
      $tanggal = date('d M Y H:i', strtotime($row_all[0]['tanggal_order']));
      $status = $row_all[0]['status'];
  ?>
  <div class="card shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between">
      <span><strong>📅 <?= $tanggal ?></strong></span>
      <span class="badge 
        <?= $status == 'selesai' ? 'badge-success' : ($status == 'pending' ? 'badge-warning' : 'badge-danger') ?>">
        <?= ucfirst($status) ?>
      </span>
    </div>

    <div class="card-body">
      <?php foreach ($row_all as $item): 
        $subtotal = $item['jumlah'] * $item['product_price'];
        $total += $subtotal;
      ?>
        <div class="d-flex mb-3">
          <img src="img/<?= $item['product_image'] ?>" width="60" class="mr-3" alt="">
          <div class="flex-grow-1">
            <div><strong><?= $item['product_name'] ?></strong></div>
            <div class="text-muted small">x<?= $item['jumlah'] ?></div>
          </div>
          <div class="text-right font-weight-bold">
            Rp<?= number_format($subtotal, 0, ',', '.') ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="card-footer text-right">
      <strong>Total Pesanan: Rp<?= number_format($total, 0, ',', '.') ?></strong>
    </div>
  </div>
  
  <?php
    } else {
      echo '<div class="alert alert-info">Token tidak ditemukan atau belum ada pesanan.</div>';
    }
  }
  ?>

</div>
</body>
</html>
