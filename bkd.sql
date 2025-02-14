-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 14, 2025 at 02:44 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkd`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

DROP TABLE IF EXISTS `identitas`;
CREATE TABLE IF NOT EXISTS `identitas` (
  `kode` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `appname` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namains` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slogan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tahun` float DEFAULT NULL,
  `pimpinan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kdpos` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tlp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logo` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`kode`, `appname`, `namains`, `slogan`, `tahun`, `pimpinan`, `alamat`, `kdpos`, `tlp`, `website`, `email`, `logo`) VALUES
('22e0382e-8d8b-4ddb-b9be-2ada1396ad4f', ' SI-BKD', 'STTAL', 'DHARMA VIDYA ADHIGUNA', 1966, 'Laksamana Pertama TNI Dr. Andik Ismaryanto, S.T., M.M., CHRMP., CACA., CRMP.', 'Jl. Bumi Moro, Morokrembangan, Kec. Krembangan, Surabaya, Jawa Timur ', '60178', '031-99000581- 8', 'http://www.sttal.ac.id/', '', '1739420257_c506f03f7b3276ee4914.png');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `idjabatan` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_jabatan` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idjabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`idjabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
('96cf7ad7-644c-4e80-b964-0b712a31ac1e', 'DOSEN', '2025-02-14 08:48:22', '2025-02-14 08:48:22'),
('f093ffbe-41f5-42c7-a184-19226cd97a69', 'ADMINISTRATOR', '2024-12-27 20:57:39', '2024-12-27 20:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `korps`
--

DROP TABLE IF EXISTS `korps`;
CREATE TABLE IF NOT EXISTS `korps` (
  `idkorps` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_korps` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korps`
--

INSERT INTO `korps` (`idkorps`, `nama_korps`, `created_at`, `updated_at`) VALUES
('19c2af36-26f2-43bf-a206-f1edc603ce23', 'Laut (S)', '2024-12-27 13:54:06', '2024-12-27 13:54:06'),
('32675749-b658-4559-abdf-114440ebed4e', 'Laut (P)', '2024-12-27 13:53:38', '2024-12-27 13:53:38'),
('4dedc097-e0d5-48d2-b997-53faeb13c75c', 'Laut (T)', '2024-12-27 13:53:59', '2024-12-27 13:53:59'),
('5499fb13-2815-4d0a-9bdb-49610f855dbb', 'Laut (E)', '2024-12-27 13:54:04', '2024-12-27 13:54:04'),
('5c8da38b-1e92-4f3b-aad5-02276c4de86a', 'Laut (K)', '2024-12-27 13:57:05', '2024-12-27 23:18:25'),
('c31fb8e3-8933-4190-a089-109ad23ec795', 'Laut (PM)', '2024-12-27 13:54:12', '2024-12-27 14:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

DROP TABLE IF EXISTS `pangkat`;
CREATE TABLE IF NOT EXISTS `pangkat` (
  `idpangkat` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pangkat` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`idpangkat`, `nama_pangkat`, `created_at`, `updated_at`) VALUES
('0e4412d8-fe9b-4f07-9951-041538b8c23f', 'Kopka', '2024-12-27 21:16:13', '2024-12-27 21:18:35'),
('1735c692-85c3-44ba-b61d-b29f55e98802', 'Kls', '2024-12-27 21:16:34', '2024-12-27 21:16:34'),
('187e0502-6af0-4b4a-8a3d-7fdb6334331c', 'Klk', '2024-12-27 21:16:32', '2024-12-27 21:16:32'),
('3198e9ed-7acd-46f4-aa6e-2185c879c0e3', 'Jenderal TNI', '2024-12-27 21:14:20', '2024-12-27 21:14:20'),
('32c82bb5-0655-46b0-a810-e41457d2a53e', 'Lettu', '2024-12-27 21:15:24', '2024-12-27 21:15:24'),
('32de15a0-6507-460d-ad61-135bcc1793d3', 'Serka', '2024-12-27 21:15:56', '2024-12-27 21:15:56'),
('422019d6-5bd8-41c7-aa04-4066fd0e2030', 'Kld', '2024-12-27 21:16:42', '2024-12-27 21:16:42'),
('4793ffc3-ba37-43fe-b475-2a9eadd971c4', 'Mayjen TNI', '2024-12-27 21:14:37', '2024-12-27 21:14:37'),
('61926eca-1181-4704-ae2d-5b49e881c53b', 'Brigjen TNI', '2024-12-27 21:14:45', '2024-12-27 21:14:45'),
('678d6fb4-3d90-4c46-b301-a3bdf71be041', 'Koptu', '2024-12-27 21:16:20', '2024-12-27 21:16:20'),
('6ec42318-9e84-468b-b19b-e33a78d57ef9', 'Prada', '2024-12-27 21:17:03', '2024-12-27 21:17:03'),
('6f7685b5-3c30-41ad-aeda-14e03670fe54', 'Pratu', '2024-12-27 21:16:57', '2024-12-27 21:16:57'),
('751cc623-f0e9-4c46-92eb-e9003f00fad6', 'Serma', '2024-12-27 21:15:50', '2024-12-27 21:15:50'),
('752ac707-c6ff-41ce-a6e8-5a8b468ec763', 'Laksamana TNI', '2024-12-27 21:13:15', '2024-12-27 21:13:15'),
('854c9f71-9bd4-4edb-a647-5dd4d25f7b03', 'Letkol', '2024-12-27 21:15:01', '2024-12-27 21:15:01'),
('8856259c-4157-4e93-87e7-4c299236be39', 'Laksdya TNI', '2024-12-27 21:13:38', '2024-12-27 21:13:38'),
('a15ff0c3-153e-4d4c-91e4-959275da8c83', 'Pelda', '2024-12-27 21:15:42', '2024-12-27 21:15:42'),
('a2170297-5912-499b-bb00-e2bd760cbe3d', 'Kopda', '2024-12-27 21:16:26', '2024-12-27 21:16:26'),
('a2e7e0a1-120c-4c9d-b315-b5fa8bf824bb', 'Praka', '2024-12-27 21:16:50', '2024-12-27 21:16:50'),
('a632496b-80cb-4190-a611-1c9f130401ce', 'Kapten', '2024-12-27 21:15:16', '2024-12-27 21:15:16'),
('b2e6e136-6bca-4f37-95be-2a67851993ac', 'Laksda TNI', '2024-12-27 21:13:59', '2024-12-27 21:13:59'),
('d0eb0506-cead-4bd8-a101-90e752f3abb3', 'Serda', '2024-12-27 21:16:07', '2024-12-27 21:16:07'),
('d6eb5530-b3f1-4d81-a43a-ef3615e2dffe', 'Sertu', '2024-12-27 21:16:02', '2024-12-27 21:16:02'),
('d71dab4d-5ca5-4402-a959-8adac6849720', 'Kolonel', '2024-12-27 21:14:53', '2024-12-27 21:14:53'),
('d87dbaed-8972-4b6b-bc7d-6125aee6c9c9', 'Mayor', '2024-12-27 21:15:07', '2024-12-27 21:15:07'),
('e4152fa4-300e-4419-b219-6d9d3ba87e0e', 'Letjen TNI', '2024-12-27 21:14:29', '2024-12-27 21:14:29'),
('f0b55768-9c8e-49fd-9c2c-75b014935282', 'Letda', '2024-12-27 21:15:31', '2024-12-27 21:15:31'),
('f276c37a-8322-4270-ad1d-542ed445b45a', 'Peltu', '2024-12-27 21:15:39', '2024-12-27 21:15:39'),
('fd13ecc0-4db3-4da7-8cab-d3016b58966c', 'Laksma TNI', '2024-12-27 21:14:10', '2024-12-27 21:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `satker`
--

DROP TABLE IF EXISTS `satker`;
CREATE TABLE IF NOT EXISTS `satker` (
  `idsatker` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `namasatker` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idsatker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satker`
--

INSERT INTO `satker` (`idsatker`, `namasatker`, `created_at`, `updated_at`) VALUES
('23a0b274-6252-4d10-9387-349486727e97', 'STTAL', '2024-12-27 21:37:55', '2024-12-27 21:37:55'),
('47e28f2b-8189-4cb1-bb56-e3cac3e1a689', 'DISINFOLATA', '2024-12-28 12:35:41', '2024-12-28 12:35:41'),
('ce12ae0c-f711-4b09-8ee7-f508701ae982', 'SATBEK', '2024-12-28 09:34:02', '2024-12-28 09:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nrp` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjabatan` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idsatker` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpangkat` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idkorps` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idusers`),
  KEY `FK_users_jabatan` (`idjabatan`),
  KEY `FK_users_pangkat` (`idpangkat`),
  KEY `FK_users_satker` (`idsatker`),
  KEY `FK_users_korps` (`idkorps`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `email`, `pass`, `nrp`, `nama`, `foto`, `idjabatan`, `idsatker`, `idpangkat`, `idkorps`, `created_at`, `updated_at`) VALUES
('e7d62ef3-c395-4d7e-a70c-5e3d26868886', 'rampa', 'rampapraditya@gmail.com', 'aGtq', '111/P', 'Rampa Praditya', '', '96cf7ad7-644c-4e80-b964-0b712a31ac1e', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '32675749-b658-4559-abdf-114440ebed4e', '2025-02-14 09:34:20', '2025-02-14 09:44:00'),
('U00001', 'ADMIN', 'admin@gmail.com', 'aGtq', 'admin', 'Administrator', '1739432338_d8f676931205a36e774b.png', 'f093ffbe-41f5-42c7-a184-19226cd97a69', '23a0b274-6252-4d10-9387-349486727e97', 'a632496b-80cb-4190-a611-1c9f130401ce', '32675749-b658-4559-abdf-114440ebed4e', '2024-12-29 10:54:06', '2025-02-13 14:38:58');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_jabatan` FOREIGN KEY (`idjabatan`) REFERENCES `jabatan` (`idjabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_korps` FOREIGN KEY (`idkorps`) REFERENCES `korps` (`idkorps`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_pangkat` FOREIGN KEY (`idpangkat`) REFERENCES `pangkat` (`idpangkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_satker` FOREIGN KEY (`idsatker`) REFERENCES `satker` (`idsatker`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
