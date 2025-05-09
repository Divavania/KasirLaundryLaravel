-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 04:09 PM
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
-- Database: `kasir_laundry2`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(25) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `harga_per_kg`) VALUES
(12, 'Cuci Biasa', 3000.00),
(13, 'Setrika', 3000.00),
(18, 'Cuci Setrika', 7000.00),
(19, 'Cuci express', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `alamat`) VALUES
(6, 'Diva', '081234567891', 'Magetan'),
(7, 'Indah', '09876543211', 'Magetan'),
(12, 'Bagus', '098765444567', 'Madiun');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('Diproses','Selesai','Diambil') DEFAULT 'Diproses',
  `tanggal_pesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `pelanggan_id`, `total_harga`, `status`, `tanggal_pesanan`) VALUES
(35, 6, 10500.00, 'Selesai', '2025-05-08 02:30:27'),
(40, 6, 6000.00, 'Diproses', '2025-05-08 18:01:13'),
(41, 6, 3000.00, 'Diambil', '2025-05-09 12:32:25'),
(43, 6, 7500.00, 'Selesai', '2025-05-09 13:09:35'),
(44, 7, 13000.00, 'Diproses', '2025-05-09 14:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_layanan`
--

CREATE TABLE `pesanan_layanan` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `berat` decimal(5,2) NOT NULL CHECK (`berat` > 0),
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_layanan`
--

INSERT INTO `pesanan_layanan` (`id`, `pesanan_id`, `layanan_id`, `berat`, `subtotal`) VALUES
(18, 35, 12, 1.00, 3000.00),
(19, 35, 13, 2.50, 7500.00),
(26, 40, 12, 1.00, 3000.00),
(27, 40, 13, 1.00, 3000.00),
(28, 41, 12, 1.00, 3000.00),
(30, 43, 12, 2.00, 6000.00),
(31, 43, 13, 0.50, 1500.00),
(32, 44, 13, 1.00, 3000.00),
(33, 44, 18, 2.00, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`) VALUES
(9, 'superadmin', '$2y$12$BVlVFqpla3YLXvQvGhSRVObzdHCSrwvtsJt.7wDKyeT4mcKnXuOdq', 'superadmin', 'aktif'),
(10, 'admin', '$2y$12$mEMoHmXbWu7GGHOyrntCy.Zvz0IQNEOqI7A7lpQXB4nnKWdmdIDuq', 'admin', 'aktif'),
(11, 'diva', '$2y$12$oNalfAl5lWGj/RlPki7YKupOL7mPyoVMS.7aq.Om3zWcuHyRTjeyu', 'admin', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggan` (`pelanggan_id`);

--
-- Indexes for table `pesanan_layanan`
--
ALTER TABLE `pesanan_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `layanan_id` (`layanan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pesanan_layanan`
--
ALTER TABLE `pesanan_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `pesanan_layanan`
--
ALTER TABLE `pesanan_layanan`
  ADD CONSTRAINT `pesanan_layanan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_layanan_ibfk_2` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
