<?php
include 'config/db.php';
$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_name ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemesanan Produk</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h3 class="text-danger mb-4 text-center">Katalog Produk</h3>

  <div class="row justify-content-center">
    <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="img/<?= $p['product_image'] ?>" class="card-img-top" alt="<?= $p['product_name'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-danger font-weight-bold"><?= $p['product_name'] ?></h5>
            <p class="card-text">Rp<?= number_format($p['product_price'], 0, ',', '.') ?></p>
            <form action="tambah_keranjang.php" method="post" onsubmit="return handleTambah(this)" class="d-flex justify-content-between align-items-center gap-2">
                <input type="hidden" name="id" value="<?= $p['product_id'] ?>">
                <input type="number" name="jumlah" value="1" min="1" class="form-control form-control-sm w-50" style="max-width: 60px;">
                <button type="submit" class="btn btn-success btn-sm">+ Tambah</button>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>

<script>
function handleTambah(form) {
  const button = form.querySelector("button");
  button.disabled = true;
  button.innerText = "✓ Ditambahkan";

  setTimeout(() => {
    form.submit();
  }, 600); // sedikit delay agar user lihat animasi
  return false;
}
</script>
</html>
