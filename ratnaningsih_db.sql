-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2017 at 07:13 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ratnaningsih_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_pembayaran`
--

CREATE TABLE `item_pembayaran` (
  `id` int(11) NOT NULL,
  `program` int(11) DEFAULT NULL,
  `jenis_pembayaran` int(11) NOT NULL,
  `sekolah` int(11) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_pembayaran`
--

INSERT INTO `item_pembayaran` (`id`, `program`, `jenis_pembayaran`, `sekolah`, `harga`) VALUES
(16, 4, 14, 1, 300000),
(17, 2, 14, 2, 200000),
(18, 2, 15, 2, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `jenis` enum('pemasukan','pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id`, `kode`, `nama`, `periode`, `jenis`) VALUES
(14, 'SPP', 'SPP', 'bln', 'pemasukan'),
(15, 'KSM', 'Konsumsi', 'thn', 'pemasukan');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `sekolah` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `sekolah`, `nama`, `kapasitas`) VALUES
(19, 2, 'A1', 30);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `submenu` int(3) NOT NULL,
  `url` varchar(300) NOT NULL,
  `izin` enum('su','u','all','') NOT NULL,
  `icon` varchar(20) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `submenu`, `url`, `izin`, `icon`, `urutan`) VALUES
(4, 'Daftar Transaksi', 0, 'pembayaran', 'u', 'ti-view-list-alt', 3),
(5, 'Laporan <hr>', 0, 'laporan/harian', 'u', 'ti-files', 4),
(6, 'Murid', 0, 'murid', 'u', 'ti-face-smile', 5),
(7, 'Item Pembayaran', 0, 'itempembayaran', 'u', 'ti-pin', 7),
(8, 'Kelas', 0, 'kelas', 'u', 'ti-split-h', 6),
(9, 'Jenis Pembayaran', 0, 'jenispembayaran', 'u', 'ti-pin2', 8),
(10, '<p style="color:green;font-size:17px">Tranksasi Baru</p>', 0, 'pembayaran/search', 'u', 'ti-pencil-alt', 2);

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `nama_panggilan` varchar(20) DEFAULT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `ortu` varchar(200) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `program` int(11) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id`, `no_induk`, `nama`, `jk`, `nama_panggilan`, `ttl`, `ortu`, `alamat`, `program`, `kelas`, `tahun_ajaran`, `dibuat`) VALUES
(5, '16/TK/498', 'Atharrayhan Ababil Sanjaya', 'L', 'Athar', 'Bantul, 24 Maret 2012', 'Wahyu Santoso ', 'Perum Guwosari, Blok 12 No. 57 Pajangan Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(6, '16/TK/499', 'Daffi Zaidan Surya ', 'L', 'Daffi', 'Bantul, 19 Juni 2012', 'Danny Suryana', 'Krakitan Rt 07 Soro Paten Ringinharjo', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(7, '16/TK/500', 'Dhatan Arzaqi', 'L', 'Dhatan', 'Yogyakarta, 21 September 2012', 'M. Reza Bastari', 'Perum Griya Mrisi Indah 13-5 Tirtonirmolo Kasihan Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(8, '16/TK/501', 'Dicky Fahreza', 'L', 'Dicky', 'Pekalongan, 7 April 2012', 'Khaerudin', 'Jedigan Pasutan Trirenggo Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(9, '16/TK/502', 'Gayuh Lintang Pamungkas ', 'P', 'Lintang', 'Bantul, 06 April 2012', 'Rohman Purwanto', 'Perum Bumi Guwosari Blok 12, Jl. Abiyoso Raya No. 50 Pajangan ', 3, 19, '2017/2018', '2017-04-20 09:36:28'),
(10, '16/TK/503', 'Gendis Raras Pramuditya', 'P', 'Gendis', 'Bantul, 3 Maret 2012', 'Arif Nur Rohman ', 'Deresan Rt 02/05 Ringin Harjo Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(11, '16/TK/504', 'Haafizh Shaafi An Nur ', 'L', 'Shaafi', 'Bantul, 8 November 2011', 'Nuriyanto', 'Nogosari II RT 03, Wukirsari, Imogiri Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(12, '16/TK/505', 'Hanif Maulana Chunaefi', 'L', 'Hanif', 'Bantul, 14 Oktober 2011', 'Ardhiyanto Prasetya', 'Gedriyan RT 02, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(13, '16/TK/506', 'Helga Arawinda Putri', 'P', 'Ara', 'Bantul, 19 Maret 2012', NULL, 'Perum Kembang Putihan Guwosari Pajangan Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(14, '16/TK/507', 'Ilmyra Verlitha Putri Alodya ', 'P', 'Ilmyra', 'Bantul, 12 Februari ', 'Indarta, S.E.', 'Kalak Ijo Guwo Sari Pajangan Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(15, '16/TK/508', 'Khansa Azalia Syakira Andini ', 'P', 'Lili', 'Bantul, 21 April 2012', 'Andi Darwwanto', 'Melikan Lor, RT 04, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(16, '16/TK/509', 'Lituhayu Bening Hartanto', 'P', 'Litu', 'Bantul, 22 Desember 2011', 'Winarno Hartanto', 'Suruhan RT 05, Gabusan, Timbulharjo, Sewon, Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(17, '16/TK/510', 'Maitsa Purnani Purohito', 'P', 'Maitsa', 'Bantul, 19 Oktober 2011', 'Rochaniyanto', 'Turi Rt 05, Sumberagung, Jetis, Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(18, '16/TK/511', 'Muhammad Cholilulloh', 'L', 'Cholil', 'Bantul, 30 November 2011', 'Nawwir', 'Bejen RT 05, Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(19, '16/TK/512', 'Naura Azzahra Putri', 'P', 'Naura', 'Sleman, 23 Desember 2011', 'Bagus Dwi Marwanto', 'Dagen Pendowoharjo Sewon Bantul', 3, 19, '2017/2018', '2017-04-20 09:36:28'),
(20, '16/TK/513', 'Nazuan Nafis Azraqi', 'L', 'Nafis', 'Bantul, 10 Maret 2012', 'Isyanto', 'Turi 03, Sumberagung, Jetis, Bantul', 3, 19, '2017/2018', '2017-04-20 09:36:28'),
(21, '16/TK/514', 'Raihani Bilqis Aya Sofia ', 'P', 'Sofi', 'Bantul, 16 Oktober 2011', 'Hendro Prayitno', 'Nyangkringan RT 04, Bantul 55711', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(22, '16/TK/515', 'Raka Zeno Santosa ', 'L', 'Raka', 'Bantul, 15 Februari 2012', 'Agus Santosa, S.T.', 'Rendeng Kulon, Dk. Gabusan, Timbulharjo, Sewon, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(23, '16/TK/516', 'Salma Fadhilatus Sani', 'P', 'Salma', 'Bantul, 22 Februari 2012', 'Sumardi', 'Tanjung Karang Patalan Jetis Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(24, '16/TK/517', 'Shafy Abiyu Rahman', 'L', 'Abiyu', 'Bantul, 21 April 2012', 'Kardiman ', 'Polaman RT 04, Triwidadi, Pajangan , Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(25, '16/TK/518', 'Syafiqa Naya Satrio Putri', 'P', 'Naya', 'Sleman, 29 Juli 2012', 'Satrio Arif wibowo, S.H.', 'Gelangan Rt.15 Patalan Jetis Bantul', 4, 19, '2017/2018', '2017-04-20 09:36:28'),
(26, '16/TK/519', 'Syifa'' Aulia Fadhilah ', 'P', 'Syifa', 'Bantul, 05 Desember 2011', 'Bardono', 'Jogodayoh Sumbermulyo Bambanglipuro', 3, 19, '2017/2018', '2017-04-20 09:36:28'),
(27, '16/TK/520', 'Yola Refalia Anjani Choirunnisa', 'P', 'Yola', 'Bantul, 4 November 2011', 'Tarmizan', 'Gemahan, Ringinharjo, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(28, '16/TK/521', 'Zahira Queenara Pratama', 'P', 'Ara', 'Bantul, 28 November 2011', 'Praptomo', 'Kaliputih, Pendowoharjo, Sewon, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28'),
(29, '16/TK/524', 'Bayu Hafidz Ristiawan', 'L', 'Bayu ', 'Bantul, 22 Maret 2012', 'Budi Ristiawan', 'Cepor Lor RT 02, Taskombang, Palbapang, Bantul', 2, 19, '2017/2018', '2017-04-20 09:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `murid` int(11) NOT NULL,
  `item_pembayaran` int(11) NOT NULL,
  `penyetor` varchar(200) NOT NULL,
  `nominal` int(50) NOT NULL,
  `tgl_setoran` datetime NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `murid`, `item_pembayaran`, `penyetor`, `nominal`, `tgl_setoran`, `dibuat`) VALUES
(12, 10, 17, 'Bapake', 20000, '2017-03-01 00:00:00', '2017-04-20 09:55:59'),
(13, 10, 17, 'Bapake', 20000, '2017-04-20 00:00:00', '2017-04-20 09:57:15'),
(14, 10, 17, 'Bapake', 20000, '2017-03-03 00:00:00', '2017-04-20 09:58:03'),
(15, 10, 18, 'Bapake', 20000, '2017-01-01 00:00:00', '2017-04-20 10:02:01'),
(16, 10, 18, 'Bapake', 20000, '2017-04-20 00:00:00', '2017-04-20 10:03:57'),
(17, 20, 18, 'Bapake', 20000, '2017-04-20 00:00:00', '2017-04-20 10:04:39'),
(18, 10, 17, 'Bapake', 180000, '2017-04-21 00:00:00', '2017-04-20 11:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `nama`) VALUES
(1, 'Tidak Ada'),
(2, 'Reguler'),
(3, 'Halfday'),
(4, 'Fullday');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `yayasan` varchar(50) NOT NULL,
  `derajat` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `yayasan`, `derajat`, `nama`, `alamat`, `dibuat`) VALUES
(1, 'Ratnaningsih', 'KB', 'Ratnaningsih', NULL, '2016-11-04 11:19:43'),
(2, 'Ratnaningsih', 'TK', 'Ratnaningsih', NULL, '2016-11-04 11:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jabatan` enum('su','u') NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `jabatan`, `dibuat`) VALUES
(12, 'ratna', 'e10adc3949ba59abbe56e057f20f883e', 'Ratna', 'u', '2016-11-04 11:19:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_pembayaran`
--
ALTER TABLE `item_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program` (`program`),
  ADD KEY `jenis_transaksi` (`jenis_pembayaran`),
  ADD KEY `sekolah` (`sekolah`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sekolah` (`sekolah`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`program`),
  ADD KEY `kelas_2` (`program`),
  ADD KEY `program` (`kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_transaksi` (`item_pembayaran`),
  ADD KEY `murid` (`murid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
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
-- AUTO_INCREMENT for table `item_pembayaran`
--
ALTER TABLE `item_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_pembayaran`
--
ALTER TABLE `item_pembayaran`
  ADD CONSTRAINT `item_pembayaran_ibfk_1` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pembayaran_ibfk_2` FOREIGN KEY (`jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pembayaran_ibfk_3` FOREIGN KEY (`sekolah`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`sekolah`) REFERENCES `sekolah` (`id`);

--
-- Constraints for table `murid`
--
ALTER TABLE `murid`
  ADD CONSTRAINT `murid_ibfk_1` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `murid_ibfk_2` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`murid`) REFERENCES `murid` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`item_pembayaran`) REFERENCES `item_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
