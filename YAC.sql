-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2016 at 02:57 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `YAC`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `user` int(3) NOT NULL,
  `judul` varchar(300) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(300) NOT NULL,
  `top` enum('tidak','ya') NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('visible','invisible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `user`, `judul`, `isi`, `gambar`, `top`, `waktu`, `status`) VALUES
(1, 2, 'Article New Edit', '<p style="margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">There are several standards that cover the encoding of data as QR codes:<sup id="cite_ref-qrstandard1_5-0" class="reference" style="line-height: 1; unicode-bidi: -webkit-isolate; white-space: nowrap; font-size: 11px;"><a href="https://en.wikipedia.org/wiki/QR_code#cite_note-qrstandard1-5" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">[5]</a></sup></p><ul style="margin: 0.3em 0px 0px 1.6em; padding: 0px; list-style-image: url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%225%22%20height%3D%2213%22%3E%0A%3Ccircle%20cx%3D%222.5%22%20cy%3D%229.5%22%20r%3D%222.5%22%20fill%3D%22%2300528c%22%2F%3E%0A%3C%2Fsvg%3E%0A); color: rgb(37, 37, 37); font-family: sans-serif;"><li style="margin-bottom: 0.1em;">October 1997 – AIM (Association for Automatic Identification and Mobility) International<sup id="cite_ref-6" class="reference" style="line-height: 1; unicode-bidi: -webkit-isolate; white-space: nowrap; font-size: 11px;"><a href="https://en.wikipedia.org/wiki/QR_code#cite_note-6" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">[6]</a></sup></li><li style="margin-bottom: 0.1em;">January 1999 – <a href="https://en.wikipedia.org/wiki/Japanese_Industrial_Standards" title="Japanese Industrial Standards" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">JIS</a> X 0510</li><li style="margin-bottom: 0.1em;">June 2000 – <a href="https://en.wikipedia.org/wiki/International_Organization_for_Standardization" title="International Organization for Standardization" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">ISO</a>/IEC 18004:2000 <i><a rel="nofollow" class="external text" href="http://www.iso.org/iso/iso_catalogue/catalogue_ics/catalogue_detail_ics.htm?csnumber=30789" style="color: rgb(102, 51, 102); background-image: linear-gradient(transparent, transparent), url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20standalone%3D%22no%22%3F%3E%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%3E%3Cpath%20fill%3D%22%23fff%22%20stroke%3D%22%2306c%22%20d%3D%22M1.5%204.518h5.982V10.5H1.5z%22%2F%3E%3Cpath%20d%3D%22M5.765%201H11v5.39L9.427%207.937l-1.31-1.31L5.393%209.35l-2.69-2.688%202.81-2.808L4.2%202.544z%22%20fill%3D%22%2306f%22%2F%3E%3Cpath%20d%3D%22M9.995%202.004l.022%204.885L8.2%205.07%205.32%207.95%204.09%206.723l2.882-2.88-1.85-1.852z%22%20fill%3D%22%23fff%22%2F%3E%3C%2Fsvg%3E); cursor: pointer; padding-right: 13px; background-position: 100% 50%, 100% 50%; background-repeat: no-repeat no-repeat;">Information technology – Automatic identification and data capture techniques – Bar code symbology – QR code</a></i> (now withdrawn)<br>Defines QR code models 1 and 2 symbols.</li><li style="margin-bottom: 0.1em;">1 September 2006 – ISO/IEC 18004:2006 <i><a rel="nofollow" class="external text" href="http://www.iso.org/iso/iso_catalogue/catalogue_tc/catalogue_detail.htm?csnumber=43655" style="color: rgb(102, 51, 102); background-image: linear-gradient(transparent, transparent), url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20standalone%3D%22no%22%3F%3E%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%3E%3Cpath%20fill%3D%22%23fff%22%20stroke%3D%22%2306c%22%20d%3D%22M1.5%204.518h5.982V10.5H1.5z%22%2F%3E%3Cpath%20d%3D%22M5.765%201H11v5.39L9.427%207.937l-1.31-1.31L5.393%209.35l-2.69-2.688%202.81-2.808L4.2%202.544z%22%20fill%3D%22%2306f%22%2F%3E%3Cpath%20d%3D%22M9.995%202.004l.022%204.885L8.2%205.07%205.32%207.95%204.09%206.723l2.882-2.88-1.85-1.852z%22%20fill%3D%22%23fff%22%2F%3E%3C%2Fsvg%3E); cursor: pointer; padding-right: 13px; background-position: 100% 50%, 100% 50%; background-repeat: no-repeat no-repeat;">Information technology – Automatic identification and data capture techniques – QR code 2005 bar code symbology specification</a></i><br>Defines QR code 2005 symbols, an extension of QR code model 2. Does not specify how to read QR code model 1 symbols, or require this for compliance.</li><li style="margin-bottom: 0.1em;">1 February 2015 – ISO/IEC 18004:2015 <i><a rel="nofollow" class="external text" href="http://www.iso.org/iso/catalogue_detail.htm?csnumber=62021" style="color: rgb(102, 51, 102); background-image: linear-gradient(transparent, transparent), url(data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20standalone%3D%22no%22%3F%3E%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%3E%3Cpath%20fill%3D%22%23fff%22%20stroke%3D%22%2306c%22%20d%3D%22M1.5%204.518h5.982V10.5H1.5z%22%2F%3E%3Cpath%20d%3D%22M5.765%201H11v5.39L9.427%207.937l-1.31-1.31L5.393%209.35l-2.69-2.688%202.81-2.808L4.2%202.544z%22%20fill%3D%22%2306f%22%2F%3E%3Cpath%20d%3D%22M9.995%202.004l.022%204.885L8.2%205.07%205.32%207.95%204.09%206.723l2.882-2.88-1.85-1.852z%22%20fill%3D%22%23fff%22%2F%3E%3C%2Fsvg%3E); cursor: pointer; padding-right: 13px; background-position: 100% 50%, 100% 50%; background-repeat: no-repeat no-repeat;">Information – Automatic identification and data capture techniques – QR Code barcode symbology specification</a></i><br>Renames the QR Code 2005 symbol to QR Code and adds clarification to some procedures and minor corrections.</li></ul>', '', 'tidak', '2016-10-26 16:51:29', 'invisible'),
(2, 2, 'aslskajlsk', '<p>asllkjasl</p>', 'no_image.jpg', 'tidak', '2016-10-26 16:52:26', 'invisible');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('unaccepted','accepted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `submenu` int(3) NOT NULL,
  `url` varchar(300) NOT NULL,
  `izin` enum('super_admin','super_admin_dan_tim','semua','') NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `submenu`, `url`, `izin`, `icon`) VALUES
(1, 'Dashboard', 0, 'bdashboard', 'super_admin_dan_tim', 'ti-panel'),
(2, 'Post', 0, 'bpost', 'super_admin_dan_tim', 'ti-layout-list-post'),
(3, 'Article', 0, 'barticle', 'super_admin_dan_tim', 'ti-book'),
(4, 'Member', 0, 'bmember', 'super_admin_dan_tim', 'ti-user'),
(5, 'Team', 0, 'bteam', 'super_admin', 'ti-face-smile'),
(6, 'Menu', 0, 'bmenu', 'super_admin', 'ti-menu'),
(7, 'Home', 0, '', 'semua', ''),
(8, 'Article', 0, '', 'semua', ''),
(9, 'Activity', 0, '', 'semua', ''),
(10, 'History', 0, '', 'semua', ''),
(11, 'Member', 0, '', 'semua', ''),
(12, 'Registration Member', 0, '', 'semua', ''),
(13, 'Feedback', 0, '', 'semua', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user` int(3) NOT NULL,
  `judul` varchar(300) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(300) NOT NULL,
  `top` enum('tidak','ya') NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('visible','invisible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user`, `judul`, `isi`, `gambar`, `top`, `waktu`, `status`) VALUES
(2, 2, 'asasas', '<p><img src="data:image/png;base64,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" data-filename="Camera-100.png" style="width: 100px;">dkadjhdkajsdhas</p><p>asdkajsdkhasda</p><p>sdasdjasda</p><p>sdasdjasd</p>', 'no_image.jpg', 'tidak', '0000-00-00 00:00:00', 'invisible'),
(3, 2, 'dadas', '<p>asas</p>', 'no_image.jpg', 'tidak', '0000-00-00 00:00:00', 'invisible'),
(4, 2, 'assas', '<p>asasss</p>', 'Camera-100.png', 'tidak', '2016-10-26 15:52:20', 'invisible'),
(5, 2, 'asasas', '<p>asas</p>', 'Camera-50.png', 'tidak', '2016-10-26 15:52:59', 'invisible'),
(6, 2, 'dadas', '<p>asassss</p>', 'no_image.jpg', 'tidak', '2016-10-26 15:44:31', 'invisible'),
(7, 2, 'sss', '<p>ss</p>', 'no_image.jpg', 'tidak', '2016-10-26 15:52:00', 'invisible'),
(8, 2, 'About QR Code', '<h1 style="text-align: center;">QR Code</h1><p style="text-align: left;">        <b style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">QR code</b><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">(abbreviated from</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><b style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">Quick Response Code</b><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">) is the trademark for a type of</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><a href="https://en.wikipedia.org/wiki/Matrix_barcode" class="mw-redirect" title="Matrix barcode" style="font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer;">matrix barcode</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">(or two-dimensional</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><a href="https://en.wikipedia.org/wiki/Barcode" title="Barcode" style="font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer;">barcode</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">) first designed for the</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><a href="https://en.wikipedia.org/wiki/Automotive_industry_in_Japan" title="Automotive industry in Japan" style="font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer;">automotive industry in Japan</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">. A barcode is a machine-readable optical label that contains information about the item to which it is attached. A QR code uses four standardized encoding modes (numeric, alphanumeric, byte/binary, and</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"> </span><a href="https://en.wikipedia.org/wiki/Kanji" title="Kanji" style="font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer;">kanji</a><span style="color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">) to efficiently store data; extensions may also be used.</span><sup id="cite_ref-QRCodefeatures_1-0" class="reference" style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 1; unicode-bidi: -webkit-isolate; white-space: nowrap; font-size: 11px;"><a href="https://en.wikipedia.org/wiki/QR_code#cite_note-QRCodefeatures-1" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">[1]</a></sup><br></p><p style="margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">The QR code system became popular outside the automotive industry due to its fast readability and greater storage capacity compared to standard <a href="https://en.wikipedia.org/wiki/Universal_Product_Code" title="Universal Product Code" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">UPC barcodes</a>. Applications include product tracking, item identification, time tracking, document management, and general marketing.<sup id="cite_ref-autogenerated1_2-0" class="reference" style="line-height: 1; unicode-bidi: -webkit-isolate; white-space: nowrap; font-size: 11px;"><a href="https://en.wikipedia.org/wiki/QR_code#cite_note-autogenerated1-2" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">[2]</a></sup></p><p style="margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;">A QR code consists of black squares arranged in a square grid on a white background, which can be read by an imaging device such as a camera, and processed using <a href="https://en.wikipedia.org/wiki/Reed%E2%80%93Solomon_error_correction" title="Reed–Solomon error correction" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">Reed–Solomon error correction</a> until the image can be appropriately interpreted. The required data are then extracted from patterns that are present in both horizontal and vertical components of the image. </p><p style="text-align: center; margin-top: 0.5em; margin-bottom: 0.5em; line-height: inherit; color: rgb(37, 37, 37); font-family: sans-serif; font-size: 14px;"><img src="data:image/png;base64,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" data-filename="59262-200.png" style="width: 200px;"><br></p><h1 style="color: rgb(0, 0, 0); text-align: center;"><a href="https://en.wikipedia.org/wiki/QR_code">from Wikipedia about Qrcode</a></h1><h1 style="text-align: center; "><b><br></b></h1>', '', 'tidak', '2016-10-26 16:05:00', 'visible'),
(9, 1, 'Try Post', '<p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<span style="font-size: 14px; color: rgb(37, 37, 37); font-family: sans-serif;">The QR code system was invented in 1994 by&nbsp;</span><a href="https://en.wikipedia.org/wiki/Denso#Denso_Wave" title="Denso" style="background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer; font-family: sans-serif;">Denso Wave</a><span style="font-size: 14px; color: rgb(37, 37, 37); font-family: sans-serif;">. Its purpose was to track vehicles during manufacture; it was designed to allow high-speed component scanning.</span><sup id="cite_ref-3" class="reference" style="line-height: 1; unicode-bidi: -webkit-isolate; white-space: nowrap; font-size: 11px; color: rgb(37, 37, 37); font-family: sans-serif;"><a href="https://en.wikipedia.org/wiki/QR_code#cite_note-3" style="color: rgb(11, 0, 128); background-image: none; cursor: pointer;">[3]</a></sup><span style="font-size: 14px; color: rgb(37, 37, 37); font-family: sans-serif;">&nbsp;QR codes now are used in a much broader context, including both commercial tracking applications and convenience-oriented applications aimed at mobile-phone users (termed mobile tagging). QR codes may be used to display text to the user, to add a&nbsp;</span><a href="https://en.wikipedia.org/wiki/VCard" title="VCard" style="background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer; font-family: sans-serif;">vCard</a><span style="font-size: 14px; color: rgb(37, 37, 37); font-family: sans-serif;">&nbsp;contact to the user''s device, to open a&nbsp;</span><a href="https://en.wikipedia.org/wiki/Uniform_Resource_Identifier" title="Uniform Resource Identifier" style="background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(11, 0, 128); background-image: none; cursor: pointer; font-family: sans-serif;">Uniform Resource Identifier</a><span style="font-size: 14px; color: rgb(37, 37, 37); font-family: sans-serif;">(URI), or to compose an e-mail or text message. Users can generate and print their own QR codes for others to scan and use by visiting one of several paid and free QR code generating sites or apps. The technology has since become one of the most-used types of two-dimensional barcode.</span><br></p>', 'Camera-1001.png', 'tidak', '2016-10-26 16:09:20', 'visible');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jabatan` enum('super_admin','tim','member') NOT NULL,
  `sosial_media` varchar(500) NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `jabatan`, `sosial_media`, `dibuat`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Super Admin', 'super_admin', '', '2016-10-19 04:32:34'),
(2, 'isgiarriza', 'e10adc3949ba59abbe56e057f20f883e', 'Isgi Arriza', 'tim', '', '2016-10-19 15:03:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
