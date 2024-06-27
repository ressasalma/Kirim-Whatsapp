-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2024 at 07:34 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databases_2023_whatsapp_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `whatsapp` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `pesan`) VALUES
(5, 'Halo, ini pesan cobaa'),
(11, 'Halo kak $nama, selamat pagi. Apa kabar?'),
(12, 'Apa kabar $nama'),
(13, '$nama'),
(17, 'Hai Sobat Belanjo!!!/Hai $nama\r\n\r\n\r\nBuat Kamu yang sudah pernah Belanja Online di Aplikasi Belanjo, Pasti sudah tau dong, Gratis Ongkir slalu ada buat kamu Pengguna Aplikasi Belanjo Se-Kota Jambi. \r\n\r\nTerima Kasih sudah bertransaksi dilayanan Belanjo. Semoga Puas dengan Produknya, dan semoga rezeki kamu selalu dilancarkan.\r\n\r\n*AYO TUNGGU APA LAGIâ€¦.*\r\nAkan ada Promo Menarik Lainnya yang bisa Kamu dapatkan di Belanjo.\r\n_Happy Shopping!!!_ \r\n'),
(18, '_Hai Sobat Belanjo!!!/ Hai $nama\r\n\r\nSeneng banget, deh, kamu $nama pilih Belanjo buat Belanja Online. Makasih banyak, ya, semoga puas dengan produknya dan semoga rezeki kamu selalu dilancarkan.\r\n\r\nJangan Lupa Mampir lagi ya, karena bakalan ada promo menarik dan kejutan lainnya yang bisa kamu dapatkan di Aplikasi Belanjo.\r\n_Happy Shopping!!!_\r\n_');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(4, 'fajar', '$2y$10$6bbAVkviGB6HotGuC17qw.lcxhAbX1x3qUYjlj3vg0usTsVb32VKK'),
(5, 'ressa', '$2y$10$ca1V1drryH2rOeZ41tonR.y8wtevXqN8kCtqJLeDtwYsrU8Q3svp2'),
(6, 'vinna', '$2y$10$HF0Wc1S1uVrbiGo/WLW6Wuwearevo7QQ3bTlP3cYee/jn3Ds23HRO'),
(8, 'tes', '$2y$10$4hOTqyRcJ2aPy3/j797preg.YU45.pmeHUR.ZRx18pj/7IDAaAjHO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
