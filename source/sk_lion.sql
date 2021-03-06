-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2019 pada 06.15
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
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `kd_booking` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`kd_booking`) VALUES
('ADGJLP'),
('ERDFXC'),
('MLPOKN'),
('OIKJNB'),
('QAZXSW'),
('QETUOP'),
('SFHKOI'),
('XVNLJG'),
('ZCBMLK'),
('ZMALQP');

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
('CL-00000001', 'ADGJLP', '30491728056', '2019-08-20 04:14:42', 'Proses', '');

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
(1, 'CL-00000001', 'POIN0001', 'yeolallineed___BtxJRe6h4Ey___1.jpg');

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
('00000000001', 'Mr', 'Haviz Indra Maulana', 'Jl. KH Moch Mansyur Rt. 010 Rw. 05', 'Jakarta Barat', '11210', '081355754092', 'WNA', '3339991111333666', 'viz.ndinq@gmail.com', 'PT. CodeManiac Indo', 'Jl. Dimana mana', 'Jakarta Barat', '11210', 'CEO', '081355754092', '021123123', 'codemanindo@gmail.com', 'Jasa Joki', 'Rumah', '2019-08-01 16:10:33', 'Terima', '00000000001.jpg'),
('00000000002', 'Mr', 'Haviz Indra Maulana', 'Jakarta', 'DKI Jakarta', '11210', '081355754092', 'WNI', '3339991111333666', 'haviz_im@outlook.com', '', '', '', '', '', '', '', '', '', 'Rumah', '2019-08-17 18:31:40', 'Proses', '00000000002.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `flight`
--

CREATE TABLE `flight` (
  `no_flight` varchar(6) NOT NULL,
  `departure` varchar(3) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival` varchar(3) NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `flight`
--

INSERT INTO `flight` (`no_flight`, `departure`, `departure_date`, `departure_time`, `arrival`, `arrival_date`, `arrival_time`, `duration`) VALUES
('JT001', 'CGK', '2019-08-20', '13:00:00', 'SUB', '2019-08-20', '09:00:00', '04:00:00'),
('JT002', 'CGK', '2019-08-20', '14:00:00', 'SUB', '2019-08-20', '10:00:00', '04:00:00'),
('JT131', 'CGK', '2019-08-20', '17:25:00', 'KNO', '2019-08-20', '13:00:00', '04:25:00'),
('JT204', 'KNO', '2019-08-20', '13:10:00', 'CGK', '2019-08-20', '10:50:00', '02:20:00'),
('JT206', 'KNO', '2019-08-20', '18:30:00', 'CGK', '2019-08-20', '16:10:00', '02:20:00'),
('JT294', 'KNO', '2019-08-20', '19:30:00', 'CGK', '2019-08-20', '16:00:00', '03:30:00'),
('JT295', 'CGK', '2019-08-20', '20:15:00', 'KNO', '2019-08-20', '16:40:00', '03:35:00'),
('JT303', 'CGK', '2019-08-20', '14:15:00', 'KNO', '2019-08-20', '11:50:00', '02:25:00'),
('JT305', 'CGK', '2019-08-20', '20:40:00', 'KNO', '2019-08-20', '18:20:00', '02:25:00'),
('JT306', 'KNO', '2019-08-20', '14:10:00', 'CGK', '2019-08-20', '11:50:00', '02:20:00'),
('JT308', 'KNO', '2019-08-20', '07:05:00', 'CGK', '2019-08-20', '04:45:00', '02:20:00'),
('JT309', 'CGK', '2019-08-20', '21:35:00', 'KNO', '2019-08-20', '19:10:00', '02:25:00'),
('JT382', 'KNO', '2019-08-20', '15:10:00', 'CGK', '2019-08-20', '12:50:00', '02:20:00'),
('JT383', 'CGK', '2019-08-20', '18:15:00', 'KNO', '2019-08-20', '15:50:00', '02:25:00'),
('JT385', 'CGK', '2019-08-20', '20:10:00', 'KNO', '2019-08-20', '17:45:00', '02:25:00'),
('JT387', 'CGK', '2019-08-20', '16:15:00', 'KNO', '2019-08-20', '13:50:00', '02:25:00'),
('JT396', 'KNO', '2019-08-20', '19:45:00', 'CGK', '2019-08-20', '17:25:00', '02:20:00'),
('JT397', 'CGK', '2019-08-20', '10:15:00', 'KNO', '2019-08-20', '07:50:00', '02:25:00'),
('JT502', 'SRG', '2019-08-20', '16:35:00', 'CGK', '2019-08-20', '15:30:00', '01:05:00'),
('JT503', 'CGK', '2019-08-20', '18:20:00', 'SRG', '2019-08-20', '17:15:00', '01:05:00'),
('JT504', 'SRG', '2019-08-20', '09:05:00', 'CGK', '2019-08-20', '08:00:00', '01:05:00'),
('JT505', 'CGK', '2019-08-20', '10:50:00', 'SRG', '2019-08-20', '09:45:00', '01:05:00'),
('JT506', 'SRG', '2019-08-20', '12:25:00', 'CGK', '2019-08-20', '11:20:00', '01:05:00'),
('JT507', 'CGK', '2019-08-20', '14:10:00', 'SRG', '2019-08-20', '13:05:00', '01:05:00'),
('JT530', 'SOC', '2019-08-20', '20:45:00', 'CGK', '2019-08-20', '19:30:00', '01:15:00'),
('JT536', 'SOC', '2019-08-20', '09:05:00', 'CGK', '2019-08-20', '07:50:00', '01:15:00'),
('JT537', 'CGK', '2019-08-20', '11:00:00', 'SOC', '2019-08-20', '09:45:00', '01:10:00'),
('JT538', 'SOC', '2019-08-20', '17:00:00', 'CGK', '2019-08-20', '15:45:00', '01:15:00'),
('JT539', 'CGK', '2019-08-20', '18:55:00', 'SOC', '2019-08-20', '17:40:00', '01:10:00'),
('JT561', 'CGK', '2019-08-20', '09:00:00', 'SOC', '2019-08-20', '07:50:00', '01:10:00'),
('JT571', 'CGK', '2019-08-20', '08:15:00', 'SUB', '2019-08-20', '06:45:00', '01:30:00'),
('JT573', 'CGK', '2019-08-20', '10:35:00', 'SUB', '2019-08-20', '09:05:00', '01:30:00'),
('JT577', 'CGK', '2019-08-20', '15:20:00', 'SUB', '2019-08-20', '13:50:00', '01:30:00'),
('JT590', 'SUB', '2019-08-20', '22:15:00', 'CGK', '2019-08-20', '20:45:00', '01:30:00'),
('JT595', 'CGK', '2019-08-20', '23:00:00', 'SUB', '2019-08-20', '21:30:00', '01:30:00'),
('JT596', 'SUB', '2019-08-20', '17:40:00', 'CGK', '2019-08-20', '16:10:00', '01:30:00'),
('JT598', 'SUB', '2019-08-20', '15:50:00', 'CGK', '2019-08-20', '14:20:00', '01:30:00'),
('JT599', 'CGK', '2019-08-20', '18:00:00', 'SUB', '2019-08-20', '16:30:00', '01:30:00'),
('JT690', 'SUB', '2019-08-20', '06:30:00', 'CGK', '2019-08-20', '05:00:00', '01:30:00'),
('JT692', 'SUB', '2019-08-20', '10:40:00', 'CGK', '2019-08-20', '09:10:00', '01:30:00'),
('JT693', 'CGK', '2019-08-20', '18:20:00', 'SUB', '2019-08-20', '16:50:00', '01:30:00'),
('JT694', 'SUB', '2019-08-20', '12:50:00', 'CGK', '2019-08-20', '11:20:00', '01:30:00'),
('JT695', 'CGK', '2019-08-20', '15:20:00', 'SUB', '2019-08-20', '13:50:00', '01:30:00'),
('JT696', 'SUB', '2019-08-20', '18:20:00', 'CGK', '2019-08-20', '16:50:00', '01:30:00'),
('JT697', 'CGK', '2019-08-20', '20:45:00', 'SUB', '2019-08-20', '19:15:00', '01:30:00'),
('JT748', 'SUB', '2019-08-20', '06:30:00', 'CGK', '2019-08-20', '05:00:00', '01:30:00'),
('JT749', 'CGK', '2019-08-20', '16:05:00', 'SUB', '2019-08-20', '14:35:00', '01:30:00'),
('JT821', 'CGK', '2019-08-20', '22:30:00', 'SUB', '2019-08-20', '21:00:00', '01:30:00'),
('JT889', 'CGK', '2019-08-20', '21:40:00', 'SUB', '2019-08-20', '20:10:00', '01:30:00'),
('JT890', 'SUB', '2019-08-20', '06:00:00', 'CGK', '2019-08-20', '04:30:00', '01:30:00');

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
(219, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:01:40'),
(220, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:02:01'),
(221, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:02:16'),
(222, 'helpdesk', '141939', 'User', 'Menambahkan data user baru', 'Add', '2019-08-01 16:02:45'),
(223, 'helpdesk', '12345', 'User', 'Menambahkan data user baru', 'Add', '2019-08-01 16:03:10'),
(224, 'helpdesk', '101092', 'User', 'Menambahkan data user baru', 'Add', '2019-08-01 16:03:25'),
(225, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:03:38'),
(226, '141939', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:03:50'),
(227, '141939', '-', 'Auth', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-08-01 16:04:12'),
(228, '141939', 'POIN0004', 'Poin', 'Menghapus data poin', 'Delete', '2019-08-01 16:04:30'),
(229, '141939', 'POIN0002', 'Poin', 'Menghapus data poin', 'Delete', '2019-08-01 16:04:32'),
(230, '141939', 'POIN0001', 'Poin', 'Menghapus data poin', 'Delete', '2019-08-01 16:04:34'),
(231, '141939', 'POIN0003', 'Poin', 'Menghapus data poin', 'Delete', '2019-08-01 16:04:36'),
(232, '141939', 'UMS', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:41'),
(233, '141939', 'PDG', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:42'),
(234, '141939', 'CGK', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:45'),
(235, '141939', 'BGR', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:47'),
(236, '141939', 'AMD', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:49'),
(237, '141939', 'AMQ', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:51'),
(238, '141939', 'BDG', 'Rute', 'Menghapus data rute', 'Delete', '2019-08-01 16:04:53'),
(239, '141939', 'CGK', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:05:05'),
(240, '141939', 'BDO', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:05:17'),
(241, '141939', 'PDG', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:05:23'),
(242, '141939', 'PKU', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:05:33'),
(243, '141939', 'KNO', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:05:43'),
(244, '141939', 'KJT', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:06:00'),
(245, '141939', 'DPS', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:06:09'),
(246, '141939', 'SUB', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:06:24'),
(247, '141939', 'SOC', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:06:32'),
(248, '141939', 'SRG', 'Rute', 'Menambahkan data rute baru', 'Add', '2019-08-01 16:06:42'),
(249, '141939', 'POIN0001', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-08-01 16:07:08'),
(250, '141939', 'POIN0002', 'Poin', 'Menambahkan data poin baru', 'Add', '2019-08-01 16:07:32'),
(251, '141939', '00000000001', 'Aplikasi', 'Terima aplikasi pengajuan LPC', 'Terima', '2019-08-01 16:11:36'),
(252, '141939', '30491728056', 'Member', 'Mengupdate Member', 'Upgrade', '2019-08-01 16:12:24'),
(253, '141939', '30491728056', 'Member', 'Mengupdate Member', 'Downgrade', '2019-08-01 16:12:31'),
(254, '141939', '30491728056', 'Member', 'Mengupdate Member', 'Upgrade', '2019-08-01 16:12:37'),
(255, '141939', '30491728056', 'Member', 'Mengupdate Member', 'Downgrade', '2019-08-01 16:12:48'),
(256, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:17:35'),
(257, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:17:42'),
(258, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:17:58'),
(259, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:18:12'),
(260, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:18:20'),
(261, '12345', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:18:24'),
(262, '12345', 'CL-00000001', 'Claim', 'Memvalidasi data poin', 'Valid', '2019-08-01 16:22:05'),
(263, '12345', 'RD-00000001', 'Redeem', 'Memvalidasi data poin', 'Approval', '2019-08-01 16:28:11'),
(264, '12345', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:33:46'),
(265, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:33:57'),
(266, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:34:18'),
(267, '101092', '-', 'Auth', 'User login', 'Login', '2019-08-01 16:34:26'),
(268, '101092', '-', 'Auth', 'User logout', 'Logout', '2019-08-01 16:46:37'),
(269, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-05 14:17:56'),
(270, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 14:19:20'),
(271, '141939', '-', 'Auth', 'User login', 'Login', '2019-08-05 14:19:40'),
(272, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:00:58'),
(273, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-05 15:01:05'),
(274, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:01:26'),
(275, '12345', '-', 'Auth', 'User login', 'Login', '2019-08-05 15:01:30'),
(276, '12345', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:06:37'),
(277, '12345', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:06:46'),
(278, '141939', '-', 'Auth', 'User login', 'Login', '2019-08-05 15:44:04'),
(279, '141939', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:49:51'),
(280, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-05 15:50:10'),
(281, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:51:53'),
(282, '12345', '-', 'Auth', 'User login', 'Login', '2019-08-05 15:51:58'),
(283, '12345', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 15:56:29'),
(284, 'helpdesk', '-', 'Auth', 'User login', 'Login', '2019-08-05 17:19:09'),
(285, 'helpdesk', '-', 'Auth', 'User logout', 'Logout', '2019-08-05 17:19:20'),
(286, '12345', '-', 'Auth', 'User login', 'Login', '2019-08-05 17:19:24');

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
('POIN0001', 'CGK', 'SUB', 100, 10000),
('POIN0002', 'CGK', 'SRG', 200, 20000);

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
('BDO', 'Bandung'),
('CGK', 'Jakarta'),
('DPS', 'Denpasar'),
('KJT', 'Kertajati'),
('KNO', 'Medan'),
('PDG', 'Padang'),
('PKU', 'Pekanbaru'),
('SOC', 'Solo'),
('SRG', 'Semarang'),
('SUB', 'Surabaya');

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
('30491728056', '00000000001', 'haviz123', '2019-07-31 23:00:00', '2021-08-01 00:00:00', 'Blue', 'd569a7c6464d2cfce87b', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `redeem`
--

CREATE TABLE `redeem` (
  `id_redeem` varchar(11) NOT NULL,
  `no_member` varchar(11) NOT NULL,
  `tgl_redeem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_redeem` enum('Tolak','Proses','Approve','') NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `redeem`
--

INSERT INTO `redeem` (`id_redeem`, `no_member`, `tgl_redeem`, `status_redeem`, `keterangan`) VALUES
('RD-00000001', '30491728056', '2019-08-19 10:20:33', 'Proses', '');

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
(1, 'RD-00000001', 'POIN0001', 'JT002', 'Mr', 'Haviz Indra Maulana');

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
('101092', 'Haviz Indra Maulana', 'jtdzi', 'Manager', '2019-08-01 16:03:25', 'user.jpg', 'Aktif', 'b3be0c69387a1a9'),
('12345', 'Hesti Kurniawati', 'a450d', 'Customer Service', '2019-08-01 16:03:10', 'user.jpg', 'Aktif', '8cb2237d0679ca8'),
('141939', 'Muliani', '141939', 'Admin', '2019-08-01 16:02:45', 'user.jpg', 'Aktif', 'fd0db86d0525d0e'),
('helpdesk', 'Helpdesk', 'helpdesk', 'Helpdesk', '2019-08-01 15:59:34', 'user.jpg', 'Aktif', '875a8f2f42c570f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`kd_booking`);

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
-- Indeks untuk tabel `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`no_flight`),
  ADD KEY `arrival` (`arrival`),
  ADD KEY `departure` (`departure`);

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
  MODIFY `id_claim_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT untuk tabel `log_poin`
--
ALTER TABLE `log_poin`
  MODIFY `id_user_poin` int(11) NOT NULL AUTO_INCREMENT;

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
-- Ketidakleluasaan untuk tabel `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`arrival`) REFERENCES `master_rute` (`id_rute`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`departure`) REFERENCES `master_rute` (`id_rute`);

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
