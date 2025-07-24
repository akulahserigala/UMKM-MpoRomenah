<?php
session_start();
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h3 class="text-danger mb-4">Keranjang Belanja</h3>

  <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>
    <div class="alert alert-warning">Keranjang masih kosong.</div>
    <a href="pemesanan.php" class="btn btn-primary">Kembali Belanja</a>
  <?php else: ?>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $qty):
          $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
          $p = mysqli_fetch_assoc($produk);
          $subtotal = $p['product_price'] * $qty;
          $total += $subtotal;
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $p['product_name'] ?></td>
          <td>Rp<?= number_format($p['product_price'], 0, ',', '.') ?></td>
          <td>
            <form action="ubah_jumlah.php?id=<?= $id ?>" method="post" class="form-inline">
              <input type="number" name="jumlah" value="<?= $qty ?>" class="form-control form-control-sm mr-2" min="1">
              <button type="submit" class="btn btn-info btn-sm">Ubah</button>
            </form>
          </td>
          <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
          <td>
            <a href="hapus_keranjang.php?id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini dari keranjang?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach ?>
        <tr>
          <td colspan="5" class="text-right font-weight-bold text-success">DP 50%:</td>
          <td colspan="2" class="font-weight-bold text-success">
            Rp<?= number_format($total * 0.5, 0, ',', '.') ?>
          </td>
        </tr>
        <tr>
          <td colspan="5" class="text-right font-weight-bold text-danger">Sisa Bayar:</td>
          <td colspan="2" class="font-weight-bold text-danger">
            Rp<?= number_format($total * 0.5, 0, ',', '.') ?>
          </td>
        </tr>
        <tr>
          <td colspan="5" class="text-right font-weight-bold">Total Keseluruhan:</td>
          <td colspan="2" class="font-weight-bold">Rp<?= number_format($total, 0, ',', '.') ?></td>
        </tr>
      </tbody>
    </table>

    <a href="pemesanan.php" class="btn btn-secondary">Kembali Belanja</a>
    <a href="checkout.php" class="btn btn-success">Lanjut ke Checkout</a>
  <?php endif; ?>
</div>

</body>
</html>



