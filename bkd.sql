-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2025 at 03:20 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

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

-- --------------------------------------------------------

--
-- Table structure for table `anggota_profesi`
--

DROP TABLE IF EXISTS `anggota_profesi`;
CREATE TABLE IF NOT EXISTS `anggota_profesi` (
  `idang_profesi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_org` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `instansi_profesi` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idang_profesi`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahanajar`
--

DROP TABLE IF EXISTS `bahanajar`;
CREATE TABLE IF NOT EXISTS `bahanajar` (
  `idbahanajar` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_terbit` date NOT NULL,
  `penerbit` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `sk_penugasan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idbahanajar`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE IF NOT EXISTS `bimbingan` (
  `idbimbingan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `semester` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `ket_kegiatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_bimbingan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bimbingan` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `idjurusan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idbimbingan`),
  KEY `idusers` (`idusers`),
  KEY `idjurusan` (`idjurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan_dosen`
--

DROP TABLE IF EXISTS `bimbingan_dosen`;
CREATE TABLE IF NOT EXISTS `bimbingan_dosen` (
  `idbimbingan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pembimbing` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_bimbingan` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_bimbingan` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idbimbingan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `datasering`
--

DROP TABLE IF EXISTS `datasering`;
CREATE TABLE IF NOT EXISTS `datasering` (
  `iddatasering` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `pt_sasaran` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `bidang_tugas` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `metode` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_sk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`iddatasering`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diklat`
--

DROP TABLE IF EXISTS `diklat`;
CREATE TABLE IF NOT EXISTS `diklat` (
  `iddiklat` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `jenisdiklat` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `namadiklat` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `penyelengara` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tingkat` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jmljam` int NOT NULL,
  `no_sert` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sert` date NOT NULL,
  `tahun_selenggara` int NOT NULL,
  `tempat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `no_sk_penugasan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk_penugasan` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`iddiklat`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('67fe80e9-696a-44f4-a0d5-f2547b9fab5a', '20210874-b2d6-4f0a-bc0e-d92b6e404c8a', '2770e10c-132f-4feb-96f5-9c97295466ae', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', '2025-03-20 10:45:39', '2025-03-20 10:45:39');

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
('0f315fd4-6e66-49b4-bcab-532604f0371a', 'FAKULTAS EKONOMI DAN BISNIS', '2025-03-20 09:00:07', '2025-03-20 09:04:10'),
('20210874-b2d6-4f0a-bc0e-d92b6e404c8a', 'FAKULTAS TEKNIK', '2025-02-23 08:58:31', '2025-03-20 09:01:20'),
('9afdd3c8-dfb2-4fd5-b375-2a5d96d2aafc', 'FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN', '2025-03-20 10:05:36', '2025-03-20 10:05:36'),
('abdcaa5f-689c-4b1b-a5e3-aea909305475', 'FAKULTAS HIDRO OSEANOGRAFI', '2025-03-20 10:07:02', '2025-03-20 10:07:02'),
('fb5186de-ee29-406a-90c7-8e7b67bc5355', 'FAKULTAS MATEMATIKA DAN IPA', '2025-03-20 08:59:51', '2025-03-20 09:03:13');

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
('76f8bf75-f4f1-4aae-812e-b38672b653e9', 'PAMEN', '2025-03-20 09:15:16', '2025-03-20 09:15:16'),
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
('6e32c857-5fb7-4754-87ed-bd740c658e52', 'DOSEN', '2025-03-20 10:00:23', '2025-03-20 10:42:31'),
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
('5c8da38b-1e92-4f3b-aad5-02276c4de86a', 'Laut (KH)', '2024-12-27 13:57:05', '2025-03-20 09:22:11'),
('c31fb8e3-8933-4190-a089-109ad23ec795', 'Laut Marinir', '2024-12-27 13:54:12', '2025-03-20 09:22:50');

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

-- --------------------------------------------------------

--
-- Table structure for table `orasi_ilmiah`
--

DROP TABLE IF EXISTS `orasi_ilmiah`;
CREATE TABLE IF NOT EXISTS `orasi_ilmiah` (
  `idorasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_temu` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `penyelenggara` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_laksana` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idorasi`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('32c82bb5-0655-46b0-a810-e41457d2a53e', 'Lettu', '2024-12-27 21:15:24', '2024-12-27 21:15:24'),
('32de15a0-6507-460d-ad61-135bcc1793d3', 'Serka', '2024-12-27 21:15:56', '2024-12-27 21:15:56'),
('422019d6-5bd8-41c7-aa04-4066fd0e2030', 'Kld', '2024-12-27 21:16:42', '2024-12-27 21:16:42'),
('678d6fb4-3d90-4c46-b301-a3bdf71be041', 'Koptu', '2024-12-27 21:16:20', '2024-12-27 21:16:20'),
('6ec42318-9e84-468b-b19b-e33a78d57ef9', 'Prada', '2024-12-27 21:17:03', '2024-12-27 21:17:03'),
('6f7685b5-3c30-41ad-aeda-14e03670fe54', 'Pratu', '2024-12-27 21:16:57', '2024-12-27 21:16:57'),
('751cc623-f0e9-4c46-92eb-e9003f00fad6', 'Serma', '2024-12-27 21:15:50', '2024-12-27 21:15:50'),
('854c9f71-9bd4-4edb-a647-5dd4d25f7b03', 'Letkol', '2024-12-27 21:15:01', '2024-12-27 21:15:01'),
('a15ff0c3-153e-4d4c-91e4-959275da8c83', 'Pelda', '2024-12-27 21:15:42', '2024-12-27 21:15:42'),
('a2170297-5912-499b-bb00-e2bd760cbe3d', 'Kopda', '2024-12-27 21:16:26', '2024-12-27 21:16:26'),
('a2e7e0a1-120c-4c9d-b315-b5fa8bf824bb', 'Praka', '2024-12-27 21:16:50', '2024-12-27 21:16:50'),
('a632496b-80cb-4190-a611-1c9f130401ce', 'Kapten', '2024-12-27 21:15:16', '2024-12-27 21:15:16'),
('d0eb0506-cead-4bd8-a101-90e752f3abb3', 'Serda', '2024-12-27 21:16:07', '2024-12-27 21:16:07'),
('d6eb5530-b3f1-4d81-a43a-ef3615e2dffe', 'Sertu', '2024-12-27 21:16:02', '2024-12-27 21:16:02'),
('d71dab4d-5ca5-4402-a959-8adac6849720', 'Kolonel', '2024-12-27 21:14:53', '2024-12-27 21:14:53'),
('d87dbaed-8972-4b6b-bc7d-6125aee6c9c9', 'Mayor', '2024-12-27 21:15:07', '2024-12-27 21:15:07'),
('f0b55768-9c8e-49fd-9c2c-75b014935282', 'Letda', '2024-12-27 21:15:31', '2024-12-27 21:15:31'),
('f276c37a-8322-4270-ad1d-542ed445b45a', 'Peltu', '2024-12-27 21:15:39', '2024-12-27 21:15:39'),
('fd13ecc0-4db3-4da7-8cab-d3016b58966c', 'Laksma TNI', '2024-12-27 21:14:10', '2024-12-27 21:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `paten`
--

DROP TABLE IF EXISTS `paten`;
CREATE TABLE IF NOT EXISTS `paten` (
  `idpaten` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_capaian` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `aktivitas_litabmas` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_terbit` date NOT NULL,
  `tautan_ekternal` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpaten`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_dokumen`
--

DROP TABLE IF EXISTS `paten_dokumen`;
CREATE TABLE IF NOT EXISTS `paten_dokumen` (
  `idpaten_doc` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpaten` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_doc` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_doc` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpaten_doc`),
  KEY `idpaten` (`idpaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_dosen`
--

DROP TABLE IF EXISTS `paten_dosen`;
CREATE TABLE IF NOT EXISTS `paten_dosen` (
  `idpaten_dosen` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpaten` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpaten_dosen`),
  KEY `idpaten` (`idpaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_lain`
--

DROP TABLE IF EXISTS `paten_lain`;
CREATE TABLE IF NOT EXISTS `paten_lain` (
  `idpaten_lain` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpaten` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpaten_lain`),
  KEY `idpaten` (`idpaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_mahasiswa`
--

DROP TABLE IF EXISTS `paten_mahasiswa`;
CREATE TABLE IF NOT EXISTS `paten_mahasiswa` (
  `idpaten_mhs` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpaten` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpaten_mhs`),
  KEY `idpaten` (`idpaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembinaan`
--

DROP TABLE IF EXISTS `pembinaan`;
CREATE TABLE IF NOT EXISTS `pembinaan` (
  `idpembinaan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_ajar` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `semester` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `kegiatan` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_bimbingan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bimbingan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `idjurusan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpembinaan`),
  KEY `idusers` (`idusers`),
  KEY `idjurusan` (`idjurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_formal`
--

DROP TABLE IF EXISTS `pendidikan_formal`;
CREATE TABLE IF NOT EXISTS `pendidikan_formal` (
  `idpendformal` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `jenjang` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `pt` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `noinduk` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `program_studi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `gelar` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_masuk` int NOT NULL,
  `tgl_lulus` date NOT NULL,
  `ipk` float NOT NULL,
  `no_ijazah` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_tesis` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpendformal`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

DROP TABLE IF EXISTS `penelitian`;
CREATE TABLE IF NOT EXISTS `penelitian` (
  `idpenelitian` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `afiliasi` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `kelompok_bidang` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_sk` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `lama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_usulan` int NOT NULL,
  `tahun_kegiatan` int NOT NULL,
  `tahun_pelaksanaan` int NOT NULL,
  `tahun_ke` int NOT NULL,
  `dana_dikti` double NOT NULL,
  `dana_univ` double NOT NULL,
  `dana_ins_lain` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenelitian`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_dokumen`
--

DROP TABLE IF EXISTS `penelitian_dokumen`;
CREATE TABLE IF NOT EXISTS `penelitian_dokumen` (
  `idpenelitian_doc` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpenelitian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_dokumen` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenelitian_doc`),
  KEY `idpenelitian` (`idpenelitian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_dosen`
--

DROP TABLE IF EXISTS `penelitian_dosen`;
CREATE TABLE IF NOT EXISTS `penelitian_dosen` (
  `idpenelitian_dosen` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpenelitian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_dosen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenelitian_dosen`),
  KEY `idpenelitian` (`idpenelitian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_mahasiswa`
--

DROP TABLE IF EXISTS `penelitian_mahasiswa`;
CREATE TABLE IF NOT EXISTS `penelitian_mahasiswa` (
  `idpenelitian_mhs` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpenelitian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_mhs` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenelitian_mhs`),
  KEY `idpenelitian` (`idpenelitian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_non_civitas`
--

DROP TABLE IF EXISTS `penelitian_non_civitas`;
CREATE TABLE IF NOT EXISTS `penelitian_non_civitas` (
  `idpenelitian_non_civitas` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpenelitian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_non_civitas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenelitian_non_civitas`),
  KEY `idpenelitian` (`idpenelitian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `pengajaran`
--

DROP TABLE IF EXISTS `pengajaran`;
CREATE TABLE IF NOT EXISTS `pengajaran` (
  `idpengajaran` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `matkul` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `jenismatkul` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `jml_mhs` int NOT NULL,
  `sks` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajaran`
--

INSERT INTO `pengajaran` (`idpengajaran`, `idusers`, `matkul`, `jenismatkul`, `bidang`, `kelas`, `jml_mhs`, `sks`, `created_at`, `updated_at`) VALUES
('9fbab828-5832-4503-9109-d98606cb50fc', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'sistem informasi', 'analisan sistem informasi', 'Informatika', 'D3', 26, 3, '2025-03-20 10:49:37', '2025-03-20 10:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

DROP TABLE IF EXISTS `penghargaan`;
CREATE TABLE IF NOT EXISTS `penghargaan` (
  `idpenghargaan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `penghargaan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_penghargaan` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `instansi` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenghargaan`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengujian`
--

DROP TABLE IF EXISTS `pengujian`;
CREATE TABLE IF NOT EXISTS `pengujian` (
  `idpengujian` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `idjurusan` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpengujian`),
  KEY `idusers` (`idusers`),
  KEY `idjurusan` (`idjurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penunjang_lain`
--

DROP TABLE IF EXISTS `penunjang_lain`;
CREATE TABLE IF NOT EXISTS `penunjang_lain` (
  `idpenunjang` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_keg` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `instansi` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `no_sk` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `terhitung_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpenunjang`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

DROP TABLE IF EXISTS `publikasi`;
CREATE TABLE IF NOT EXISTS `publikasi` (
  `idpublikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_keg` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_capaian` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `aktivitas_litabmas` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_terbit` date NOT NULL,
  `jml_hal` int NOT NULL,
  `penerbit` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `ISBN` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `tautan_external` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpublikasi`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_dokumen`
--

DROP TABLE IF EXISTS `publikasi_dokumen`;
CREATE TABLE IF NOT EXISTS `publikasi_dokumen` (
  `idpublikasi_doc` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpublikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpublikasi_doc`),
  KEY `idpublikasi` (`idpublikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_dosen`
--

DROP TABLE IF EXISTS `publikasi_dosen`;
CREATE TABLE IF NOT EXISTS `publikasi_dosen` (
  `idpublikasi_dosen` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idpublikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpublikasi_dosen`),
  KEY `idpublikasi` (`idpublikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_lain`
--

DROP TABLE IF EXISTS `publikasi_lain`;
CREATE TABLE IF NOT EXISTS `publikasi_lain` (
  `idpublikasi_lain` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpublikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpublikasi_lain`),
  KEY `idpublikasi` (`idpublikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_mahasiswa`
--

DROP TABLE IF EXISTS `publikasi_mahasiswa`;
CREATE TABLE IF NOT EXISTS `publikasi_mahasiswa` (
  `idpublikasi_mhs` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpublikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int NOT NULL,
  `afiliasi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpublikasi_mhs`),
  KEY `idpublikasi` (`idpublikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kerja`
--

DROP TABLE IF EXISTS `riwayat_kerja`;
CREATE TABLE IF NOT EXISTS `riwayat_kerja` (
  `idriwayat_kerja` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang_usaha` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_pekerjaan` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `instansi` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `divisi` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `mulai_kerja` date NOT NULL,
  `selesai_kerja` date NOT NULL,
  `area` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idriwayat_kerja`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('02c700ea-94ad-4c1b-b477-b4ad0b8d17c6', 'Disinfolahtal ', '2025-03-20 09:35:10', '2025-03-20 09:35:10'),
('23a0b274-6252-4d10-9387-349486727e97', 'STTAL', '2024-12-27 21:37:55', '2024-12-27 21:37:55'),
('47e28f2b-8189-4cb1-bb56-e3cac3e1a689', 'Disinfolahta Koarmada II', '2024-12-28 12:35:41', '2025-03-20 09:34:30'),
('5a20cb8b-bc59-4d88-bdd8-a862bd36b5cd', 'AAL', '2025-03-20 11:18:51', '2025-03-20 11:18:51'),
('6705d033-7f90-4c00-9790-94c7d92ed224', 'Disharkap Koarmada II', '2025-03-20 09:36:03', '2025-03-20 09:36:03'),
('6b49d143-2129-4472-8fdc-5d204f189395', 'Pusdikbanmin', '2025-03-20 09:34:01', '2025-03-20 09:34:01'),
('7e183b06-2562-46c5-9b30-75c1bb0de1fb', 'Pusdikopsla', '2025-03-20 09:39:05', '2025-03-20 09:39:05'),
('9b5f79d7-31ca-4b2e-bfe7-05ee06b98fe0', 'Arsenal', '2025-03-20 09:37:50', '2025-03-20 09:37:50'),
('ce12ae0c-f711-4b09-8ee7-f508701ae982', 'Pushidrosal', '2024-12-28 09:34:02', '2025-03-20 09:33:37'),
('dd6924df-01c9-4612-9e46-0a13c6793239', 'Puslatlekdalsen', '2025-03-20 09:35:38', '2025-03-20 09:35:38'),
('e4b677f9-3cab-4390-850c-bbb664655a2e', 'Kolat Koarmada II', '2025-03-20 09:39:18', '2025-03-20 09:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi`
--

DROP TABLE IF EXISTS `sertifikasi`;
CREATE TABLE IF NOT EXISTS `sertifikasi` (
  `idsertifikasi` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_sk` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL,
  `nomor_peserta` int NOT NULL,
  `nomor_regis` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idsertifikasi`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

DROP TABLE IF EXISTS `tes`;
CREATE TABLE IF NOT EXISTS `tes` (
  `idtes` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_tes` text COLLATE utf8mb4_general_ci NOT NULL,
  `nama_tes` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `penyelenggara` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_tes` date NOT NULL,
  `tahun` int NOT NULL,
  `skor` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idtes`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_tambahan`
--

DROP TABLE IF EXISTS `tugas_tambahan`;
CREATE TABLE IF NOT EXISTS `tugas_tambahan` (
  `idtugas` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `tugas` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(56) COLLATE utf8mb4_general_ci NOT NULL,
  `instansi` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idtugas`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0b589209-958f-472b-ad71-9a7793b441b8', 'rampa', 'rampa@gmail.com', 'aGtq', '111/P', 'Rampa Praditya', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '32675749-b658-4559-abdf-114440ebed4e', '2025-04-01 12:23:01', '2025-04-01 12:23:01'),
('d53e6d1e-36f8-4854-a597-4fd2afc812ac', 'zainalsyahlan', 'zainalsyahlan@gmail.com', 'aGtq', '17813/P', 'Zainal Syahlan, S.T., M.Kom., M.Tr.Opsla', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5c8da38b-1e92-4f3b-aad5-02276c4de86a', '2025-03-20 10:29:34', '2025-03-20 11:22:17'),
('eb3012cf-2eb9-4a2a-a3b1-5e98018b9796', 'arifsudaryoko', 'arifsudaryoko@gmail.com', 'aGtq', '16284/P', 'Arif Sudaryoko.S.pd', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '6b49d143-2129-4472-8fdc-5d204f189395', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5c8da38b-1e92-4f3b-aad5-02276c4de86a', '2025-03-20 11:25:17', '2025-03-20 11:25:17'),
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

-- --------------------------------------------------------

--
-- Table structure for table `visiting`
--

DROP TABLE IF EXISTS `visiting`;
CREATE TABLE IF NOT EXISTS `visiting` (
  `idvisiting` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `idusers` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `pt_pengundang` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `lama_kegiatan` int NOT NULL,
  `kategori_kegiatan` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `kegiatan_penting` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `sk_penugasan` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idvisiting`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_kontak`
--
ALTER TABLE `alamat_kontak`
  ADD CONSTRAINT `alamat_kontak_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota_profesi`
--
ALTER TABLE `anggota_profesi`
  ADD CONSTRAINT `anggota_profesi_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahanajar`
--
ALTER TABLE `bahanajar`
  ADD CONSTRAINT `bahanajar_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD CONSTRAINT `bimbingan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bimbingan_ibfk_2` FOREIGN KEY (`idjurusan`) REFERENCES `jurusan` (`idjurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bimbingan_dosen`
--
ALTER TABLE `bimbingan_dosen`
  ADD CONSTRAINT `bimbingan_dosen_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `datasering`
--
ALTER TABLE `datasering`
  ADD CONSTRAINT `datasering_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diklat`
--
ALTER TABLE `diklat`
  ADD CONSTRAINT `diklat_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `orasi_ilmiah`
--
ALTER TABLE `orasi_ilmiah`
  ADD CONSTRAINT `orasi_ilmiah_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paten`
--
ALTER TABLE `paten`
  ADD CONSTRAINT `paten_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paten_dokumen`
--
ALTER TABLE `paten_dokumen`
  ADD CONSTRAINT `paten_dokumen_ibfk_1` FOREIGN KEY (`idpaten`) REFERENCES `paten` (`idpaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paten_dosen`
--
ALTER TABLE `paten_dosen`
  ADD CONSTRAINT `paten_dosen_ibfk_1` FOREIGN KEY (`idpaten`) REFERENCES `paten` (`idpaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paten_lain`
--
ALTER TABLE `paten_lain`
  ADD CONSTRAINT `paten_lain_ibfk_1` FOREIGN KEY (`idpaten`) REFERENCES `paten` (`idpaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paten_mahasiswa`
--
ALTER TABLE `paten_mahasiswa`
  ADD CONSTRAINT `paten_mahasiswa_ibfk_1` FOREIGN KEY (`idpaten`) REFERENCES `paten` (`idpaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembinaan`
--
ALTER TABLE `pembinaan`
  ADD CONSTRAINT `pembinaan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembinaan_ibfk_2` FOREIGN KEY (`idjurusan`) REFERENCES `jurusan` (`idjurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendidikan_formal`
--
ALTER TABLE `pendidikan_formal`
  ADD CONSTRAINT `pendidikan_formal_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian_dokumen`
--
ALTER TABLE `penelitian_dokumen`
  ADD CONSTRAINT `penelitian_dokumen_ibfk_1` FOREIGN KEY (`idpenelitian`) REFERENCES `penelitian` (`idpenelitian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian_dosen`
--
ALTER TABLE `penelitian_dosen`
  ADD CONSTRAINT `penelitian_dosen_ibfk_1` FOREIGN KEY (`idpenelitian`) REFERENCES `penelitian` (`idpenelitian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian_mahasiswa`
--
ALTER TABLE `penelitian_mahasiswa`
  ADD CONSTRAINT `penelitian_mahasiswa_ibfk_1` FOREIGN KEY (`idpenelitian`) REFERENCES `penelitian` (`idpenelitian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penelitian_non_civitas`
--
ALTER TABLE `penelitian_non_civitas`
  ADD CONSTRAINT `penelitian_non_civitas_ibfk_1` FOREIGN KEY (`idpenelitian`) REFERENCES `penelitian` (`idpenelitian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD CONSTRAINT `penempatan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajaran`
--
ALTER TABLE `pengajaran`
  ADD CONSTRAINT `pengajaran_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD CONSTRAINT `penghargaan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengujian`
--
ALTER TABLE `pengujian`
  ADD CONSTRAINT `pengujian_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengujian_ibfk_2` FOREIGN KEY (`idjurusan`) REFERENCES `jurusan` (`idjurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penunjang_lain`
--
ALTER TABLE `penunjang_lain`
  ADD CONSTRAINT `penunjang_lain_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi`
--
ALTER TABLE `publikasi`
  ADD CONSTRAINT `publikasi_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi_dokumen`
--
ALTER TABLE `publikasi_dokumen`
  ADD CONSTRAINT `publikasi_dokumen_ibfk_1` FOREIGN KEY (`idpublikasi`) REFERENCES `publikasi` (`idpublikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi_dosen`
--
ALTER TABLE `publikasi_dosen`
  ADD CONSTRAINT `publikasi_dosen_ibfk_1` FOREIGN KEY (`idpublikasi`) REFERENCES `publikasi` (`idpublikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi_lain`
--
ALTER TABLE `publikasi_lain`
  ADD CONSTRAINT `publikasi_lain_ibfk_1` FOREIGN KEY (`idpublikasi`) REFERENCES `publikasi` (`idpublikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi_mahasiswa`
--
ALTER TABLE `publikasi_mahasiswa`
  ADD CONSTRAINT `publikasi_mahasiswa_ibfk_1` FOREIGN KEY (`idpublikasi`) REFERENCES `publikasi` (`idpublikasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_kerja`
--
ALTER TABLE `riwayat_kerja`
  ADD CONSTRAINT `riwayat_kerja_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  ADD CONSTRAINT `sertifikasi_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes`
--
ALTER TABLE `tes`
  ADD CONSTRAINT `tes_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas_tambahan`
--
ALTER TABLE `tugas_tambahan`
  ADD CONSTRAINT `tugas_tambahan_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `visiting`
--
ALTER TABLE `visiting`
  ADD CONSTRAINT `visiting_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
