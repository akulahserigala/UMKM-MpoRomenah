<?php
session_start();

$id = $_POST['id'];
$jumlah = $_POST['jumlah'] ?? 1;

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
  $_SESSION['cart'][$id] += $jumlah;
} else {
  $_SESSION['cart'][$id] = $jumlah;
}

header("Location: pemesanan.php"); // atau ke view_cart.php jika kamu mau
exit();
