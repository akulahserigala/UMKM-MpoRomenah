<?php
session_start();
include '../config/db.php';

// Jika form login dikirim
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Gunakan md5 karena database menyimpan dalam md5

  $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password' ");
  if (mysqli_num_rows($query) > 0) {
    $admin = mysqli_fetch_assoc($query);
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['nama_admin'] = $admin['nama_admin'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Username atau Password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - UMKM</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .login-box {
      max-width: 400px;
      margin: 100px auto;
      border: 1px solid #ddd;
      padding: 30px;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="login-box">
    <h4 class="text-center mb-4" style="color:#4CAF50;">Login Admin</h4>
    <?php if (isset($error)) { ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>
    <form action="" method="post">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
      <a href="../index.php" class="btn btn-secondary btn-block">Kembali ke Beranda</a>
    </form>
  </div>
</div>

</body>
</html>
