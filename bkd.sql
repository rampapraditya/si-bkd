-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2025 at 04:09 AM
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
-- Table structure for table `alamat_kontak`
--

DROP TABLE IF EXISTS `alamat_kontak`;
CREATE TABLE IF NOT EXISTS `alamat_kontak` (
  `idalamat` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `rt` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `rw` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `kelurahan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `kecamatan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `kota` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `provinsi` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `kdpos` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tlp_rumah` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tlp_ponsel` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idalamat`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alamat_kontak`
--

INSERT INTO `alamat_kontak` (`idalamat`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `kdpos`, `tlp_rumah`, `tlp_ponsel`, `created_at`, `updated_at`, `idusers`) VALUES
('caf39c3c-ed73-45f0-aac4-286caef067eb', 'Gunung Anyar Tambak Barat 1 No 16', '01', '05', 'Gunung Anyar', 'Gunung Anyar', 'Surabaya', 'Jawa TImur', '60588', '-', '085731803889', '2025-02-23 20:35:03', '2025-02-23 20:36:52', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_jurusan`
--

DROP TABLE IF EXISTS `dosen_jurusan`;
CREATE TABLE IF NOT EXISTS `dosen_jurusan` (
  `idjurusandosen` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idfakultas` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idjurusan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idjurusandosen`),
  KEY `idfakultas` (`idfakultas`),
  KEY `idjurusan` (`idjurusan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen_jurusan`
--

INSERT INTO `dosen_jurusan` (`idjurusandosen`, `idfakultas`, `idjurusan`, `idusers`, `created_at`, `updated_at`) VALUES
('b9b9f3fb-1338-4e54-a382-ae97abde7572', '20210874-b2d6-4f0a-bc0e-d92b6e404c8a', '2770e10c-132f-4feb-96f5-9c97295466ae', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886', '2025-02-23 11:07:52', '2025-02-23 11:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE IF NOT EXISTS `fakultas` (
  `idfakultas` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `namafakultas` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idfakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`idfakultas`, `namafakultas`, `created_at`, `updated_at`) VALUES
('20210874-b2d6-4f0a-bc0e-d92b6e404c8a', 'TEKNOLOGI DAN INFORMATIKA', '2025-02-23 08:58:31', '2025-02-23 08:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

DROP TABLE IF EXISTS `golongan`;
CREATE TABLE IF NOT EXISTS `golongan` (
  `idgolongan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_golongan` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idgolongan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`idgolongan`, `nama_golongan`, `created_at`, `updated_at`) VALUES
('100613a7-44d8-4373-9205-f29d32720b28', 'III/d (Penata Tk. I)', '2025-02-23 16:15:19', '2025-02-23 16:15:19'),
('40962882-5154-4781-965b-843bb8a16000', 'III/b (Penata Muda Tk. I)', '2025-02-23 16:15:08', '2025-02-23 16:15:08'),
('4249f0f5-f09b-4907-946e-e6568cd2be28', 'IV/b (Pembina Tk. I)', '2025-02-23 16:15:31', '2025-02-23 16:15:31'),
('721196c9-524b-4e48-b260-816837d3c0c6', 'IV/d (Pembina Utama Madya)', '2025-02-23 16:15:44', '2025-02-23 16:15:44'),
('72bcf136-6d0a-4c48-bf29-959029f46918', 'IV/e (Pembina Utama)', '2025-02-23 16:15:50', '2025-02-23 16:15:50'),
('87c51a54-e58e-46db-a1f8-a363880ff1d0', 'IV/a (Pembina)', '2025-02-23 16:15:25', '2025-02-23 16:15:25'),
('8b27b22d-fc7c-46bd-9e34-d37a28fe6d51', 'II/b (Pengatur Muda Tk. I)', '2025-02-23 16:13:27', '2025-02-23 16:14:32'),
('8e7eabba-064c-4316-bf1d-7f0b1aa1fbdb', 'III/c (Penata)', '2025-02-23 16:15:13', '2025-02-23 16:15:13'),
('d315d58f-708e-424d-8cd6-de64af162467', 'II/c (Pengatur)', '2025-02-23 16:14:45', '2025-02-23 16:14:45'),
('e8d23216-22a9-49f1-9e7d-61c913c4d7f0', 'II/d (Pengatur Tk. I)', '2025-02-23 16:14:56', '2025-02-23 16:14:56'),
('e9bb8ee6-bb3f-4da4-97e9-fae98897d7f7', 'III/a (Penata Muda)', '2025-02-23 16:15:01', '2025-02-23 16:15:01'),
('f4007f5a-e1c1-418a-9922-429c709e319f', 'IV/c (Pembina Utama Muda)', '2025-02-23 16:15:37', '2025-02-23 16:15:37');

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
-- Table structure for table `inpassing`
--

DROP TABLE IF EXISTS `inpassing`;
CREATE TABLE IF NOT EXISTS `inpassing` (
  `id_inpassing` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idgolongan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_sk` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `mulai_tgl` date NOT NULL,
  `angka_kredit` int NOT NULL,
  `masa_kerja_tahun` int NOT NULL,
  `masa_kerja_bulan` int NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_inpassing`),
  KEY `idusers` (`idusers`),
  KEY `idgolongan` (`idgolongan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inpassing`
--

INSERT INTO `inpassing` (`id_inpassing`, `idgolongan`, `nomor_sk`, `tgl_sk`, `mulai_tgl`, `angka_kredit`, `masa_kerja_tahun`, `masa_kerja_bulan`, `bukti`, `created_at`, `updated_at`, `idusers`) VALUES
('e989d56c-4fa5-445a-806a-4f2f334acf52', '40962882-5154-4781-965b-843bb8a16000', 'SKINPAS01', '2025-02-24', '2025-02-24', 100, 7, 90, '', '2025-02-24 08:57:13', '2025-02-24 08:59:56', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886');

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
-- Table structure for table `jabatan_fungsional`
--

DROP TABLE IF EXISTS `jabatan_fungsional`;
CREATE TABLE IF NOT EXISTS `jabatan_fungsional` (
  `id_jab_fungsi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_jab_fungsi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_jab_fungsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan_fungsional`
--

INSERT INTO `jabatan_fungsional` (`id_jab_fungsi`, `nama_jab_fungsi`, `nilai`, `created_at`, `updated_at`) VALUES
('3d7b29a3-a710-48b2-b03e-5df165856d8c', 'Lektor Kepala', 700, '2025-02-23 16:07:49', '2025-02-23 16:07:49'),
('444fa574-bc6a-45ed-ad47-f96da8b2da2a', 'Profesor', 1050, '2025-02-23 16:08:05', '2025-02-23 16:09:28'),
('6bb37e5e-8038-4066-8e71-f1eae0ef4785', 'Asisten Ahli', 100, '2025-02-23 14:34:24', '2025-02-23 14:34:24'),
('84204b29-f898-4746-bcf8-7364f3e5fd9d', 'Lektor', 200, '2025-02-23 16:07:22', '2025-02-23 16:07:22'),
('9b99b48e-2eaf-45da-9d16-453f799bcd66', 'Asisten Ahli', 150, '2025-02-23 14:35:08', '2025-02-23 14:35:08'),
('b20c3bb8-bab7-4674-a63e-e4cb36cabbd7', 'Lektor Kepala', 400, '2025-02-23 16:07:37', '2025-02-23 16:07:37'),
('e3b9553e-65d9-45d0-a709-b70a98979f85', 'Lektor Kepala', 550, '2025-02-23 16:07:43', '2025-02-23 16:07:43'),
('e3da2238-223d-43e5-b80b-2e08a80db2b1', 'Profesor', 850, '2025-02-23 16:07:58', '2025-02-23 16:07:58'),
('eca44943-158a-4c64-b739-1b8b73e1e8f8', 'Lektor', 300, '2025-02-23 16:07:26', '2025-02-23 16:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_fungsional_dosen`
--

DROP TABLE IF EXISTS `jabatan_fungsional_dosen`;
CREATE TABLE IF NOT EXISTS `jabatan_fungsional_dosen` (
  `idjab_fungsi_dosen` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `id_jab_fungsi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_sk` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `mulai` date NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idjab_fungsi_dosen`),
  KEY `id_jab_fungsi` (`id_jab_fungsi`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan_fungsional_dosen`
--

INSERT INTO `jabatan_fungsional_dosen` (`idjab_fungsi_dosen`, `id_jab_fungsi`, `nomor_sk`, `mulai`, `bukti`, `idusers`, `created_at`, `updated_at`) VALUES
('010436ba-6be3-4a36-b042-de8ddf4fc34d', '84204b29-f898-4746-bcf8-7364f3e5fd9d', 'SKFUNGSI01', '2025-01-02', '', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886', '2025-02-24 10:18:29', '2025-02-24 10:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

DROP TABLE IF EXISTS `jenis_dokumen`;
CREATE TABLE IF NOT EXISTS `jenis_dokumen` (
  `idjenis_dok` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_jenis_dok` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idjenis_dok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE IF NOT EXISTS `jurusan` (
  `idjurusan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `namajurusan` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `idfakultas` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idjurusan`),
  KEY `idfakultas` (`idfakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`idjurusan`, `namajurusan`, `idfakultas`, `created_at`, `updated_at`) VALUES
('2770e10c-132f-4feb-96f5-9c97295466ae', 'D3 Informatika', '20210874-b2d6-4f0a-bc0e-d92b6e404c8a', '2025-02-23 09:17:28', '2025-02-23 09:17:40'),
('dc7db166-d136-432c-a0f7-dfd55323e46e', 'D3 Teknik Mesin', '20210874-b2d6-4f0a-bc0e-d92b6e404c8a', '2025-02-23 09:17:15', '2025-02-23 09:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

DROP TABLE IF EXISTS `keluarga`;
CREATE TABLE IF NOT EXISTS `keluarga` (
  `idkeluarga` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `status_kawin` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_suami_istri` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `nip_suami_istri` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `pekerjaan_suami_istri` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idkeluarga`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`idkeluarga`, `status_kawin`, `nama_suami_istri`, `nip_suami_istri`, `pekerjaan_suami_istri`, `created_at`, `updated_at`, `idusers`) VALUES
('ddc8a420-9ce9-4d73-9b52-8b0a1b70e626', 'Belum kawin', '-', '-', '-', '2025-02-23 18:15:59', '2025-02-23 18:16:24', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886');

-- --------------------------------------------------------

--
-- Table structure for table `kepangkatan`
--

DROP TABLE IF EXISTS `kepangkatan`;
CREATE TABLE IF NOT EXISTS `kepangkatan` (
  `idkepangkatan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idgolongan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_sk` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `mulai_tgl` date NOT NULL,
  `masa_kerja_gol_tahun` int NOT NULL,
  `masa_kerja_gol_bulan` int NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idkepangkatan`),
  KEY `idgolongan` (`idgolongan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kepegawaian`
--

DROP TABLE IF EXISTS `kepegawaian`;
CREATE TABLE IF NOT EXISTS `kepegawaian` (
  `idkepegawaian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_sk` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `tmmd` date NOT NULL,
  `sumber_gaji` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `status_aktif` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `program_studi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idkepegawaian`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepegawaian`
--

INSERT INTO `kepegawaian` (`idkepegawaian`, `nomor_sk`, `tmmd`, `sumber_gaji`, `status_aktif`, `program_studi`, `created_at`, `updated_at`, `idusers`) VALUES
('16039f05-e75f-47f2-ba1c-5584a3adf3d2', 'SK0101', '2023-01-31', 'APBN', 'Aktif', 'Sistem Informasi', '2025-02-23 21:09:18', '2025-02-23 21:10:00', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886');

-- --------------------------------------------------------

--
-- Table structure for table `kependudukan`
--

DROP TABLE IF EXISTS `kependudukan`;
CREATE TABLE IF NOT EXISTS `kependudukan` (
  `idkependudukan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `agama` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `warganegara` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idkependudukan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kependudukan`
--

INSERT INTO `kependudukan` (`idkependudukan`, `nik`, `agama`, `warganegara`, `idusers`, `created_at`, `updated_at`) VALUES
('9c14da02-c94c-433e-a739-d880598f8c5c', '121212', 'Islam', 'Indonesia', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886', '2025-02-23 17:39:55', '2025-02-23 17:39:55');

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
-- Table structure for table `lain_lain`
--

DROP TABLE IF EXISTS `lain_lain`;
CREATE TABLE IF NOT EXISTS `lain_lain` (
  `idlain` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `npwp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_npwp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sinta_id` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idlain`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lain_lain`
--

INSERT INTO `lain_lain` (`idlain`, `npwp`, `nama_npwp`, `sinta_id`, `created_at`, `updated_at`, `idusers`) VALUES
('d0ba6b68-988d-4d5c-9bc6-dae9470aac26', 'NPWP0101', 'Rampa Praditya', '01010101', '2025-02-23 21:31:49', '2025-02-23 21:32:34', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886');

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
-- Table structure for table `penempatan`
--

DROP TABLE IF EXISTS `penempatan`;
CREATE TABLE IF NOT EXISTS `penempatan` (
  `idpenempatan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `ikatan_kerja` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `jenjang` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `pt` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `mulai` date NOT NULL,
  `keluar` date NOT NULL,
  `selesai` date NOT NULL,
  `home_base` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenempatan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`idpenempatan`, `idusers`, `status`, `ikatan_kerja`, `jenjang`, `unit`, `pt`, `mulai`, `keluar`, `selesai`, `home_base`, `created_at`, `updated_at`) VALUES
('311dec6b-2bf9-40e4-9acf-18a0fae4e5cb', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886', 'NON PNS', 'Dosen Tetap', 'S1', 'Sistem Informasi', 'Universitas Dinamika', '2025-02-25', '0000-00-00', '0000-00-00', 'Ya', '2025-02-25 11:02:47', '2025-02-25 11:09:29');

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
('e7d62ef3-c395-4d7e-a70c-5e3d26868886', 'rampa', 'rampapraditya@gmail.com', 'aGtq', '111/P', 'Rampa Praditya', '1740357451_4f6b2f460903b053ef06.png', '96cf7ad7-644c-4e80-b964-0b712a31ac1e', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '32675749-b658-4559-abdf-114440ebed4e', '2025-02-14 09:34:20', '2025-02-24 07:37:31'),
('U00001', 'ADMIN', 'admin@gmail.com', 'aGtq', 'admin', 'Administrator', '1739432338_d8f676931205a36e774b.png', 'f093ffbe-41f5-42c7-a184-19226cd97a69', '23a0b274-6252-4d10-9387-349486727e97', 'a632496b-80cb-4190-a611-1c9f130401ce', '32675749-b658-4559-abdf-114440ebed4e', '2024-12-29 10:54:06', '2025-02-13 14:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `users_detil`
--

DROP TABLE IF EXISTS `users_detil`;
CREATE TABLE IF NOT EXISTS `users_detil` (
  `idusers_detil` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nidn` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `jkel` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tmp_lahir` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idusers_detil`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_detil`
--

INSERT INTO `users_detil` (`idusers_detil`, `nidn`, `jkel`, `tmp_lahir`, `tgl_lahir`, `idusers`, `created_at`, `updated_at`) VALUES
('d0e15e92-7d2a-4dbf-973e-c06953325aed', '111222', 'Laki-laki', 'Surabaya', '1993-08-02', 'e7d62ef3-c395-4d7e-a70c-5e3d26868886', '2025-02-23 16:37:59', '2025-02-24 07:37:31');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_kontak`
--
ALTER TABLE `alamat_kontak`
  ADD CONSTRAINT `alamat_kontak_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen_jurusan`
--
ALTER TABLE `dosen_jurusan`
  ADD CONSTRAINT `dosen_jurusan_ibfk_1` FOREIGN KEY (`idfakultas`) REFERENCES `fakultas` (`idfakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_jurusan_ibfk_2` FOREIGN KEY (`idjurusan`) REFERENCES `jurusan` (`idjurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_jurusan_ibfk_3` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inpassing`
--
ALTER TABLE `inpassing`
  ADD CONSTRAINT `inpassing_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inpassing_ibfk_2` FOREIGN KEY (`idgolongan`) REFERENCES `golongan` (`idgolongan`) ON DELETE CASCADE;

--
-- Constraints for table `jabatan_fungsional_dosen`
--
ALTER TABLE `jabatan_fungsional_dosen`
  ADD CONSTRAINT `jabatan_fungsional_dosen_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jabatan_fungsional_dosen_ibfk_2` FOREIGN KEY (`id_jab_fungsi`) REFERENCES `jabatan_fungsional` (`id_jab_fungsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`idfakultas`) REFERENCES `fakultas` (`idfakultas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kepangkatan`
--
ALTER TABLE `kepangkatan`
  ADD CONSTRAINT `kepangkatan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kepangkatan_ibfk_2` FOREIGN KEY (`idgolongan`) REFERENCES `golongan` (`idgolongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kepegawaian`
--
ALTER TABLE `kepegawaian`
  ADD CONSTRAINT `kepegawaian_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kependudukan`
--
ALTER TABLE `kependudukan`
  ADD CONSTRAINT `kependudukan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lain_lain`
--
ALTER TABLE `lain_lain`
  ADD CONSTRAINT `lain_lain_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD CONSTRAINT `penempatan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_jabatan` FOREIGN KEY (`idjabatan`) REFERENCES `jabatan` (`idjabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_korps` FOREIGN KEY (`idkorps`) REFERENCES `korps` (`idkorps`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_pangkat` FOREIGN KEY (`idpangkat`) REFERENCES `pangkat` (`idpangkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_satker` FOREIGN KEY (`idsatker`) REFERENCES `satker` (`idsatker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_detil`
--
ALTER TABLE `users_detil`
  ADD CONSTRAINT `users_detil_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
