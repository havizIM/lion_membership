-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2019 at 08:02 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_lion`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id_claim` varchar(11) NOT NULL,
  `kode_booking` varchar(6) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `tgl_claim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lampiran` text NOT NULL,
  `status_claim` enum('Proses','Valid','Tidak Valid','') NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `claim_detail`
--

CREATE TABLE `claim_detail` (
  `id_claim_detail` int(11) NOT NULL,
  `id_claim` varchar(11) NOT NULL,
  `id_poin` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `no_aplikasi` varchar(11) NOT NULL,
  `gender` enum('Mr','Mrs','Ms','') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `no_handphone` varchar(15) NOT NULL,
  `kebangsaan` enum('WNI','WNA','','') NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat_perusahaan` varchar(200) NOT NULL,
  `kota_perusahaan` varchar(30) NOT NULL,
  `kode_pos_perusahaan` varchar(10) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `no_fax` varchar(15) NOT NULL,
  `email_perusahaan` varchar(50) NOT NULL,
  `bidang_usaha` varchar(30) NOT NULL,
  `alamat_surat` enum('Rumah','Kantor','','') NOT NULL,
  `tgl_pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Proses','Terima','Tolak','') NOT NULL,
  `lampiran_1` text NOT NULL,
  `lampiran_2` text NOT NULL,
  `lampiran_3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` bigint(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `id_ref` varchar(15) NOT NULL,
  `refrensi` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `user`, `id_ref`, `refrensi`, `keterangan`, `kategori`, `tgl_log`) VALUES
(74, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-11 19:49:38'),
(75, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-11 19:50:24'),
(76, 'helpdesk', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-04-11 19:51:01'),
(77, 'helpdesk', '7201160107', 'User', 'Menambahkan data user baru', 'Add', '2019-04-11 20:00:31'),
(78, 'helpdesk', '7201160107', 'User', 'Mengedit data user', 'Edit', '2019-04-11 20:01:20'),
(79, 'helpdesk', '7201160107', 'User', 'Menghapus data user', 'Delete', '2019-04-11 20:01:44'),
(80, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-12 09:56:55'),
(81, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-12 10:03:09'),
(82, 'helpdesk', '141939', 'User', 'Menambahkan data user baru', 'Add', '2019-04-12 10:03:55'),
(83, 'helpdesk', '141939', 'User', 'Mengedit data user', 'Edit', '2019-04-12 10:04:27'),
(84, 'helpdesk', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-04-12 10:06:17'),
(85, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-12 10:08:23'),
(86, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-12 10:09:16'),
(87, 'helpdesk', '141939', 'User', 'Mengedit data user', 'Edit', '2019-04-12 10:10:14'),
(88, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-12 10:10:31'),
(89, '141939', '-', 'Auth', 'User login', 'Login', '2019-04-12 10:10:46'),
(90, '141939', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-04-12 10:11:52'),
(91, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-04-12 10:12:04'),
(92, '141939', '-', 'Auth', 'User login', 'Login', '2019-04-12 10:12:16'),
(93, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-04-12 10:12:34'),
(94, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-12 20:10:04'),
(97, '06142', '-', 'Auth', 'User Login', 'Login', '2019-04-26 17:00:00'),
(98, 'helpdesk', 'asdasd', 'asdasd', 'asdasd', 'asdasdas', '2019-06-28 17:00:00'),
(103, 'helpdesk', '-', 'Auth', 'User Login', 'Login', '2019-04-25 17:00:00'),
(104, '7201160106', '-', 'Auth', 'User Login', 'Login', '2018-12-19 17:00:00'),
(105, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:41:49'),
(106, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:42:21'),
(107, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-15 18:43:27'),
(108, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-15 18:49:34'),
(109, '06244', 'PDG', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-17 20:02:29'),
(110, '06244', 'CGK', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-17 20:03:26'),
(111, '06244', 'CGK', 'Rute', 'Menghapus data rute', 'Delete', '2019-04-17 20:05:04'),
(112, '06244', 'PDG', 'Rute', 'Mengedit data rute', 'Edit', '2019-04-17 20:08:41'),
(113, '06244', 'PDG', 'Rute', 'Mengedit data rute', 'Edit', '2019-04-17 20:09:49'),
(114, '06244', 'CGK', 'Rute', 'Menghapus data rute', 'Delete', '2019-04-17 20:10:04'),
(115, '06244', 'CGK', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-17 20:28:01'),
(116, '06244', 'POIN0001', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-04-17 20:29:10'),
(117, '06244', 'POIN0002', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-04-17 20:35:12'),
(118, '06244', 'POIN0003', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-04-17 20:35:31'),
(119, '06244', 'POIN0003', 'Poin', 'Menghapus data poin', 'Delete', '2019-04-17 20:36:35'),
(120, '06244', 'POIN0002', 'Poin', 'Menambahkan data poin baru', 'Edit', '2019-04-17 20:38:47'),
(121, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-17 21:02:21'),
(122, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-21 04:29:09'),
(123, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 04:30:08'),
(124, '06244', '-', 'Auth', 'User login', 'Login', '2019-04-21 04:30:21'),
(125, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-21 06:12:52'),
(126, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 06:13:39'),
(127, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-21 06:14:56'),
(128, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 06:15:42'),
(129, '06244', '-', 'Auth', 'User login', 'Login', '2019-04-21 06:16:04'),
(130, '06244', 'POIN0001', 'Poin', 'Menambahkan data poin baru', 'Edit', '2019-04-21 11:04:14'),
(131, '06244', 'POIN0001', 'Poin', 'Menambahkan data poin baru', 'Edit', '2019-04-21 11:04:51'),
(132, '06244', 'AMQ', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-21 11:07:03'),
(133, '06244', 'UMS', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-21 11:13:38'),
(134, '06244', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 11:15:37'),
(135, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-21 11:15:51'),
(136, 'helpdesk', '061422', 'User', 'Menambahkan data user baru', 'Add', '2019-04-21 11:16:26'),
(137, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 11:16:50'),
(138, '061422', '-', 'Auth', 'User login', 'Login', '2019-04-21 11:16:56'),
(139, '061422', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-04-21 11:17:06'),
(140, '061422', 'AMD', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-21 11:18:33'),
(141, '061422', 'AMD', 'Rute', 'Mengedit data rute', 'Edit', '2019-04-21 11:20:17'),
(142, '061422', 'BDG', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-21 11:21:18'),
(143, '061422', 'BGR', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-04-21 11:22:02'),
(144, '061422', 'POIN0003', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-04-21 11:23:45'),
(145, '061422', 'POIN0003', 'Poin', 'Menambahkan data poin baru', 'Edit', '2019-04-21 11:25:21'),
(146, '061422', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 12:31:01'),
(147, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-04-21 12:31:20'),
(148, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-04-21 12:32:21'),
(149, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-05-01 16:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `log_poin`
--

CREATE TABLE `log_poin` (
  `id_user_poin` varchar(11) NOT NULL,
  `kd_booking` varchar(6) NOT NULL,
  `id_poin` varchar(8) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `type` enum('claim','reedem','','') NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_poin`
--

CREATE TABLE `master_poin` (
  `id_poin` varchar(8) NOT NULL,
  `departure` varchar(3) NOT NULL,
  `arrival` varchar(3) NOT NULL,
  `claim_poin` int(11) NOT NULL,
  `reedem_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_poin`
--

INSERT INTO `master_poin` (`id_poin`, `departure`, `arrival`, `claim_poin`, `reedem_poin`) VALUES
('POIN0001', 'PDG', 'CGK', 437, 437000),
('POIN0002', 'CGK', 'PDG', 200, 200000),
('POIN0003', 'BGR', 'UMS', 10, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `master_rute`
--

CREATE TABLE `master_rute` (
  `id_rute` varchar(3) NOT NULL,
  `nama_rute` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_rute`
--

INSERT INTO `master_rute` (`id_rute`, `nama_rute`) VALUES
('AMD', 'Ambon Manisee'),
('AMQ', 'Ambon'),
('BDG', 'Bandung'),
('BGR', 'Bogor'),
('CGK', 'Jakarta'),
('PDG', 'Padang'),
('UMS', 'Coba');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `no_member` varchar(11) NOT NULL,
  `no_aplikasi` varchar(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `berlaku_dari` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berlaku_sampai` datetime NOT NULL,
  `token` varchar(20) NOT NULL,
  `status_member` enum('Aktif','Nonaktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reedem`
--

CREATE TABLE `reedem` (
  `id_reedem` varchar(11) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `tgl_reedem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_reedem` enum('Batal','Proses','Approve','') NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `alamat_kirim` enum('Rumah','Kantor','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reedem_detail`
--

CREATE TABLE `reedem_detail` (
  `id_reedem_detail` int(11) NOT NULL,
  `id_reedem` varchar(11) NOT NULL,
  `id_poin` varchar(8) NOT NULL,
  `no_flight` varchar(10) NOT NULL,
  `gender_pessenger` enum('Mr','Mrs','Ms','') NOT NULL,
  `nama_pessenger` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_karyawan` varchar(20) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('Admin','Customer Service','Manager','Helpdesk') NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text NOT NULL,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_karyawan`, `nama_user`, `password`, `level`, `tgl_registrasi`, `foto`, `status`, `token`) VALUES
('06142', 'Coba yaa cuk', 'd0a92', 'Customer Service', '2019-04-08 04:17:15', 'user.jpg', 'Aktif', 'eab498f404354c1'),
('061422', 'Haviz Indra Maulana', 'haviz123', 'Admin', '2019-04-21 11:16:26', 'user.jpg', 'Aktif', '87a594054bcec0d'),
('06244', 'Nabilla Yulizar', '3t6c0', 'Admin', '2019-04-08 08:25:59', 'user.jpg', 'Aktif', '7dc3ac11a0c4db2'),
('141939', 'Muliani', 'dudududu', 'Customer Service', '2019-04-12 10:03:55', 'user.jpg', 'Aktif', 'fd0db86d0525d0e'),
('7201160106', 'Kalyssa Innara Putri', 'manager', 'Manager', '2019-03-29 08:02:57', 'user.jpg', 'Aktif', 'df8f450cc77361b'),
('helpdesk', 'Helpdesk', 'h3lpd35k', 'Helpdesk', '2019-03-28 19:05:02', 'user.jpg', 'Aktif', '875a8f2f42c570f'),
('Tst', 'ttty', 'hxmbe', 'Customer Service', '2019-04-09 08:01:32', 'user.jpg', 'Aktif', 'e4c75d02dac94e7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id_claim`),
  ADD KEY `no_member` (`no_member`);

--
-- Indexes for table `claim_detail`
--
ALTER TABLE `claim_detail`
  ADD PRIMARY KEY (`id_claim_detail`),
  ADD KEY `id_claim` (`id_claim`),
  ADD KEY `id_poin` (`id_poin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`no_aplikasi`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `log_poin`
--
ALTER TABLE `log_poin`
  ADD PRIMARY KEY (`id_user_poin`),
  ADD UNIQUE KEY `kd_booking` (`kd_booking`),
  ADD KEY `id_poin` (`id_poin`),
  ADD KEY `id_customer` (`no_member`);

--
-- Indexes for table `master_poin`
--
ALTER TABLE `master_poin`
  ADD PRIMARY KEY (`id_poin`),
  ADD KEY `departure` (`departure`),
  ADD KEY `arrival` (`arrival`);

--
-- Indexes for table `master_rute`
--
ALTER TABLE `master_rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`no_member`),
  ADD KEY `no_aplikasi` (`no_aplikasi`);

--
-- Indexes for table `reedem`
--
ALTER TABLE `reedem`
  ADD PRIMARY KEY (`id_reedem`),
  ADD KEY `no_member` (`no_member`);

--
-- Indexes for table `reedem_detail`
--
ALTER TABLE `reedem_detail`
  ADD PRIMARY KEY (`id_reedem_detail`),
  ADD KEY `id_reedem` (`id_reedem`),
  ADD KEY `id_poin` (`id_poin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim_detail`
--
ALTER TABLE `claim_detail`
  MODIFY `id_claim_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `reedem_detail`
--
ALTER TABLE `reedem_detail`
  MODIFY `id_reedem_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim`
--
ALTER TABLE `claim`
  ADD CONSTRAINT `claim_ibfk_1` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Constraints for table `claim_detail`
--
ALTER TABLE `claim_detail`
  ADD CONSTRAINT `claim_detail_ibfk_1` FOREIGN KEY (`id_claim`) REFERENCES `claim` (`id_claim`) ON UPDATE CASCADE,
  ADD CONSTRAINT `claim_detail_ibfk_2` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_poin`
--
ALTER TABLE `log_poin`
  ADD CONSTRAINT `log_poin_ibfk_1` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_poin_ibfk_2` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Constraints for table `master_poin`
--
ALTER TABLE `master_poin`
  ADD CONSTRAINT `master_poin_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `master_rute` (`id_rute`) ON UPDATE CASCADE,
  ADD CONSTRAINT `master_poin_ibfk_2` FOREIGN KEY (`arrival`) REFERENCES `master_rute` (`id_rute`) ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`no_aplikasi`) REFERENCES `customer` (`no_aplikasi`) ON UPDATE CASCADE;

--
-- Constraints for table `reedem`
--
ALTER TABLE `reedem`
  ADD CONSTRAINT `reedem_ibfk_1` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Constraints for table `reedem_detail`
--
ALTER TABLE `reedem_detail`
  ADD CONSTRAINT `reedem_detail_ibfk_1` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reedem_detail_ibfk_2` FOREIGN KEY (`id_reedem`) REFERENCES `reedem` (`id_reedem`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
