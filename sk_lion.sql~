-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 07:50 PM
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
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` bigint(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `user`, `keterangan`, `kategori`, `tgl_log`) VALUES
(1, 'helpdesk', 'User login', 'Login', '2019-03-28 20:59:12'),
(2, 'helpdesk', 'User logout', 'Logout', '2019-03-28 21:09:11'),
(3, 'helpdesk', 'User login', 'Login', '2019-03-28 21:10:03'),
(4, 'helpdesk', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-03-28 21:11:45'),
(5, 'helpdesk', 'User login', 'Login', '2019-03-28 21:12:14'),
(6, 'helpdesk', 'Mengganti password lama menjadi password baru', 'Ganti Password', '2019-03-28 21:12:43'),
(7, '7201160106', 'User login', 'Login', '2019-03-29 08:04:25'),
(9, '7201160106', 'User login', 'Login', '2019-03-29 08:06:34'),
(11, 'helpdesk', 'User logout', 'Logout', '2019-03-29 08:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` varchar(20) NOT NULL,
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

INSERT INTO `user` (`nip`, `nama_user`, `password`, `level`, `tgl_registrasi`, `foto`, `status`, `token`) VALUES
('7201160106', 'Kalyssa Innara Putri', 'o5j4h', 'Manager', '2019-03-29 08:02:57', 'user.jpg', 'Aktif', 'df8f450cc77361b'),
('helpdesk', 'Helpdesk', 'h3lpd35k', 'Helpdesk', '2019-03-28 19:05:02', 'user.jpg', 'Aktif', '875a8f2f42c570f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
