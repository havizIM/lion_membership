-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2019 pada 14.17
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.1.29

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
-- Struktur dari tabel `claim`
--

CREATE TABLE `claim` (
  `id_claim` varchar(11) NOT NULL,
  `kode_booking` varchar(6) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `tgl_claim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_claim` enum('Proses','Valid','Tidak Valid','') NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `claim`
--

INSERT INTO `claim` (`id_claim`, `kode_booking`, `no_member`, `tgl_claim`, `status_claim`, `keterangan`) VALUES
('CL-00000001', 'DGDSGF', '30491728056', '2019-08-01 09:46:57', 'Proses', ''),
('CL-00000002', 'DGDSGF', '30491728056', '2019-08-01 09:49:55', 'Proses', ''),
('CL-00000003', 'DGDSGF', '30491728056', '2019-08-01 09:50:48', 'Proses', ''),
('CL-00000004', 'ADGNDA', '30491728056', '2019-08-01 09:56:05', 'Proses', ''),
('CL-00000005', 'ahsfgf', '30491728056', '2019-08-01 09:57:14', 'Proses', ''),
('CL-00000006', 'ahgrsg', '30491728056', '2019-08-01 09:58:01', 'Proses', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_detail`
--

CREATE TABLE `claim_detail` (
  `id_claim_detail` int(11) NOT NULL,
  `id_claim` varchar(11) NOT NULL,
  `id_poin` varchar(8) NOT NULL,
  `lampiran_claim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `claim_detail`
--

INSERT INTO `claim_detail` (`id_claim_detail`, `id_claim`, `id_poin`, `lampiran_claim`) VALUES
(11, 'CL-00000001', 'POIN0002', 'yeolallineed___BtxJRe6h4Ey___.jpg'),
(12, 'CL-00000001', 'POIN0001', 'wallpaper1.jpg'),
(13, 'CL-00000002', 'POIN0002', 'yeolallineed___BtxJRe6h4Ey___1.jpg'),
(14, 'CL-00000002', 'POIN0001', 'wallpaper11.jpg'),
(15, 'CL-00000003', 'POIN0002', 'yeolallineed___BtxJRe6h4Ey___2.jpg'),
(16, 'CL-00000003', 'POIN0001', 'wallpaper12.jpg'),
(17, 'CL-00000004', 'POIN0002', 'yeolallineed___BtxJRe6h4Ey___3.jpg'),
(18, 'CL-00000004', 'POIN0001', 'yeolallineed___BtxJRe6h4Ey___4.jpg'),
(19, 'CL-00000005', 'POIN0001', 'yeolallineed___BtxJRe6h4Ey___5.jpg'),
(20, 'CL-00000006', 'POIN0002', 'yeolallineed___BtxJRe6h4Ey___6.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
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
  `lampiran_daftar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`no_aplikasi`, `gender`, `nama`, `alamat`, `kota`, `kode_pos`, `no_handphone`, `kebangsaan`, `no_identitas`, `email`, `nama_perusahaan`, `alamat_perusahaan`, `kota_perusahaan`, `kode_pos_perusahaan`, `jabatan`, `no_tlp`, `no_fax`, `email_perusahaan`, `bidang_usaha`, `alamat_surat`, `tgl_pengajuan`, `status`, `lampiran_daftar`) VALUES
('00000000001', 'Mr', 'Haviz Indra Maulana', 'Jl. Jakarta', 'Jakarta Barat', '11210', '081355754092', 'WNI', '1839517957291364365', 'si.ubk16@gmail.com', 'PT. CodeManiac', 'Jakarta', 'Jakarta Barat', '11210', 'CEO', '081355754092', '02199876542', 'si.ubk16@gmail.com', 'Startup', 'Rumah', '2019-05-24 13:53:49', 'Terima', '00000000001.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `flight`
--

CREATE TABLE `flight` (
  `no_flight` varchar(10) NOT NULL,
  `departure` varchar(3) NOT NULL,
  `arrival` varchar(3) NOT NULL,
  `tgl_berangkat` datetime NOT NULL,
  `tgl_tiba` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
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
-- Dumping data untuk tabel `log`
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
(149, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-05-01 16:58:11'),
(150, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-06-18 09:25:49'),
(151, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-06-18 09:26:25'),
(152, '061422', '-', 'Auth', 'User login', 'Login', '2019-06-18 09:26:35'),
(153, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-06-24 13:58:39'),
(154, '061422', '-', 'Auth', 'User login', 'Login', '2019-07-05 16:10:39'),
(155, '061422', '00000000001', 'Aplikasi', 'Terima aplikasi pengajuan LPC', 'Terima', '2019-07-05 16:10:52'),
(156, 'helpdesk', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-07-05 18:03:38'),
(157, 'helpdesk', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-07-05 18:12:28'),
(158, 'helpdesk', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-07-05 18:12:45'),
(159, 'helpdesk', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-07-05 18:13:33'),
(160, 'helpdesk', 'CL-00000001', 'Claim', 'Menolak data claim', 'Tidak Valid', '2019-07-05 18:33:14'),
(161, 'helpdesk', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-07-05 18:33:23'),
(162, '061422', 'POIN0004', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-07-06 08:32:20'),
(163, '061422', '-', 'Auth', 'User logout', 'Logout', '2019-07-06 09:19:38'),
(164, '061422', '-', 'Auth', 'User login', 'Login', '2019-07-06 19:33:44'),
(165, '061422', '-', 'Auth', 'User login', 'Login', '2019-07-07 14:30:30'),
(166, '061422', '-', 'Auth', 'User login', 'Login', '2019-07-19 21:24:04'),
(167, '061422', '-', 'Auth', 'User logout', 'Logout', '2019-07-19 21:42:11'),
(168, '06142', '-', 'Auth', 'User login', 'Login', '2019-07-19 21:42:41'),
(169, '06142', '-', 'Auth', 'User login', 'Login', '2019-07-20 02:34:13'),
(170, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-07-21 09:36:20'),
(171, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-07-21 09:36:53'),
(172, 'Tst', '-', 'Auth', 'User login', 'Login', '2019-07-21 09:36:58'),
(173, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-07-31 22:46:06'),
(174, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-07-31 22:46:51'),
(175, '06244', '-', 'Auth', 'User login', 'Login', '2019-07-31 22:46:58'),
(176, '141939', '-', 'Auth', 'User login', 'Login', '2019-07-31 22:49:13'),
(177, '06244', '00000000001', 'Aplikasi', 'Terima aplikasi pengajuan LPC', 'Terima', '2019-07-31 23:05:37'),
(178, '06244', '00000000001', 'Aplikasi', 'Terima aplikasi pengajuan LPC', 'Terima', '2019-07-31 23:38:29'),
(179, '06244', '123123123', 'Member', 'Menonaktifkan Member', 'Nonaktif', '2019-08-01 00:04:26'),
(180, '06244', '123123123', 'Member', 'Menonaktifkan Member', 'Aktif', '2019-08-01 00:06:34'),
(181, '06244', '123123123', 'Member', 'Mengupdate Member', 'Upgrade', '2019-08-01 00:08:40'),
(182, '06244', '123123123', 'Member', 'Mengupdate Member', 'Downgrade', '2019-08-01 00:08:45'),
(183, '06244', '123123123', 'Member', 'Menonaktifkan Member', 'Nonaktif', '2019-08-01 00:09:00'),
(184, '06244', '123123123', 'Member', 'Menonaktifkan Member', 'Aktif', '2019-08-01 00:09:31'),
(185, '06244', '123123123', 'Member', 'Mengupdate Member', 'Upgrade', '2019-08-01 00:09:38'),
(186, '06244', '123123123', 'Member', 'Mengupdate Member', 'Downgrade', '2019-08-01 00:09:43'),
(187, '06244', '123123123', 'Member', 'Mengupdate Member', 'Upgrade', '2019-08-01 00:10:32'),
(188, '06244', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 00:22:17'),
(189, '061422', '-', 'Auth', 'User login', 'Login', '2019-08-01 00:27:11'),
(190, '061422', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 00:45:45'),
(191, '141939', 'RDM', 'Redeem', 'Memvalidasi data poin', 'Approval', '2019-08-01 02:15:03'),
(192, '141939', 'RDM', 'Redeem', 'Menolak data redeem', 'Tolak', '2019-08-01 02:54:21'),
(193, '141939', 'RDM', 'Redeem', 'Memvalidasi data poin', 'Approval', '2019-08-01 02:55:55'),
(194, '141939', 'RDM', 'Redeem', 'Memvalidasi data poin', 'Approval', '2019-08-01 02:57:19'),
(195, '141939', 'CL-00000001', 'Claim', 'Menolak data claim', 'Tidak Valid', '2019-08-01 03:05:19'),
(196, '141939', 'CL-00000001', 'Claim', 'Menolak data claim', 'Tidak Valid', '2019-08-01 04:14:33'),
(197, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 04:15:30'),
(198, '7201160106', '-', 'Auth', 'User login', 'Login', '2019-08-01 04:15:39'),
(199, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 05:14:21'),
(200, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 05:14:37'),
(201, '06244', '-', 'Auth', 'User login', 'Login', '2019-08-01 05:14:43'),
(202, '06244', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 05:14:50'),
(203, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 05:15:04'),
(204, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 05:15:21'),
(205, '06142', '-', 'Auth', 'User login', 'Login', '2019-08-01 05:15:27'),
(206, '7201160106', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 05:56:15'),
(207, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 06:12:51'),
(208, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 11:20:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_poin`
--

CREATE TABLE `log_poin` (
  `id_user_poin` int(11) NOT NULL,
  `kode_booking` varchar(6) NOT NULL,
  `id_poin` varchar(8) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `type` enum('claim','redeem','','') NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_poin`
--

INSERT INTO `log_poin` (`id_user_poin`, `kode_booking`, `id_poin`, `no_member`, `type`, `tgl_log`) VALUES
(5, 'BIDNKA', 'POIN0002', '30491728056', 'claim', '2019-07-05 18:13:33'),
(6, 'BIDNKA', 'POIN0001', '30491728056', 'claim', '2019-07-05 18:13:33'),
(7, 'BIDNKA', 'POIN0002', '30491728056', 'claim', '2019-07-05 18:33:23'),
(8, 'BIDNKA', 'POIN0001', '30491728056', 'claim', '2019-07-05 18:33:23'),
(9, 'FLG001', 'POIN0003', '30491728056', 'redeem', '2019-08-01 02:15:03'),
(10, 'FLG001', 'POIN0003', '30491728056', 'redeem', '2019-08-01 02:55:55'),
(11, 'FLG001', 'POIN0003', '30491728056', 'redeem', '2019-08-01 02:57:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_poin`
--

CREATE TABLE `master_poin` (
  `id_poin` varchar(8) NOT NULL,
  `departure` varchar(3) NOT NULL,
  `arrival` varchar(3) NOT NULL,
  `claim_poin` int(11) NOT NULL,
  `redeem_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_poin`
--

INSERT INTO `master_poin` (`id_poin`, `departure`, `arrival`, `claim_poin`, `redeem_poin`) VALUES
('POIN0001', 'PDG', 'CGK', 437, 437000),
('POIN0002', 'CGK', 'PDG', 200, 200000),
('POIN0003', 'BGR', 'UMS', 10, 10000),
('POIN0004', 'BGR', 'AMQ', 100, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_rute`
--

CREATE TABLE `master_rute` (
  `id_rute` varchar(3) NOT NULL,
  `nama_rute` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_rute`
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
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `no_member` varchar(11) NOT NULL,
  `no_aplikasi` varchar(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `berlaku_dari` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berlaku_sampai` datetime NOT NULL,
  `tipe` enum('Blue','Gold','','') NOT NULL,
  `token` varchar(20) NOT NULL,
  `status_member` enum('Aktif','Nonaktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`no_member`, `no_aplikasi`, `password`, `berlaku_dari`, `berlaku_sampai`, `tipe`, `token`, `status_member`) VALUES
('123123123', '00000000001', 'hx812', '2019-07-31 23:00:00', '2021-08-01 00:00:00', 'Gold', '88ea39439e74fa27c09a', 'Aktif'),
('30491728056', '00000000001', 'vm8wi', '2019-07-04 23:00:00', '2021-07-05 00:00:00', 'Blue', 'd569a7c6464d2cfce87b', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `redeem`
--

CREATE TABLE `redeem` (
  `id_redeem` varchar(11) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `tgl_redeem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_redeem` enum('Tolak','Proses','Approve','') NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `alamat_kirim` enum('Rumah','Kantor','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `redeem`
--

INSERT INTO `redeem` (`id_redeem`, `no_member`, `tgl_redeem`, `status_redeem`, `keterangan`, `alamat_kirim`) VALUES
('RDM', '30491728056', '2019-08-01 01:12:12', 'Approve', 'Tidak ada blablabla', 'Rumah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `redeem_detail`
--

CREATE TABLE `redeem_detail` (
  `id_redeem_detail` int(11) NOT NULL,
  `id_redeem` varchar(11) NOT NULL,
  `id_poin` varchar(8) NOT NULL,
  `no_flight` varchar(10) NOT NULL,
  `gender_pessenger` enum('Mr','Mrs','Ms','') NOT NULL,
  `nama_pessenger` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `redeem_detail`
--

INSERT INTO `redeem_detail` (`id_redeem_detail`, `id_redeem`, `id_poin`, `no_flight`, `gender_pessenger`, `nama_pessenger`) VALUES
(1, 'RDM', 'POIN0003', 'FLG001', 'Mr', 'Test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
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
-- Indeks untuk tabel `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id_claim`),
  ADD KEY `no_member` (`no_member`);

--
-- Indeks untuk tabel `claim_detail`
--
ALTER TABLE `claim_detail`
  ADD PRIMARY KEY (`id_claim_detail`),
  ADD KEY `id_claim` (`id_claim`),
  ADD KEY `id_poin` (`id_poin`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`no_aplikasi`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user` (`user`);

--
-- Indeks untuk tabel `log_poin`
--
ALTER TABLE `log_poin`
  ADD PRIMARY KEY (`id_user_poin`),
  ADD KEY `id_poin` (`id_poin`),
  ADD KEY `id_customer` (`no_member`);

--
-- Indeks untuk tabel `master_poin`
--
ALTER TABLE `master_poin`
  ADD PRIMARY KEY (`id_poin`),
  ADD KEY `departure` (`departure`),
  ADD KEY `arrival` (`arrival`);

--
-- Indeks untuk tabel `master_rute`
--
ALTER TABLE `master_rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`no_member`),
  ADD KEY `no_aplikasi` (`no_aplikasi`);

--
-- Indeks untuk tabel `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id_redeem`),
  ADD KEY `no_member` (`no_member`);

--
-- Indeks untuk tabel `redeem_detail`
--
ALTER TABLE `redeem_detail`
  ADD PRIMARY KEY (`id_redeem_detail`),
  ADD KEY `id_reedem` (`id_redeem`),
  ADD KEY `id_poin` (`id_poin`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `claim_detail`
--
ALTER TABLE `claim_detail`
  MODIFY `id_claim_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT untuk tabel `log_poin`
--
ALTER TABLE `log_poin`
  MODIFY `id_user_poin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `redeem_detail`
--
ALTER TABLE `redeem_detail`
  MODIFY `id_redeem_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `claim`
--
ALTER TABLE `claim`
  ADD CONSTRAINT `claim_ibfk_1` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `claim_detail`
--
ALTER TABLE `claim_detail`
  ADD CONSTRAINT `claim_detail_ibfk_1` FOREIGN KEY (`id_claim`) REFERENCES `claim` (`id_claim`) ON UPDATE CASCADE,
  ADD CONSTRAINT `claim_detail_ibfk_2` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`);

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_poin`
--
ALTER TABLE `log_poin`
  ADD CONSTRAINT `log_poin_ibfk_1` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_poin_ibfk_2` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `master_poin`
--
ALTER TABLE `master_poin`
  ADD CONSTRAINT `master_poin_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `master_rute` (`id_rute`) ON UPDATE CASCADE,
  ADD CONSTRAINT `master_poin_ibfk_2` FOREIGN KEY (`arrival`) REFERENCES `master_rute` (`id_rute`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`no_aplikasi`) REFERENCES `customer` (`no_aplikasi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `redeem`
--
ALTER TABLE `redeem`
  ADD CONSTRAINT `redeem_ibfk_1` FOREIGN KEY (`no_member`) REFERENCES `member` (`no_member`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `redeem_detail`
--
ALTER TABLE `redeem_detail`
  ADD CONSTRAINT `redeem_detail_ibfk_1` FOREIGN KEY (`id_poin`) REFERENCES `master_poin` (`id_poin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `redeem_detail_ibfk_2` FOREIGN KEY (`id_redeem`) REFERENCES `redeem` (`id_redeem`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
