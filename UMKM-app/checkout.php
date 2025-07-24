
<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
  echo "<script>alert('Keranjang belanja kosong!'); location.href='index.php';</script>";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama     = $_POST['nama'];
  $alamat   = $_POST['alamat'];
  $tanggal  = date('Y-m-d H:i:s');

  // Upload bukti bayar
  $buktiName = $_FILES['bukti']['name'];
  $buktiTmp  = $_FILES['bukti']['tmp_name'];
  $buktiBaru = 'bukti_' . time() . '_' . $buktiName;
  move_uploaded_file($buktiTmp, 'img/' . $buktiBaru);

  // Simpan semua pesanan
  foreach ($_SESSION['cart'] as $id => $qty) {
    mysqli_query($conn, "INSERT INTO tb_order 
      (product_id, nama_pemesan, alamat, jumlah, tanggal_order, bukti_bayar) 
      VALUES ('$id', '$nama', '$alamat', '$qty', '$tanggal', '$buktiBaru')");
  }

  // Ambil salah satu order_id terakhir
  $get_last_order = mysqli_query($conn, "SELECT order_id FROM tb_order WHERE nama_pemesan = '$nama' AND alamat = '$alamat' ORDER BY order_id DESC LIMIT 1");
  $last = mysqli_fetch_assoc($get_last_order);
  $order_id = $last['order_id'];

  // 🔐 Generate token
  function generateToken($length = 20) {
    return bin2hex(random_bytes($length / 2));
  }
  $token = generateToken();
  mysqli_query($conn, "UPDATE tb_order SET token = '$token' WHERE token IS NULL AND nama_pemesan = '$nama' AND alamat = '$alamat'");

  // 🔔 Buat isi pesan WhatsApp
  $pesan = "Halo Admin, saya sudah melakukan pemesanan:\n";
  $pesan .= "Nama: $nama\n";
  $pesan .= "Alamat: $alamat\n";
  $pesan .= "Pesanan:\n";

  $total = 0;
  foreach ($_SESSION['cart'] as $id => $qty) {
    $produk = mysqli_query($conn, "SELECT product_name, product_price FROM tb_product WHERE product_id = '$id'");
    $p = mysqli_fetch_assoc($produk);
    $subtotal = $p['product_price'] * $qty;
    $total += $subtotal;
    $pesan .= "- $qty x {$p['product_name']}\n";
  }

  $pesan .= "\n\nTotal: Rp" . number_format($total, 0, ",", ".");
  $pesan .= "\nDp 50%: Rp" . number_format($total * 0.5, 0, ",", ".");
  $pesan .= "\nSisa Bayar: Rp" . number_format($total * 0.5, 0, ",", ".");
  $pesan .= "\n\nBukti bayar dp: http://localhost/UMKM-app/img/$buktiBaru";
  $pesan .= "\nLink Pelunasan: http://localhost/UMKM-app/pelunasan.php?token=$token";
  $pesan .= "\n\nCek status pesanan: http://localhost/UMKM-app/riwayat_pesanan.php?token=$token";

  $getAdmin = mysqli_query($conn, "SELECT no_wa FROM tb_admin WHERE admin_id = 1");
  $admin = mysqli_fetch_assoc($getAdmin);
  $noAdmin = $admin['no_wa'];

  unset($_SESSION['cart']);

  header("Location: https://wa.me/$noAdmin?text=" . urlencode($pesan));
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Dapur Kue Betawi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <img src="img/logo.png" width="40"> Dapur Kue Betawi Mpo Romenah
  </a>
</nav>

<div class="container mt-5">
  <h3>Form Checkout</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Alamat Lengkap</label>
      <textarea name="alamat" class="form-control" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label>Upload Bukti Pembayaran (JPG, PNG)</label>
      <input type="file" name="bukti" class="form-control-file" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Kirim Pesanan via WhatsApp</button>
    <a href="view_cart.php" class="btn btn-secondary">Kembali ke Keranjang</a>
  </form>
</div>

</body>
</html>
