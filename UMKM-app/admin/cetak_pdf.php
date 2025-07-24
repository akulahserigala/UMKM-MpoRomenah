
<?php
include '../config/db.php';

function formatRupiah($angka) {
  return 'Rp' . number_format($angka, 0, ',', '.');
}

$filter = $_GET['filter'] ?? 'semua';

switch ($filter) {
  case 'harian':
    $where = "AND DATE(o.tanggal_order) = CURDATE()";
    break;
  case 'mingguan':
    $where = "AND WEEK(o.tanggal_order, 1) = WEEK(CURDATE()) AND YEAR(o.tanggal_order) = YEAR(CURDATE())";
    break;
  case 'bulanan':
    $where = "AND MONTH(o.tanggal_order) = MONTH(CURDATE()) AND YEAR(o.tanggal_order) = YEAR(CURDATE())";
    break;
  case 'tahunan':
    $where = "AND YEAR(o.tanggal_order) = YEAR(CURDATE())";
    break;
  default:
    $where = "";
}

$result = mysqli_query($conn, "
  SELECT o.*, p.product_name, p.product_price 
  FROM tb_order o 
  JOIN tb_product p ON o.product_id = p.product_id 
  WHERE o.status = 'selesai' $where
");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Cetak Laporan Pemasukan</title>
  <style>
    body { font-family: Arial; font-size: 14px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background-color: #eee; }
  </style>
</head>
<body>
<h3>Laporan Pemasukan (<?= ucfirst($filter) ?>)</h3>
<table>
  <tr>
    <th>Tanggal</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Subtotal</th>
  </tr>
  <?php 
  $total = 0;
  while ($row = mysqli_fetch_assoc($result)): 
    $subtotal = $row['jumlah'] * $row['product_price'];
    $total += $subtotal;
  ?>
  <tr>
    <td><?= date('d/m/Y', strtotime($row['tanggal_order'])) ?></td>
    <td><?= $row['product_name'] ?></td>
    <td><?= $row['jumlah'] ?></td>
    <td><?= formatRupiah($row['product_price']) ?></td>
    <td><?= formatRupiah($subtotal) ?></td>
  </tr>
  <?php endwhile; ?>
  <tr>
    <th colspan="4">Total</th>
    <th><?= formatRupiah($total) ?></th>
  </tr>
</table>
<script>window.print();</script>
</body>
</html>
