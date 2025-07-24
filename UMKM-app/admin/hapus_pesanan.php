
<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = $_POST['token'];

  if (!empty($token)) {
    mysqli_query($conn, "DELETE FROM tb_order WHERE token = '$token'");
  }

  header("Location: pesanan.php");
  exit();
}
?>
