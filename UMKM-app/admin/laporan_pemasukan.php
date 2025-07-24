
<?php
include '../config/db.php';

function formatRupiah($angka) {
  return 'Rp' . number_format($angka, 0, ',', '.');
}

// Ambil input filter
$tanggal_awal = $_GET['tanggal_awal'] ?? '';
$tanggal_akhir = $_GET['tanggal_akhir'] ?? '';
$bulan = $_GET['bulan'] ?? '';
$tahun = $_GET['tahun'] ?? '';

// Bangun query dasar
$query = "SELECT o.*, p.product_name, p.product_price 
          FROM tb_order o 
          JOIN tb_product p ON o.product_id = p.product_id 
          WHERE o.status = 'selesai'";

// Tambahkan kondisi berdasarkan input
if ($tanggal_awal && $tanggal_akhir) {
  $query .= " AND DATE(o.tanggal_order) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
} elseif ($bulan) {
  $query .= " AND DATE_FORMAT(o.tanggal_order, '%Y-%m') = '$bulan'";
} elseif ($tahun) {
  $query .= " AND YEAR(o.tanggal_order) = '$tahun'";
}

$query .= " ORDER BY o.tanggal_order DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pemasukan</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
  <a class="navbar-brand" href="dashboard.php">Admin UMKM</a>
  <div class="ml-auto">
    <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
  </div>
</nav>

<body>
<div class="container mt-4">
  <h4 class="mb-4">Laporan Pemasukan</h4>
  <form method="get" class="form-inline mb-4">
    <label class="mr-2">Tanggal Awal:</label>
    <input type="date" name="tanggal_awal" class="form-control mr-2" value="<?= $tanggal_awal ?>">
    <label class="mr-2">Tanggal Akhir:</label>
    <input type="date" name="tanggal_akhir" class="form-control mr-4" value="<?= $tanggal_akhir ?>">

    <label class="mr-2">Bulan:</label>
    <input type="month" name="bulan" class="form-control mr-4" value="<?= $bulan ?>">

    <label class="mr-2">Tahun:</label>
    <select name="tahun" class="form-control mr-3">
      <option value="">- Pilih Tahun -</option>
      <?php for ($y = date('Y'); $y >= 2020; $y--): ?>
        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
      <?php endfor; ?>
    </select>

    <button type="submit" class="btn btn-primary">Tampilkan</button>
  </form>

  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>Tanggal</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
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
        <th colspan="4" class="text-right">Total Pemasukan</th>
        <th><?= formatRupiah($total) ?></th>
      </tr>
    </tbody>
  </table>
  <a href="export_excel.php?filter=<?= $filter ?>" class="btn btn-success mb-3">Export ke Excel</a>
  <a href="cetak_pdf.php?filter=<?= $filter ?>" target="_blank" class="btn btn-secondary mb-3 ml-2">Cetak PDF</a>
</div>
</body>
</html>
