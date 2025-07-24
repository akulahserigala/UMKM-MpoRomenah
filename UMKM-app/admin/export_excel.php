
<?php
include '../config/db.php';

$filter = $_GET['filter'] ?? 'semua';
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_pemasukan_$filter.xls");

# Format Rupiah
function formatRupiah($angka) {
  return 'Rp' . number_format($angka, 0, ',', '.');
}

# Menentukan Filter Waktu
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

# Query Data Pesanan
$query = mysqli_query($conn, "
  SELECT o.*, p.product_name, p.product_price 
  FROM tb_order o 
  JOIN tb_product p ON o.product_id = p.product_id 
  WHERE o.status = 'selesai' $where
");

# Output ke Tabel Excel
echo "<table border='1'>
<tr>
  <th>Tanggal</th>
  <th>Produk</th>
  <th>Jumlah</th>
  <th>Harga Satuan</th>
  <th>Subtotal</th>
</tr>";

# Output ke Tabel Excel
$total = 0;
while ($row = mysqli_fetch_assoc($query)) {
  $subtotal = $row['jumlah'] * $row['product_price'];
  $total += $subtotal;
  echo "<tr>
    <td>" . $row['tanggal_order'] . "</td>
    <td>" . $row['product_name'] . "</td>
    <td>" . $row['jumlah'] . "</td>
    <td>" . $row['product_price'] . "</td>
    <td>$subtotal</td>
  </tr>";
}
echo "<tr><th colspan='4'>Total</th><th>$total</th></tr>";
echo "</table>";
?>
