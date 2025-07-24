<?php
include 'config/db.php';

$token = $_GET['token'] ?? '';
if (!$token) {
  echo "Token tidak valid.";
  exit();
}

// Ambil data order pertama (untuk bukti pelunasan)
$get_order = mysqli_query($conn, "SELECT * FROM tb_order WHERE token = '$token' LIMIT 1");
$order = mysqli_fetch_assoc($get_order);

if (!$order) {
  echo "Data tidak ditemukan.";
  exit();
}

// Proses upload bukti pelunasan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $buktiName = $_FILES['bukti']['name'];
  $buktiTmp = $_FILES['bukti']['tmp_name'];
  $fileName = 'pelunasan_' . time() . '_' . $buktiName;

  if (move_uploaded_file($buktiTmp, 'img/' . $fileName)) {
    // Simpan ke kolom baru: bukti_pelunasan (pastikan kolom ini sudah ada di tb_order)
    mysqli_query($conn, "UPDATE tb_order SET bukti_pelunasan = '$fileName' WHERE token = '$token'");
    $success = "Bukti pelunasan berhasil diunggah.";
  } else {
    $error = "Upload gagal. Coba lagi.";
  }
}

// Ambil data pesanan
$query = mysqli_query($conn, "
  SELECT o.*, p.product_name, p.product_price 
  FROM tb_order o 
  JOIN tb_product p ON o.product_id = p.product_id 
  WHERE o.token = '$token'
");

$orders = [];
$total = 0;
while ($row = mysqli_fetch_assoc($query)) {
  $subtotal = $row['jumlah'] * $row['product_price'];
  $total += $subtotal;
  $orders[] = [
    'nama' => $row['product_name'],
    'jumlah' => $row['jumlah'],
    'subtotal' => $subtotal
  ];
}

$dp = $total * 0.5;
$sisa = $total - $dp;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pelunasan Pesanan</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-danger">Detail Pelunasan Pesanan</h3>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php elseif (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <table class="table table-bordered bg-white">
    <thead class="thead-light">
      <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $o): ?>
        <tr>
          <td><?= $o['nama'] ?></td>
          <td><?= $o['jumlah'] ?></td>
          <td>Rp<?= number_format($o['subtotal'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="2"><strong>Total</strong></td>
        <td><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></td>
      </tr>
      <tr>
        <td colspan="2">DP 50%</td>
        <td>Rp<?= number_format($dp, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="2">Sisa Bayar</td>
        <td class="text-danger font-weight-bold">Rp<?= number_format($sisa, 0, ',', '.') ?></td>
      </tr>
    </tbody>
  </table>

  <h5 class="mt-4">Upload Bukti Pelunasan</h5>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="bukti">Upload file (jpg, png, jpeg):</label>
      <input type="file" name="bukti" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-success">Kirim Bukti</button>
  </form>

  <?php if (!empty($order['bukti_pelunasan'])): ?>
    <p class="mt-3">📎 Bukti Pelunasan: 
      <a href="img/<?= $order['bukti_pelunasan'] ?>" target="_blank"><?= $order['bukti_pelunasan'] ?></a>
    </p>
  <?php endif; ?>
</div>
</body>
</html>
