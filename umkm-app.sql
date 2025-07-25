-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 02:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `username`, `password`, `nama_admin`, `no_wa`) VALUES
(1, 'admin', '4acb4bc224acbbe3c2bfdcaa39a4324e', 'Admin Mpo Romenah', '62816206418');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  `status` enum('pending','selesai','dibatalkan') DEFAULT 'pending',
  `token` varchar(50) DEFAULT NULL,
  `bukti_pelunasan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `product_id`, `nama_pemesan`, `alamat`, `jumlah`, `tanggal_order`, `bukti_bayar`, `status`, `token`, `bukti_pelunasan`) VALUES
(22, 19, 'Biji Ketapang', 'gundar', 1, '2025-07-05 04:48:32', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'pending', 'c62083f2c06d5ec5731f', NULL),
(23, 33, 'Biji Ketapang', 'gundar', 1, '2025-07-05 04:48:32', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'pending', 'c62083f2c06d5ec5731f', NULL),
(24, 39, 'Biji Ketapang', 'gundar', 1, '2025-07-05 04:48:32', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'pending', 'c62083f2c06d5ec5731f', NULL),
(25, 37, 'Kue Pepe', 'bogor', 1, '2025-07-05 04:50:46', 'bukti_1751683846_bukti_1751609808_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', '317da6cb9ce50a7cbbf5', NULL),
(26, 28, 'Kue Pepe', 'bogor', 4, '2025-07-05 04:50:46', 'bukti_1751683846_bukti_1751609808_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', '317da6cb9ce50a7cbbf5', NULL),
(27, 29, 'Kue Pepe', 'bogor', 1, '2025-07-05 04:50:46', 'bukti_1751683846_bukti_1751609808_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', '317da6cb9ce50a7cbbf5', NULL),
(28, 25, 'Kue Pepe', 'bogor', 3, '2025-07-05 04:50:46', 'bukti_1751683846_bukti_1751609808_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', '317da6cb9ce50a7cbbf5', NULL),
(29, 16, 'Kue Pepe', 'bogor', 2, '2025-07-05 04:50:46', 'bukti_1751683846_bukti_1751609808_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', '317da6cb9ce50a7cbbf5', NULL),
(30, 4, 'Zie', 'Rancaekek', 1, '2025-07-05 05:16:26', 'bukti_1751685386_1751634874_tape-uli.jpeg', 'selesai', '41ab5ca38a31ef1d03b7', NULL),
(31, 5, 'Zie', 'Rancaekek', 1, '2025-07-05 05:16:26', 'bukti_1751685386_1751634874_tape-uli.jpeg', 'selesai', '41ab5ca38a31ef1d03b7', NULL),
(32, 15, 'Zie', 'Rancaekek', 4, '2025-07-05 05:16:26', 'bukti_1751685386_1751634874_tape-uli.jpeg', 'selesai', '41ab5ca38a31ef1d03b7', NULL),
(33, 4, 'Budi', 'Jakarta', 2, '2024-01-10 09:00:00', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'selesai', 'token_jan001', NULL),
(34, 7, 'Sinta', 'Depok', 1, '2024-03-15 13:30:00', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'selesai', 'token_mar002', NULL),
(35, 13, 'Ahmad', 'Bogor', 3, '2024-04-05 16:45:00', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'selesai', 'token_apr003', NULL),
(36, 19, 'Lisa', 'Tangerang', 1, '2024-05-20 11:15:00', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'selesai', 'token_mei004', NULL),
(37, 28, 'Rudi', 'Bekasi', 2, '2024-07-02 08:00:00', 'bukti_1751683712_1751634553_biji-ketapang.jpeg', 'selesai', 'token_jul005', NULL),
(38, 14, 'Maria Angel', 'gundar', 1, '2025-07-07 07:31:16', 'bukti_1751866276_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '3861b79b92815c10ec50', NULL),
(39, 5, 'Maria Angel', 'gundar', 3, '2025-07-07 07:31:16', 'bukti_1751866276_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '3861b79b92815c10ec50', NULL),
(40, 22, 'Maria Angel', 'gundar', 1, '2025-07-07 07:31:16', 'bukti_1751866276_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '3861b79b92815c10ec50', NULL),
(41, 5, 'maria', 'gundar', 2, '2025-07-07 07:33:34', 'bukti_1751866414_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'a1917cb1054f1c523e4e', NULL),
(42, 6, 'maria', 'gundar', 1, '2025-07-07 07:33:34', 'bukti_1751866414_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'a1917cb1054f1c523e4e', NULL),
(43, 7, 'Jiji', 'Depok', 2, '2025-07-07 08:25:00', 'bukti_1751869500_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '6725db8cbb4435999e8b', NULL),
(44, 39, 'Jiji', 'Depok', 1, '2025-07-07 08:25:00', 'bukti_1751869500_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '6725db8cbb4435999e8b', NULL),
(45, 37, 'Jiji', 'Depok', 1, '2025-07-07 08:25:00', 'bukti_1751869500_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '6725db8cbb4435999e8b', NULL),
(46, 16, 'Jiji', 'Depok', 1, '2025-07-07 08:25:00', 'bukti_1751869500_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '6725db8cbb4435999e8b', NULL),
(47, 26, 'Jinji', 'Bogor', 5, '2025-07-07 08:35:53', 'bukti_1751870153_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '08408bebaea0ca550539', NULL),
(48, 37, 'Jinji', 'Bogor', 1, '2025-07-07 08:35:53', 'bukti_1751870153_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '08408bebaea0ca550539', NULL),
(49, 24, 'Jinji', 'Bogor', 5, '2025-07-07 08:35:53', 'bukti_1751870153_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '08408bebaea0ca550539', NULL),
(50, 39, 'Jinji', 'Bogor', 1, '2025-07-07 08:35:53', 'bukti_1751870153_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '08408bebaea0ca550539', NULL),
(51, 20, 'Jinji', 'Bogor', 1, '2025-07-07 08:35:53', 'bukti_1751870153_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '08408bebaea0ca550539', NULL),
(52, 32, 'apip', 'jakarta', 1, '2025-07-07 08:39:16', 'bukti_1751870356_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'b7572cba27dc938db84e', NULL),
(53, 11, 'apip', 'jakarta', 1, '2025-07-07 08:39:16', 'bukti_1751870356_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'b7572cba27dc938db84e', NULL),
(54, 19, 'apip', 'jakarta', 9, '2025-07-07 08:39:16', 'bukti_1751870356_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'b7572cba27dc938db84e', NULL),
(55, 28, 'apip', 'jakarta', 3, '2025-07-07 08:39:16', 'bukti_1751870356_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'dibatalkan', 'b7572cba27dc938db84e', NULL),
(56, 5, 'Gunadarma', 'Depok', 1, '2025-07-11 06:39:34', 'bukti_1752208774_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '26d62516e4d4851367e6', NULL),
(57, 18, 'Gunadarma', 'Depok', 4, '2025-07-11 06:39:34', 'bukti_1752208774_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '26d62516e4d4851367e6', NULL),
(58, 27, 'Gunadarma', 'Depok', 1, '2025-07-11 06:39:34', 'bukti_1752208774_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '26d62516e4d4851367e6', NULL),
(59, 31, 'Gunadarma', 'Depok', 3, '2025-07-11 06:39:34', 'bukti_1752208774_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', '26d62516e4d4851367e6', NULL),
(60, 12, 'maul', 'depok', 1, '2025-07-11 06:46:26', 'bukti_1752209186_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', 'ed42321cf06c98b193ac', NULL),
(61, 5, 'maul', 'depok', 10, '2025-07-11 06:46:26', 'bukti_1752209186_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', 'ed42321cf06c98b193ac', NULL),
(62, 17, 'maul', 'depok', 5, '2025-07-11 06:46:26', 'bukti_1752209186_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'pending', 'ed42321cf06c98b193ac', NULL),
(63, 6, 'Maria Angel', 'depok', 5, '2025-07-11 07:07:01', 'bukti_1752210421_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '616b84561cbc34bd2d4f', NULL),
(64, 19, 'Maria Angel', 'depok', 3, '2025-07-11 07:07:01', 'bukti_1752210421_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '616b84561cbc34bd2d4f', NULL),
(65, 36, 'Maria Angel', 'depok', 2, '2025-07-11 07:07:01', 'bukti_1752210421_WhatsApp Image 2025-07-03 at 2.32.14 PM.jpeg', 'selesai', '616b84561cbc34bd2d4f', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `product_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_name`, `product_price`, `product_image`, `product_desc`) VALUES
(4, 'Akar Kelapa 500 gr', 50000, 'akar-kelapa.jpeg', 'Kue tradisional Betawi renyah rasa kelapa.'),
(5, 'Asinan Buah', 25000, 'asinan-buah.jpeg', 'Buah segar dengan kuah cuka.'),
(6, 'Asinan Sayur', 25000, 'asinan.jpeg', 'Sayuran segar khas Betawi dengan bumbu kacang.'),
(7, 'Ayam Bekakak Bakar 2 Ekor', 300000, 'ayam.jpeg', 'Ayam utuh berbumbu khas rempah Sunda, dibakar hingga matang sempurna dan menghasilkan cita rasa manis gurih meresap ke dalam daging.'),
(8, 'Biji Ketapang 300 gr', 40000, 'biji-ketapang.jpeg', 'Camilan khas Betawi, gurih dan renyah.'),
(9, 'Kue Bugis', 230000, 'bugis.jpeg', 'Kue basah isi unti kelapa manis legit.\r\n50 pcs'),
(10, 'Semur Daging', 550000, 'daging.jpeg', 'Potongan daging sapi empuk dimasak dengan bumbu semur khas Betawi yang manis dan gurih.\r\nUkuran : 2 kg'),
(12, '(!) Dodol 28x28', 400000, 'dodol28.jpeg', 'Dodoll\r\n'),
(13, 'Geplak Kecil', 60000, 'geplak-kecil.jpeg', 'Kue manis dari kelapa parut dan gula.\r\nUkuran : 500 gr'),
(14, 'Geplak Besar', 280000, 'geplak.jpeg', 'Varian geplak ukuran besar.\r\nUkuran : 28x28'),
(15, 'Kentang Pengantin', 200000, 'kentang.jpeg', 'Hidangan khas Betawi berisi kentang goreng berbumbu rempah manis pedas, dicampur dengan kacang tanah.\r\n2 kotak'),
(16, 'Kolak Kolaling', 80000, 'kolaling.jpeg', 'Kolak khas Betawi campur kolang-kaling.\r\nUkuran : 1 kg'),
(17, 'Kue Irian', 280000, 'kue-irian.jpeg', 'Kue warna-warni dengan tekstur lembut.\r\nUkuran : 28x28'),
(18, 'Kue Pepe', 280000, 'kue-pepe.jpeg', 'Kue lapis kenyal warna-warni.\r\nUkuran : 28x28'),
(19, 'Kue Potong Betawi', 35000, 'kue-potong.jpeg', 'Kue potong khas pasar tradisional.'),
(20, '(!)Kue Tampah', 50000, 'kue-tampah.jpeg', 'Paket aneka kue di tampah.'),
(21, 'Kue Uli', 280000, 'kue-uli.jpeg', 'Kue uli ketan yang pulen.\r\nUkuran : 28x28'),
(22, 'Nasi Kuning', 175000, 'nasi-kuning.jpeg', 'Nasi kuning lengkap lauknya.'),
(23, 'Nasi Putih', 125000, 'nasi.jpeg', 'Nasi gurih dengan lauk sambal.'),
(24, 'Pepe Bunga', 4000, 'pepe-bunga.jpeg', 'Kue pepe dengan motif bunga.\r\n/pc'),
(25, 'Rujak Buah', 20000, 'rujak-buah.jpeg', 'Buah segar dengan bumbu rujak kacang.'),
(26, 'Rujak Serut', 7000, 'rujak-serut.jpeg', 'Serutan buah segar dan pedas manis.\r\nUkuran : 150 ml'),
(27, 'Tape Uli PAKET A', 200000, 'tape-uli.jpeg', 'Tape ketan + uli, sajian khas Betawi.\r\n5 ULI ukuran 300gr + 1kg Tape'),
(28, 'Tape Ketan Hitam', 180000, 'tape.jpeg', 'Fermentasi ketan manis.\r\nPAKET HANTARAN'),
(29, 'Uli Berlapis Wajik', 450000, 'uli-wajik.jpeg', 'Kombinasi uli dan wajik gula merah.\r\nUkuran : 30x30'),
(30, 'Wajik Bandung', 270000, 'wajik-bandung.jpeg', 'Wajik manis khas Bandung.'),
(31, 'Wajik Gula Aren', 280000, 'wajik-gula-aren.jpeg', 'Wajik legit dengan gula aren asli.\r\nUkuran : 28x28'),
(32, 'Akar Kelapa 1 kg', 95000, '1751634346_akar-kelapa.jpeg', 'Kue tradisional Betawi renyah rasa kelapa. '),
(33, 'Biji Ketapang 400 gr', 50000, '1751634553_biji-ketapang.jpeg', 'Camilan khas Betawi, gurih dan renyah.'),
(34, 'Biji Ketapang 500 gr', 60000, '1751634590_biji-ketapang.jpeg', 'Camilan khas Betawi, gurih dan renyah.'),
(35, 'Tape Uli PAKET B', 175000, '1751634800_tape-uli.jpeg', '5 ULI ukuran 200 gr + 1 kg Tape'),
(36, 'Tape Uli PAKET C', 130000, '1751634831_tape-uli.jpeg', '5 ULI ukuran 200gr + 1/2 kg Tape'),
(37, 'Tape Uli SMALL A', 40000, '1751634874_tape-uli.jpeg', '1 ULI ukuran 300 gr + 300;gr Tape'),
(38, 'Tape Uli SMALL B', 28000, '1751634900_tape-uli.jpeg', '1 ULI ukuran 200gr + 200;gr Tape'),
(39, 'Ayam Opor 2 Ekor', 300000, '1751635157_ayam.jpeg', 'Ayam kampung dimasak dengan kuah santan kental berbumbu opor kuning khas Betawi.'),
(40, 'Rendang Daging 2kg', 600000, '1751635352_daging.jpeg', 'Daging sapi pilihan dimasak perlahan dalam santan dan rempah khas Minang hingga kering, menghasilkan rasa gurih pedas dan aroma rempah yang dalam.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
