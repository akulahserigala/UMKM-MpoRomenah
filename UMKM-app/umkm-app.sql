
-- Buat database
CREATE DATABASE IF NOT EXISTS `UMKM-app`;
USE `UMKM-app`;

-- Tabel admin
CREATE TABLE `tb_admin` (
  `admin_id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `no_wa` VARCHAR(20) DEFAULT NULL
);

-- Insert admin default
INSERT INTO `tb_admin` (username, password, no_wa)
VALUES ('admin', MD5('admin123'), '6281234567890');

-- Tabel produk
CREATE TABLE `tb_product` (
  `product_id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_name` VARCHAR(100) NOT NULL,
  `product_price` INT NOT NULL,
  `product_desc` TEXT,
  `product_image` VARCHAR(255) DEFAULT NULL
);

-- Tabel pesanan
CREATE TABLE `tb_order` (
  `order_id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `nama_pemesan` VARCHAR(100) NOT NULL,
  `alamat` TEXT NOT NULL,
  `jumlah` INT NOT NULL,
  `tanggal_order` DATETIME NOT NULL,
  `bukti_bayar` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('pending','selesai','dibatalkan') DEFAULT 'pending',
  `token` VARCHAR(50) UNIQUE NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES `tb_product`(`product_id`) ON DELETE CASCADE
);
