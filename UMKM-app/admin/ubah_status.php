
<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = $_POST['token'];
  $status = $_POST['status'];

  if (!empty($token) && !empty($status)) {
    mysqli_query($conn, "UPDATE tb_order SET status = '$status' WHERE token = '$token'");
  }

  header("Location: pesanan.php");
  exit();
}
?>
