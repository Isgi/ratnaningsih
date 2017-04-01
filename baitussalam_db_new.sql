-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2017 at 09:40 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baitussalam_db_new`
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
(1, 1, 1, 1, 50000),
(2, 1, 1, 2, 50000),
(3, 1, 1, 3, 50000),
(4, 1, 1, 4, 50000),
(5, 2, 1, 1, 70000),
(6, 2, 1, 2, 70000),
(7, 2, 1, 3, 70000),
(8, 2, 1, 4, 70000),
(13, 1, 2, 1, 100000),
(14, 1, 2, 2, 100000),
(15, 1, 2, 3, 100000),
(16, 1, 2, 4, 100000),
(17, 1, 3, 4, 900000);

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
(1, 'SPP', 'SPP', 'bln', 'pemasukan'),
(2, 'KSM', 'Konsumsi', 'thn', 'pemasukan'),
(3, 'IRN', 'Iuran', 'tdk', 'pemasukan');

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
(1, 4, '1A', 30);

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
(1, 'Daftar Transaksi', 0, 'pembayaran', 'u', 'ti-view-list-alt', 2),
(2, 'Laporan <hr>', 0, 'laporan', 'u', 'ti-files', 3),
(3, 'Transaksi Baru', 0, 'pembayaran/search', 'u', 'ti-pencil-alt', 1),
(4, 'Murid', 0, 'murid', 'u', 'ti-face-smile', 4),
(5, 'Kelas', 0, 'kelas', 'u', 'ti-split-h', 5),
(6, 'Item Pembayaran', 0, 'itempembayaran', 'su', 'ti-pin', 6),
(7, 'Jenis Pembayaran', 0, 'jenispembayaran', 'su', 'ti-pin2', 7);

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `program` int(11) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id`, `no_induk`, `nama`, `no_telp`, `program`, `kelas`, `tahun_ajaran`, `dibuat`) VALUES
(2, '0105023955', '''AQILA RAYHANA ''URFA', '085799017419', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(3, '0101713952', 'AAYATUL HUSNA SETYO PANGESTI', '082221984909', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(4, '0099551741', 'ABIA KHAIRAN', '081919992525', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(5, '0092173832', 'ALMIRA KHSYI ATHA BRYNA', NULL, 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(6, '0107201731', 'AZHAR HAFIZUDDIN SWANDARU', '085600097785', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(7, '0108509875', 'BIMA ADITYA EKA WINATA', '085278778971', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(8, '0106463629', 'DAFFA ZAIN FAWWAZ REYHAN', '081578569500', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(9, '0105994293', 'DZAKI FATHURAHMAN', '087834886183', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(10, '0108812165', 'FATHIA SHABRINA PUTRI RIYANTO', '082134609084', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(11, '0093704233', 'FATIH RIZQI AZHAR RAMADHAN', '0811298812', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(12, '0101571380', 'GHOZI AHMAD RASYID', '081254133710', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(13, '0103744126', 'GRISSELDA KIRANA', '082254805433', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(14, '0097866084', 'HIMA ADDURROH AL FAKHIROH', '085292143120', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(15, '0093988518', 'KARISMA QUINSA HARSOYO', '081391763677', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(16, '0097372528', 'KHANSA ANANDITA BAWONO', '085228437666', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(17, '0109100835', 'KHANSA MUFIDA QURROTA A''YUN', '081802661611', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(18, '0109464333', 'LAILA SHOLIHAH', '087734555894', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(19, '0093471086', 'LUTHFIANA FADLIKA', '085600774070', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(20, '0094760545', 'MAULANA BAGAS EKA SAPUTRA', '081282155537', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(21, '0107640227', 'MUALLIFA LULU ALHAYA', '087739101585', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(22, '0101576200', 'MUHAMAD IBRAHIM HAMKA', '082137711230', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(23, '0096070525', 'MUHAMMAD ALMAS ADINATA ADZAMY', '0813253394442', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(24, '0093311371', 'MUHAMMAD NAKHLA EL AZZAM', '081215866331', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(25, '0092141853', 'MUHAMMAD RAFI ARDANA', NULL, 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(26, '0107962007', 'MUHAMMAD SURYATAMA', '085292247533', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(27, '0096918168', 'MUHAMMAD ZABIR NUGRAHA', '085281022450', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(28, '0092724944', 'RAHMA FATMA SHOLIHAH', '081392503203', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(29, '0092166375', 'RAIHANUN NAFIAH', '081328431175', 1, 1, '2016/2017', '2017-03-23 04:08:14'),
(30, '0095004196', 'ZAHRA NAFEEZA ZALFA EKASIH IRWANTO', '082134611911', 1, 1, '2016/2017', '2017-03-23 04:08:14');

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
(6, 13, 16, 'Isgi', 20000, '2017-03-06 00:00:00', '2017-03-23 06:06:56'),
(7, 13, 16, 'Isgi', 20000, '2017-04-07 00:00:00', '2017-03-23 06:07:30'),
(14, 15, 17, 'Isgi', 10000, '2017-03-27 00:00:00', '2017-03-27 21:38:38'),
(15, 15, 17, 'Isgi', 10000, '2017-03-28 00:00:00', '2017-03-27 21:39:22'),
(16, 13, 17, 'Isgi', 20000, '2017-03-27 00:00:00', '2017-03-27 21:39:51'),
(17, 13, 4, 'isgi', 25000, '2017-03-27 00:00:00', '2017-03-27 21:59:26'),
(18, 15, 4, 'isgi', 25000, '2017-03-27 00:00:00', '2017-03-27 21:59:47'),
(20, 15, 4, 'isgi', 25000, '2017-03-27 00:00:00', '2017-03-27 22:01:28'),
(21, 15, 4, 'isgi', 25000, '2017-04-27 00:00:00', '2017-03-27 22:04:52');

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
(1, 'biasa'),
(2, 'fullday');

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
(1, 'Baitussalam', 'KB', 'Baitussalam KB', '-', '2017-03-23 00:00:00'),
(2, 'Baitussalam', 'TB', 'Baitussalam TB', '-', '2017-03-23 00:00:00'),
(3, 'Baitussalam', 'TK', 'Baitussalam TK', '-', '2017-03-23 00:00:00'),
(4, 'Baitussalam', 'SD', 'Baitussalam SD', '-', '2017-03-23 00:00:00');

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
(1, 'admin', '6cb1601ac0fa87d27e1d8ea9a9cab161', 'Admin', 'su', '2017-03-23 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
