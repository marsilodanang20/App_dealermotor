-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2025 at 09:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `nomor_customer` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_customer` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `telepon` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nomor_customer`, `nama_customer`, `alamat`, `telepon`) VALUES
(1, 'C001', 'Marsilo Danang', 'Jl.Pangeran Sutajaya No. 10, Cirebon', '081234567890'),
(2, 'C002', 'Budi Santoso', 'Jl. Raya No. 25, Surabaya', '082345678901'),
(3, 'C003', 'Chandra Wijaya', 'Jl. Pahlawan No. 30, Bandung', '083456789012'),
(4, 'C004', 'Dewi Lestari', 'Jl. Bunga No. 15, Yogyakarta', '084567890123'),
(5, 'C005', 'Eka Putra', 'Jl. Pantai No. 5, Bali', '085678901234');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kode_produk` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'M001', 'Yamaha R15', '17000000.00', 10),
(2, 'M002', 'Honda CBR 150R', '15000000.00', 15),
(3, 'M003', 'Kawasaki Ninja 250', '25000000.00', 8),
(4, 'M004', 'Suzuki GSX-R150', '12000000.00', 12),
(5, 'M005', 'Honda CB150R', '15000000.00', 18),
(6, 'M006', 'Yamaha MT-25', '23000000.00', 5),
(7, 'M007', 'Kawasaki Z250', '20000000.00', 7),
(8, 'M008', 'Honda CRF 250L', '30000000.00', 6),
(9, 'M009', 'Yamaha XSR 155', '18000000.00', 11),
(10, 'M010', 'Suzuki V-Strom 250', '20000000.00', 9),
(11, 'M011', 'Honda Monkey', '45000000.00', 4),
(12, 'M012', 'Kawasaki Versys 650', '55000000.00', 3),
(13, 'M013', 'Yamaha FZ6R', '60000000.00', 2),
(14, 'M014', 'Suzuki Burgman 400', '60000000.00', 5),
(15, 'M015', 'Honda Vario 150', '10000000.00', 20),
(16, 'M016', 'Yamaha NMAX', '12000000.00', 22),
(17, 'M017', 'Kawasaki KLX 150', '13000000.00', 10),
(18, 'M018', 'Honda PCX 160', '16000000.00', 14),
(19, 'M019', 'Yamaha Aerox 155', '14000000.00', 13),
(20, 'M020', 'Suzuki Satria F150', '10000000.00', 17),
(21, 'M021', 'Kawasaki Vulcan S', '40000000.00', 3),
(22, 'M022', 'Yamaha R25', '28000000.00', 6),
(23, 'M023', 'Honda Forza 250', '45000000.00', 4),
(24, 'M024', 'Suzuki Hayabusa', '85000000.00', 2),
(25, 'M025', 'Yamaha Mio M3', '7000000.00', 25),
(26, 'M026', 'Honda Beat', '8000000.00', 30),
(27, 'M027', 'Kawasaki W175', '19000000.00', 10),
(28, 'M028', 'Suzuki Nex II', '7500000.00', 28),
(29, 'M029', 'Yamaha Vega Force', '6500000.00', 32),
(30, 'M030', 'Honda Supra X 125', '9000000.00', 18),
(31, 'M031', 'Yamaha Fino 125', '8500000.00', 20),
(32, 'M032', 'Suzuki Shogun 125', '7500000.00', 15),
(33, 'M033', 'Kawasaki Ninja 150', '13000000.00', 12),
(34, 'M034', 'Honda Scoopy', '11000000.00', 25),
(35, 'M035', 'Yamaha Jupiter MX', '10000000.00', 22),
(36, 'M036', 'Suzuki Thunder 125', '9500000.00', 14),
(37, 'M037', 'Honda MegaPro', '14000000.00', 11),
(38, 'M038', 'Yamaha Byson', '15000000.00', 9),
(39, 'M039', 'Kawasaki KLX 250', '28000000.00', 5),
(40, 'M040', 'Honda CBR 250RR', '40000000.00', 7),
(41, 'M041', 'Yamaha XMAX 250', '48000000.00', 4),
(42, 'M042', 'Suzuki GSX-S150', '13500000.00', 16),
(43, 'M043', 'Honda ADV 150', '17000000.00', 14),
(44, 'M044', 'Kawasaki Z900', '60000000.00', 3),
(45, 'M045', 'Yamaha WR155R', '30000000.00', 6),
(46, 'M046', 'Honda GL-Pro', '7500000.00', 20),
(47, 'M047', 'Yamaha Crypton', '5000000.00', 18),
(48, 'M048', 'Suzuki Smash', '6000000.00', 22),
(49, 'M049', 'Kawasaki Ninja ZX-6R', '80000000.00', 2),
(50, 'M050', 'Honda Tiger', '12000000.00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `nomor_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_customer` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_produk` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nomor_transaksi`, `nomor_customer`, `kode_produk`, `tanggal_transaksi`, `jumlah`, `total_harga`) VALUES
(1, '9aedd5f', 'C001', 'M003', '2025-01-28', 1, '25000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sandi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('Admin','Kasir','User') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nama`, `sandi`, `level`) VALUES
(1, 'danang@gmail.com', 'Danang', '$2y$10$NNf56PmueDHA8Rgzs1brmO8xufgG7nleYUwrcXZQFsWJgw6LIXjsa', 'Admin'),
(2, 'kasir@gmail.com', 'Kasir', '$2y$10$3U6gF8K1ziDB34sbvqgAyjsfYdzJckAftGb2lRxdG7Joq7Lk9UUm8', 'Kasir'),
(3, 'user@gmail.com', 'User', '$2y$10$X8IziHCJuxoSC1c33UnF87oUM8WjxE7SPmYO3jqYY3PmmACkNV6Ca', 'User'),
(4, 'dio@gmail.com', 'Dio', '$2y$10$OiyBWIA2pYjcXNPYSzgpgOKePsRKETZDWyhKUBz.T10ib49pD6CS2', 'Kasir'),
(5, 'riski@gmail.com', 'Riski', '$2y$10$8uZVyjHxlDKuru9mKA5s9.K2AT5TA7KfU52D30AiIkno66e/vPB9a', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_customer` (`nomor_customer`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_customer` (`nomor_customer`),
  ADD KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`nomor_customer`) REFERENCES `customer` (`nomor_customer`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
