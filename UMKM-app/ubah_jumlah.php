<?php
session_start();

$id = $_GET['id'];
$jumlah = $_POST['jumlah'];

if ($jumlah <= 0) {
  unset($_SESSION['cart'][$id]);
} else {
  $_SESSION['cart'][$id] = $jumlah;
}

// Redirect agar perubahan langsung terlihat
header("Location: view_cart.php");
exit();
