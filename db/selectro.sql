-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 01:40 PM
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
-- Database: `selectro`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','on delivery','paid','completed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_produk`, `id_users`, `id_pembelian`, `jumlah`, `tanggal_ditambahkan`, `status`) VALUES
(131, 17, 2, 56, 1, '2024-12-28 14:54:58', 'paid'),
(133, 25, 2, NULL, 3, '2024-12-28 16:36:52', 'pending'),
(134, 16, 2, NULL, 2, '2024-12-29 14:39:33', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status_pembelian` enum('pending','on delivery','paid','completed','cancelled') DEFAULT 'pending',
  `tanggal_pembelian` timestamp NOT NULL DEFAULT current_timestamp(),
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_users`, `total_bayar`, `status_pembelian`, `tanggal_pembelian`, `bukti_pembayaran`) VALUES
(35, 2, 2500000.00, 'paid', '2024-12-26 08:20:40', '../uploads/kursi.jpg'),
(36, 3, 500000.00, 'paid', '2024-12-26 08:22:06', '../uploads/meja.jpg'),
(37, 2, 500000.00, 'paid', '2024-12-26 12:05:59', '../uploads/Picture1.jpg'),
(38, 2, 500000.00, 'paid', '2024-12-26 12:06:19', '../uploads/Picture1.jpg'),
(39, 2, 500000.00, 'paid', '2024-12-28 15:28:14', NULL),
(40, 2, 500000.00, 'paid', '2024-12-28 15:28:54', NULL),
(41, 2, 500000.00, 'paid', '2024-12-28 15:34:44', NULL),
(42, 2, 500000.00, 'paid', '2024-12-28 15:39:27', NULL),
(43, 2, 500000.00, 'paid', '2024-12-28 15:44:48', NULL),
(44, 2, 500000.00, 'paid', '2024-12-28 15:49:47', NULL),
(45, 2, 500000.00, 'paid', '2024-12-28 16:34:14', NULL),
(46, 2, 500000.00, 'paid', '2024-12-28 16:44:48', NULL),
(47, 2, 500000.00, 'paid', '2024-12-28 16:53:28', NULL),
(48, 2, 500000.00, 'paid', '2024-12-29 02:25:31', NULL),
(49, 2, 500000.00, 'paid', '2024-12-29 04:50:58', NULL),
(50, 2, 500000.00, 'paid', '2024-12-29 05:24:43', NULL),
(51, 2, 500000.00, 'paid', '2024-12-29 05:26:12', NULL),
(52, 2, 500000.00, 'paid', '2024-12-29 05:26:20', NULL),
(53, 2, 500000.00, 'paid', '2024-12-29 05:30:00', NULL),
(54, 2, 500000.00, 'paid', '2024-12-29 13:37:11', NULL),
(55, 2, 500000.00, 'paid', '2024-12-29 14:02:41', NULL),
(56, 2, 500000.00, 'paid', '2024-12-29 14:40:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `kategori_produk` varchar(255) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori_produk`, `harga_produk`, `stok_produk`, `deskripsi_produk`, `gambar_produk`) VALUES
(15, 'TV 32 Inch', 'TV', 1000000, 5, 'Fitur utama :\r\n- 4K HDR10 Pro\r\n- AI α5 4K Gen6\r\n- ThinQ AI dan WebOS\r\n- Active HDR\r\n\r\nSpesifikasi :\r\n- Type : 4K UHD\r\n- Resolution : 3840 x 2160\r\n- Refresh Rate : Refresh Rate 60Hz\r\n- Main Processor (SoC) : α5 Gen6 AI Processor 4K\r\n- Operating System (OS) : webOS Smart TV\r\n- AI Upscaling : 4K Upscaling\r\n- HDR : Active HDR\r\n- HDR10 Pro : Yes\r\n- FILMMAKER MODE™ : Yes\r\n\r\nINPUTS / OUTPUTS :\r\n- HDMI Input (v 2.0) : 1 (Rear) / 2 (Side)\r\n- eARC (HDMI 2)\r\n- USB Ports (v 2.0) : 1 (Side)\r\n- RF Input : 1 (Rear)\r\n- Ethernet Input : 1 (Rear)\r\n- Digital Audio Output (Optical) : 1 (Rear)\r\n\r\nDimensi :\r\n32 Inch', 'tv1.jpeg'),
(16, 'TV 24 Inch', 'TV', 750000, 5, 'Fitur utama :\r\n- 4K HDR10 Pro\r\n- AI α5 4K Gen6\r\n- ThinQ AI dan WebOS\r\n- Active HDR\r\n\r\nSpesifikasi :\r\n- Type : 4K UHD\r\n- Resolution : 3840 x 2160\r\n- Refresh Rate : Refresh Rate 60Hz\r\n- Main Processor (SoC) : α5 Gen6 AI Processor 4K\r\n- Operating System (OS) : webOS Smart TV\r\n- AI Upscaling : 4K Upscaling\r\n- HDR : Active HDR\r\n- HDR10 Pro : Yes\r\n- FILMMAKER MODE™ : Yes\r\n\r\nINPUTS / OUTPUTS :\r\n- HDMI Input (v 2.0) : 1 (Rear) / 2 (Side)\r\n- eARC (HDMI 2)\r\n- USB Ports (v 2.0) : 1 (Side)\r\n- RF Input : 1 (Rear)\r\n- Ethernet Input : 1 (Rear)\r\n- Digital Audio Output (Optical) : 1 (Rear)\r\n\r\nDimensi :\r\n24 Inch', 'tv2.jpeg'),
(17, 'Tv 18 Inch', 'TV', 500000, -13, 'Fitur utama :\r\n- 4K HDR10 Pro\r\n- AI α5 4K Gen6\r\n- ThinQ AI dan WebOS\r\n- Active HDR\r\n\r\nSpesifikasi :\r\n- Type : 4K UHD\r\n- Resolution : 3840 x 2160\r\n- Refresh Rate : Refresh Rate 60Hz\r\n- Main Processor (SoC) : α5 Gen6 AI Processor 4K\r\n- Operating System (OS) : webOS Smart TV\r\n- AI Upscaling : 4K Upscaling\r\n- HDR : Active HDR\r\n- HDR10 Pro : Yes\r\n- FILMMAKER MODE™ : Yes\r\n\r\nINPUTS / OUTPUTS :\r\n- HDMI Input (v 2.0) : 1 (Rear) / 2 (Side)\r\n- eARC (HDMI 2)\r\n- USB Ports (v 2.0) : 1 (Side)\r\n- RF Input : 1 (Rear)\r\n- Ethernet Input : 1 (Rear)\r\n- Digital Audio Output (Optical) : 1 (Rear)\r\n\r\nDimensi :\r\n18 Inch', 'tv3.jpeg'),
(18, 'Laptop HP', 'Laptop', 1500000, 4, 'Processor : AMD Athlon Gold 3150U (2.4 GHz; up to 3.3 GHz; 1 MB L2 cache)\r\nDisplay : 14.0″ HD (1366×768) TN 220Nits Anti Glare\r\nMemory : 4GB DDR4 2400 SODIMM (1 Extra Socket)\r\nStorage : SSD 256GB M.2 2242 NVME 3.0×2\r\nGraphics : AMD Radeon Graphics', 'lp1.jpeg'),
(19, 'Laptop Asus', 'Laptop', 1300000, 6, 'Processor options: Intel Core i5-1035G1\r\nDisplay: 14.0” Full HD (1920 x 1080), TN\r\nStorage options: 128GB SSD + 1TB HDD or 256GB SSD or 256GB M.2 NVME 3.0x2\r\nMemory: 4GB or 8GB DDR4\r\nGraphics: Intel UHD Graphics or Integrated AMD Radeon Graphics', 'lp2.jpeg'),
(20, 'Laptop Acer', 'Laptop', 1400000, 5, 'Processor options: Intel Core i3-1215U\r\nDisplay: 14.0” Full HD (1920 x 1080), TN\r\nStorage options: 128GB SSD + 1TB HDD or 256GB SSD or 256GB M.2 NVME 3.0x2\r\nMemory: 4GB or 8GB DDR4\r\nGraphics: Intel UHD Graphics or Integrated AMD Radeon Graphics', 'lp3.jpeg'),
(21, 'Mesin Cuci 2 Tabung', 'Mesin Cuci', 700000, 5, 'Mesin Cuci 2 Tabung Semi Otomatis', 'msc3.jpeg'),
(22, 'Mesin Cuci 1 Tabung', 'Mesin Cuci', 550000, 8, 'Mesin Cuci 1 Tabung Semi Otomatis', 'msc2.jpeg'),
(23, 'Mesin Cuci Tabung Depan', 'Mesin Cuci', 600000, 5, 'Mesin Cuci Tabung Depan Full Otomatis', 'msc1.jpeg'),
(24, 'AC Split Wall', 'AC', 800000, 5, 'AC Split Wall', 'ac1.jpeg'),
(25, 'AC Cassete', 'AC', 700000, 10, 'AC Cassete', 'ac2.jpeg'),
(26, 'AC Standing Floor', 'AC', 650000, 5, 'AC Standing Floor', 'ac3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `role`, `phone`, `address`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$7eNmrRD.nTsCjNJs03KgfeCDMg2ipvPU4BkBL6IHmd7XYOzEDtwtG', 'admin', '', 'Bengkong'),
(2, 'putra', 'putra@gmail.com', '$2y$10$Y3i6Pt8L3WGL.M8o5yJF8eOFPZWQddgOmv45lYRkfNZmoLuDgAA.2', 'user', '123455', 'Batam'),
(3, 'Ilham311202', 'ilham@gmail.com', '$2y$10$sWcG2w9HNaCxASUZBkt9aeCNIdTebTFJXaKrnrK2KDsU3./THGisW', 'user', '', 'Bengkong'),
(7, 'asd', 'asd@asd', '$2y$10$JGTQhsuA3QUNo3JyXp8tA.nUdqN/zuH7.bGKT.ANqdayulXE/Hnlm', 'user', '12345', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_users`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
