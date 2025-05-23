-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2025 at 07:35 PM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sttalin1_bkd`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_kontak`
--

CREATE TABLE `alamat_kontak` (
  `idalamat` varchar(36) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `kelurahan` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `provinsi` varchar(25) NOT NULL,
  `kdpos` varchar(15) NOT NULL,
  `tlp_rumah` varchar(15) NOT NULL,
  `tlp_ponsel` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_profesi`
--

CREATE TABLE `anggota_profesi` (
  `idang_profesi` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `nama_org` varchar(65) NOT NULL,
  `peran` varchar(65) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `instansi_profesi` varchar(65) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahanajar`
--

CREATE TABLE `bahanajar` (
  `idbahanajar` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `penerbit` varchar(70) NOT NULL,
  `sk_penugasan` varchar(100) NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `idbimbingan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `semester` varchar(45) NOT NULL,
  `ket_kegiatan` varchar(100) NOT NULL,
  `judul_bimbingan` varchar(150) NOT NULL,
  `bidang` varchar(56) NOT NULL,
  `jenis_bimbingan` varchar(45) NOT NULL,
  `idjurusan` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`idbimbingan`, `idusers`, `semester`, `ket_kegiatan`, `judul_bimbingan`, `bidang`, `jenis_bimbingan`, `idjurusan`, `created_at`, `updated_at`) VALUES
('0d0e9767-e8d8-4a6d-b2a6-8430402e0ed5', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Ganjil 2024/2025', 'Bimbingan Tugas Akhir', 'Rancang Bangun Sistem Informasi Beban Kerja Dosen STTAL Berbasis website', 'Rekayasa Perangkat Lunak', 'Tugas Akhir', '2770e10c-132f-4feb-96f5-9c97295466ae', '2025-03-20 13:16:49', '2025-03-20 13:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan_dosen`
--

CREATE TABLE `bimbingan_dosen` (
  `idbimbingan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `nama_pembimbing` varchar(56) NOT NULL,
  `nama_bimbingan` varchar(56) NOT NULL,
  `tgl_bimbingan` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan_dosen`
--

INSERT INTO `bimbingan_dosen` (`idbimbingan`, `idusers`, `nama_pembimbing`, `nama_bimbingan`, `tgl_bimbingan`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
('764fa22b-068f-4f82-9701-87cd2c338a22', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Dr. Ir. Hendra Kusuma, M.Eng.Sc. ', 'Pengembangan Sistem Keamanan Jaringan Berbasis AI', '2023-06-13', '2023-09-19', '2025-04-04 20:25:59', '2025-04-04 20:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `datasering`
--

CREATE TABLE `datasering` (
  `iddatasering` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `pt_sasaran` varchar(150) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `bidang_tugas` varchar(150) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `metode` varchar(100) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datasering`
--

INSERT INTO `datasering` (`iddatasering`, `idusers`, `pt_sasaran`, `tgl_mulai`, `tgl_selesai`, `bidang_tugas`, `deskripsi`, `metode`, `no_sk`, `tgl_sk`, `created_at`, `updated_at`) VALUES
('428dfdb3-bd00-4da6-8983-a0bdc760ee76', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Universitas Airlangga', '2024-06-12', '2024-07-10', 'Pengembangan Sistem keamanan Siber', 'Riset dan pengembangan sistem deteksi serangan siber berbasis kecerdasan buatan untuk meningkatkan keamanan jaringan kampus.', 'Deep Learning dengan algoritma Convolutional Neural Network (CNN) untuk deteksi anomali jaringan.', '789/SK-IT/2025', '2024-06-11', '2025-04-04 20:20:27', '2025-04-04 20:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `diklat`
--

CREATE TABLE `diklat` (
  `iddiklat` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `jenisdiklat` varchar(36) NOT NULL,
  `namadiklat` varchar(45) NOT NULL,
  `penyelengara` varchar(50) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jmljam` int(11) NOT NULL,
  `no_sert` varchar(50) NOT NULL,
  `tgl_sert` date NOT NULL,
  `tahun_selenggara` int(11) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `no_sk_penugasan` varchar(50) NOT NULL,
  `tgl_sk_penugasan` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diklat`
--

INSERT INTO `diklat` (`iddiklat`, `idusers`, `jenisdiklat`, `namadiklat`, `penyelengara`, `peran`, `tingkat`, `jmljam`, `no_sert`, `tgl_sert`, `tahun_selenggara`, `tempat`, `tgl_mulai`, `tgl_selesai`, `no_sk_penugasan`, `tgl_sk_penugasan`, `created_at`, `updated_at`) VALUES
('b7afe121-bb40-4e5e-90a7-b557fcd34b6f', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Pelatihan Profesional', 'Pelatihan Data Science untuk Dosen Informatik', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Tek', 'Peserta', 'Nasional', 40, '372/DS/Kemendikbud/2023', '2023-04-10', 2023, 'Jakarta', '2023-04-05', '2023-04-10', '1170/SK/Diklat/2023', '2023-04-03', '2025-03-24 14:33:15', '2025-03-24 14:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_jurusan`
--

CREATE TABLE `dosen_jurusan` (
  `idjurusandosen` varchar(36) NOT NULL,
  `idfakultas` varchar(36) NOT NULL,
  `idjurusan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `fakultas` (
  `idfakultas` varchar(36) NOT NULL,
  `namafakultas` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `golongan` (
  `idgolongan` varchar(36) NOT NULL,
  `nama_golongan` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `identitas` (
  `kode` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `appname` varchar(45) DEFAULT NULL,
  `namains` varchar(45) DEFAULT NULL,
  `slogan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tahun` float DEFAULT NULL,
  `pimpinan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kdpos` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tlp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logo` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
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

CREATE TABLE `inpassing` (
  `id_inpassing` varchar(36) NOT NULL,
  `idgolongan` varchar(36) NOT NULL,
  `nomor_sk` varchar(45) NOT NULL,
  `tgl_sk` date NOT NULL,
  `mulai_tgl` date NOT NULL,
  `angka_kredit` int(11) NOT NULL,
  `masa_kerja_tahun` int(11) NOT NULL,
  `masa_kerja_bulan` int(11) NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inpassing`
--

INSERT INTO `inpassing` (`id_inpassing`, `idgolongan`, `nomor_sk`, `tgl_sk`, `mulai_tgl`, `angka_kredit`, `masa_kerja_tahun`, `masa_kerja_bulan`, `bukti`, `created_at`, `updated_at`, `idusers`) VALUES
('c3712861-c719-476d-a461-ea8b80572c58', 'f4007f5a-e1c1-418a-9922-429c709e319f', '456/STTAL/2022', '2022-02-09', '2022-02-10', 200, 16, 7, '', '2025-03-24 13:25:04', '2025-03-24 13:25:04', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `idjabatan` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_jabatan` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `jabatan_fungsional` (
  `id_jab_fungsi` varchar(36) NOT NULL,
  `nama_jab_fungsi` varchar(45) NOT NULL,
  `nilai` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `jabatan_fungsional_dosen` (
  `idjab_fungsi_dosen` varchar(36) NOT NULL,
  `id_jab_fungsi` varchar(36) NOT NULL,
  `nomor_sk` varchar(45) NOT NULL,
  `mulai` date NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan_fungsional_dosen`
--

INSERT INTO `jabatan_fungsional_dosen` (`idjab_fungsi_dosen`, `id_jab_fungsi`, `nomor_sk`, `mulai`, `bukti`, `idusers`, `created_at`, `updated_at`) VALUES
('d02a9109-42b8-47ed-9de0-aeb6a0faff2b', 'b20c3bb8-bab7-4674-a63e-e4cb36cabbd7', '045/STTAL/2024', '2024-03-04', '', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', '2025-03-24 13:36:51', '2025-03-24 13:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `jabstruktural`
--

CREATE TABLE `jabstruktural` (
  `idjabstruktural` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `jabatan` varchar(45) NOT NULL,
  `sk` varchar(56) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabstruktural`
--

INSERT INTO `jabstruktural` (`idjabstruktural`, `idusers`, `jabatan`, `sk`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
('ff80b7e3-ceac-4288-8116-5d475dc968d4', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Kaprodi D3 Teknik Informatika', ' 033/STTAL/TI/2024', '2024-02-12', '2025-04-21', '2025-04-21 21:10:17', '2025-04-21 21:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE `jenis_dokumen` (
  `idjenis_dok` varchar(36) NOT NULL,
  `nama_jenis_dok` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `idjurusan` varchar(36) NOT NULL,
  `namajurusan` varchar(45) NOT NULL,
  `idfakultas` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `keluarga` (
  `idkeluarga` varchar(36) NOT NULL,
  `status_kawin` varchar(45) NOT NULL,
  `nama_suami_istri` varchar(56) NOT NULL,
  `nip_suami_istri` varchar(56) NOT NULL,
  `pekerjaan_suami_istri` varchar(65) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kepangkatan`
--

CREATE TABLE `kepangkatan` (
  `idkepangkatan` varchar(36) NOT NULL,
  `idgolongan` varchar(36) NOT NULL,
  `nomor_sk` varchar(45) NOT NULL,
  `tgl_sk` date NOT NULL,
  `mulai_tgl` date NOT NULL,
  `masa_kerja_gol_tahun` int(11) NOT NULL,
  `masa_kerja_gol_bulan` int(11) NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepangkatan`
--

INSERT INTO `kepangkatan` (`idkepangkatan`, `idgolongan`, `nomor_sk`, `tgl_sk`, `mulai_tgl`, `masa_kerja_gol_tahun`, `masa_kerja_gol_bulan`, `bukti`, `idusers`, `created_at`, `updated_at`) VALUES
('0188ccff-4f2a-4b50-a432-671aeddfc790', 'f4007f5a-e1c1-418a-9922-429c709e319f', '237/KEP/2024', '2024-09-29', '2025-03-24', 16, 2, '', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', '2025-03-24 13:46:15', '2025-03-24 13:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `kepegawaian`
--

CREATE TABLE `kepegawaian` (
  `idkepegawaian` varchar(36) NOT NULL,
  `nomor_sk` varchar(45) NOT NULL,
  `tmmd` date NOT NULL,
  `sumber_gaji` varchar(45) NOT NULL,
  `status_aktif` varchar(45) NOT NULL,
  `program_studi` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kependudukan`
--

CREATE TABLE `kependudukan` (
  `idkependudukan` varchar(36) NOT NULL,
  `nik` varchar(56) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `warganegara` varchar(25) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korps`
--

CREATE TABLE `korps` (
  `idkorps` varchar(36) NOT NULL,
  `nama_korps` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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
('7ea37a7d-a41d-43c3-a7b2-c48092c26eab', 'Keu', '2025-03-20 14:50:27', '2025-03-20 14:50:27'),
('c31fb8e3-8933-4190-a089-109ad23ec795', 'Laut Marinir', '2024-12-27 13:54:12', '2025-03-20 09:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `lain_lain`
--

CREATE TABLE `lain_lain` (
  `idlain` varchar(36) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `nama_npwp` varchar(50) NOT NULL,
  `sinta_id` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `idusers` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orasi_ilmiah`
--

CREATE TABLE `orasi_ilmiah` (
  `idorasi` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `kategori` varchar(56) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `nama_temu` varchar(150) NOT NULL,
  `penyelenggara` varchar(150) NOT NULL,
  `tgl_laksana` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orasi_ilmiah`
--

INSERT INTO `orasi_ilmiah` (`idorasi`, `idusers`, `kategori`, `judul`, `nama_temu`, `penyelenggara`, `tgl_laksana`, `created_at`, `updated_at`) VALUES
('109fbf46-48f4-412f-a376-cb8e3730364c', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Konferensi Internasional', ' Implementasi Machine Learning dalam Deteksi Serangan Siber pada Jaringan IoT', 'International Conference on Artificial Intelligence and Cybersecurity (ICAICS) 2025', 'Universitas Airlangga', '2023-05-16', '2025-04-04 20:23:06', '2025-04-04 20:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `idpangkat` varchar(36) NOT NULL,
  `nama_pangkat` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `paten` (
  `idpaten` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `jenis` varchar(150) NOT NULL,
  `kategori_capaian` varchar(150) NOT NULL,
  `aktivitas_litabmas` varchar(150) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `tautan_ekternal` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_dokumen`
--

CREATE TABLE `paten_dokumen` (
  `idpaten_doc` varchar(36) NOT NULL,
  `idpaten` varchar(36) NOT NULL,
  `nama_doc` varchar(100) NOT NULL,
  `jenis_doc` varchar(100) NOT NULL,
  `file` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_dosen`
--

CREATE TABLE `paten_dosen` (
  `idpaten_dosen` varchar(36) NOT NULL,
  `idpaten` varchar(36) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(56) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_lain`
--

CREATE TABLE `paten_lain` (
  `idpaten_lain` varchar(36) NOT NULL,
  `idpaten` varchar(36) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(56) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paten_mahasiswa`
--

CREATE TABLE `paten_mahasiswa` (
  `idpaten_mhs` varchar(36) NOT NULL,
  `idpaten` varchar(36) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(56) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembicara`
--

CREATE TABLE `pembicara` (
  `idpembicara` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `tingkat` varchar(45) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `nama_temu` varchar(150) NOT NULL,
  `penyelanggara` varchar(150) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembicara`
--

INSERT INTO `pembicara` (`idpembicara`, `idusers`, `tingkat`, `judul`, `nama_temu`, `penyelanggara`, `tgl_pelaksanaan`, `created_at`, `updated_at`) VALUES
('08086d0c-700d-4292-9c2e-34d578e915bb', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Lokal', 'Penerapan Kriptografi Modern dalam Sistem Keamanan Informasi Nasional', 'Seminar Teknologi Informasi dan Keamanan Siber', 'Fakultas Teknik Informatika, ITS', '2023-12-06', '2025-04-21 21:06:29', '2025-04-21 21:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `pembinaan`
--

CREATE TABLE `pembinaan` (
  `idpembinaan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `tahun_ajar` varchar(9) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `kegiatan` varchar(250) NOT NULL,
  `judul_bimbingan` varchar(150) NOT NULL,
  `jenis_bimbingan` varchar(100) NOT NULL,
  `idjurusan` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembinaan`
--

INSERT INTO `pembinaan` (`idpembinaan`, `idusers`, `tahun_ajar`, `semester`, `kegiatan`, `judul_bimbingan`, `jenis_bimbingan`, `idjurusan`, `created_at`, `updated_at`) VALUES
('8643ca4f-74a3-4336-8abe-a311a5fea821', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', '2024-2025', 'Ganjil', 'Pembinaan Tugas Akhir', 'Rancang Bangun Sistem Informasi Beban Kerja Dosen STTAl berbasis website', 'Tugas Akhir', '2770e10c-132f-4feb-96f5-9c97295466ae', '2025-04-04 20:07:42', '2025-04-04 20:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_formal`
--

CREATE TABLE `pendidikan_formal` (
  `idpendformal` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `jenjang` varchar(5) NOT NULL,
  `pt` varchar(45) NOT NULL,
  `noinduk` varchar(45) NOT NULL,
  `program_studi` varchar(45) NOT NULL,
  `gelar` varchar(45) NOT NULL,
  `bidang` varchar(45) NOT NULL,
  `tahun_masuk` int(11) NOT NULL,
  `tgl_lulus` date NOT NULL,
  `ipk` float NOT NULL,
  `no_ijazah` varchar(56) NOT NULL,
  `judul_tesis` varchar(65) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan_formal`
--

INSERT INTO `pendidikan_formal` (`idpendformal`, `idusers`, `jenjang`, `pt`, `noinduk`, `program_studi`, `gelar`, `bidang`, `tahun_masuk`, `tgl_lulus`, `ipk`, `no_ijazah`, `judul_tesis`, `created_at`, `updated_at`) VALUES
('4222fbbf-53fe-4695-9e02-858002192799', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'S1', 'Universitas Tujuh Belas Agustus', '23/UNTAG/TI/2016', '2770e10c-132f-4feb-96f5-9c97295466ae', 'S.T.', 'Teknik Informatika', 2016, '2020-01-24', 3.83, '023/UNTAG/S1/2016', 'Rancang bangun aplikasi mobile untuk pemantauan kualitas udara be', '2025-03-24 14:12:44', '2025-03-24 14:12:44'),
('dee3a5d3-1126-4fa1-906b-6eb25704fa5d', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'S2', 'Institut Teknologi Sepuluh November', '17/ITS/TI/2021', '2770e10c-132f-4feb-96f5-9c97295466ae', 'M.Kom.', 'Teknik Informatika', 2021, '2023-07-11', 3.76, '17/ITS/S2/2023', 'Optimasi Jaringan Neural untuk Prediksi Beban Trafik Jaringan 5G ', '2025-03-24 14:19:16', '2025-03-24 14:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `idpenelitian` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `afiliasi` varchar(65) NOT NULL,
  `kelompok_bidang` varchar(65) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `no_sk` varchar(65) NOT NULL,
  `tgl_sk` date NOT NULL,
  `lama` varchar(20) NOT NULL,
  `tahun_usulan` int(11) NOT NULL,
  `tahun_kegiatan` int(11) NOT NULL,
  `tahun_pelaksanaan` int(11) NOT NULL,
  `tahun_ke` int(11) NOT NULL,
  `dana_dikti` double NOT NULL,
  `dana_univ` double NOT NULL,
  `dana_ins_lain` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`idpenelitian`, `idusers`, `judul`, `afiliasi`, `kelompok_bidang`, `lokasi`, `no_sk`, `tgl_sk`, `lama`, `tahun_usulan`, `tahun_kegiatan`, `tahun_pelaksanaan`, `tahun_ke`, `dana_dikti`, `dana_univ`, `dana_ins_lain`, `created_at`, `updated_at`) VALUES
('e5b19835-6a06-47d3-acfa-280273da4d7a', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Pengembangan Algoritma Machine Learning untuk Deteksi Serangan Siber', 'Fakultas Teknik Informatika, Institut Teknologi Sepuluh Nopember', 'Keamanan Siber dan Kecerdasan Buatan', 'ITS', '113/ITS/SK/2023', '2023-08-23', '1', 2023, 2023, 2023, 1, 50000000, 20000000, 5000000, '2025-04-04 21:11:53', '2025-04-04 21:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_dokumen`
--

CREATE TABLE `penelitian_dokumen` (
  `idpenelitian_doc` varchar(36) NOT NULL,
  `idpenelitian` varchar(36) NOT NULL,
  `judul_dokumen` varchar(150) NOT NULL,
  `file` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_dosen`
--

CREATE TABLE `penelitian_dosen` (
  `idpenelitian_dosen` varchar(36) NOT NULL,
  `idpenelitian` varchar(36) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_mahasiswa`
--

CREATE TABLE `penelitian_mahasiswa` (
  `idpenelitian_mhs` varchar(36) NOT NULL,
  `idpenelitian` varchar(36) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_non_civitas`
--

CREATE TABLE `penelitian_non_civitas` (
  `idpenelitian_non_civitas` varchar(36) NOT NULL,
  `idpenelitian` varchar(36) NOT NULL,
  `nama_non_civitas` varchar(50) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `idpenempatan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `status` varchar(45) NOT NULL,
  `ikatan_kerja` varchar(45) NOT NULL,
  `jenjang` varchar(15) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `pt` varchar(45) NOT NULL,
  `mulai` date NOT NULL,
  `keluar` date NOT NULL,
  `selesai` date NOT NULL,
  `home_base` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`idpenempatan`, `idusers`, `status`, `ikatan_kerja`, `jenjang`, `unit`, `pt`, `mulai`, `keluar`, `selesai`, `home_base`, `created_at`, `updated_at`) VALUES
('9c6049da-6ff1-402c-9adf-2867d7c2d4ac', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'PNS', 'Dosen Tetap', 'S2', 'Prodi Teknik Informatika', 'Universitas Tujuh belas Agustus', '2016-01-06', '2020-01-23', '2020-01-24', 'Ya', '2025-03-24 13:57:32', '2025-03-24 13:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `idpengabdian` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `tahun` int(11) NOT NULL,
  `afiliasi` varchar(100) NOT NULL,
  `sk_penugasan` varchar(100) NOT NULL,
  `tgl_penugasan` date NOT NULL,
  `lama` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `dana_dikti` double NOT NULL DEFAULT 0,
  `dana_pt` double NOT NULL DEFAULT 0,
  `dana_lain` double NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`idpengabdian`, `idusers`, `tahun`, `afiliasi`, `sk_penugasan`, `tgl_penugasan`, `lama`, `judul`, `lokasi`, `dana_dikti`, `dana_pt`, `dana_lain`, `created_at`, `updated_at`) VALUES
('980b11ea-6439-41d4-a89c-0ae7edd5ee71', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 2022, 'Universitas Pertahanan Indonesia', '012/UNHAN/TI/2023', '2023-08-09', 2, 'Pelatihan Keamanan Siber untuk Masyarakat Desa Digital', 'Desa Sukamaju, Kabupaten Bogor', 15, 10, 5, '2025-04-21 21:03:04', '2025-04-21 21:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_doc`
--

CREATE TABLE `pengabdian_doc` (
  `idpengabdian_doc` varchar(36) NOT NULL,
  `idpengabdian` varchar(36) NOT NULL,
  `judul_dokumen` varchar(150) NOT NULL,
  `file` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_dosen`
--

CREATE TABLE `pengabdian_dosen` (
  `idpengabdian_dosen` varchar(36) NOT NULL,
  `idpengabdian` varchar(36) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `peran` varchar(56) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_lain`
--

CREATE TABLE `pengabdian_lain` (
  `idpengabdian_lain` varchar(36) NOT NULL,
  `idpengabdian` varchar(36) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `peran` varchar(56) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_mhs`
--

CREATE TABLE `pengabdian_mhs` (
  `idpengabdian_mhs` varchar(36) NOT NULL,
  `idpengabdian` varchar(36) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `peran` varchar(56) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajaran`
--

CREATE TABLE `pengajaran` (
  `idpengajaran` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `matkul` varchar(56) NOT NULL,
  `jenismatkul` varchar(56) NOT NULL,
  `bidang` varchar(56) NOT NULL,
  `kelas` varchar(56) NOT NULL,
  `jml_mhs` int(11) NOT NULL,
  `sks` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajaran`
--

INSERT INTO `pengajaran` (`idpengajaran`, `idusers`, `matkul`, `jenismatkul`, `bidang`, `kelas`, `jml_mhs`, `sks`, `created_at`, `updated_at`) VALUES
('9fbab828-5832-4503-9109-d98606cb50fc', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Metodeologi Penulisan Tugas Akhir', 'Teori', 'Informatika', 'D3 18 TI dan Cyber', 26, 3, '2025-03-20 10:49:37', '2025-03-20 12:05:18'),
('acc93359-8abb-4054-9487-ab774d4b4150', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Pemrogrograman Web', 'Teori/Proyek Pemrograman', 'Informatika', 'D3 19 TI Umum', 27, 3, '2025-03-20 12:02:20', '2025-03-20 12:02:35'),
('46ac7a8b-8512-49cd-b25b-5cf0150888c2', 'eb3012cf-2eb9-4a2a-a3b1-5e98018b9796', 'Speaking Practice', 'Praktikum', 'Bahasa Inggris Teknis', 'D3 18 TI &amp; Cyber', 26, 3, '2025-03-20 12:10:03', '2025-03-20 12:10:03'),
('75150da0-c1db-4085-b4bb-cd38e849d8b3', 'eb3012cf-2eb9-4a2a-a3b1-5e98018b9796', 'Reading Comprehension', 'Teori', 'Bahasa Inggris Teknis', 'D3 20, TE, TM, TI', 48, 2, '2025-03-20 12:11:43', '2025-03-20 12:11:43'),
('7f713398-4eb1-4247-8bc9-1a8cc4d16e9e', '5151366e-4d7d-47cf-b94a-96e490730d24', 'Mikrokontroler', 'Praktikum', 'Teknik Elektronika', 'D3 19 TE', 12, 3, '2025-03-20 12:15:57', '2025-03-20 12:15:57'),
('a336c8e2-008e-4ed6-a600-67eb02675919', '5151366e-4d7d-47cf-b94a-96e490730d24', 'Dasar Elektronika', 'Teori dan Praktikum', 'Teknik Elektronika', 'D3 20 TE ', 14, 3, '2025-03-20 12:17:48', '2025-03-20 12:17:48'),
('8eaf08cd-b806-4a6b-bc3e-90ce930621bd', '1ffb916f-1c1c-401d-aaf8-aac2fb5ebfe0', 'Mekanika Teknik', 'Teori', 'Teknik Mesin', 'D3 20 TM', 13, 3, '2025-03-20 12:20:05', '2025-03-20 12:20:05'),
('cfef7aec-ed46-4cc2-b7de-32fabe6c5df2', '1ffb916f-1c1c-401d-aaf8-aac2fb5ebfe0', 'Termodinamika', 'Teori', 'Teknik Mesin', 'D3 19 TM', 12, 3, '2025-03-20 12:21:12', '2025-03-20 12:21:12'),
('a6c9bf26-a16e-4a8b-9d9a-9da8b5794635', '5ee15370-33ae-43c6-8d4d-bc0d6a965825', 'Etika dan kepemimpinan Militer', 'Teori', 'Ilmu Kepemimpinan dan Etika Militer', 'D3 20 TI dan Cyber', 25, 3, '2025-03-20 13:09:19', '2025-03-20 13:09:19'),
('c06b9c9c-2bde-4b34-999b-cfd4144147a3', '5ee15370-33ae-43c6-8d4d-bc0d6a965825', 'Metodeologi Penulisan Tugas Akhir', 'Teori', 'Ilmu Penelitian dan Ilmu Ilmiah', 'D3 18 TI dan Cyber', 26, 3, '2025-03-20 13:11:50', '2025-03-20 13:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `pengelola_jurnal`
--

CREATE TABLE `pengelola_jurnal` (
  `idpengelolajurnal` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `nama_jurnal` varchar(150) NOT NULL,
  `sk` varchar(45) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_aktif` varchar(15) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengelola_jurnal`
--

INSERT INTO `pengelola_jurnal` (`idpengelolajurnal`, `idusers`, `nama_jurnal`, `sk`, `tgl_mulai`, `tgl_selesai`, `status_aktif`, `peran`, `created_at`, `updated_at`) VALUES
('9ad36564-c62d-44a3-9c2e-d26556ec7a21', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Jurnal Keamanan Siber dan Informatika Militer', '045/SK-UNHAN/TI/2023', '2023-09-13', '2023-11-16', 'Aktif', 'Editor in Chief', '2025-04-21 21:08:03', '2025-04-21 21:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `idpenghargaan` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `penghargaan` varchar(150) NOT NULL,
  `jenis_penghargaan` varchar(65) NOT NULL,
  `instansi` varchar(65) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengujian`
--

CREATE TABLE `pengujian` (
  `idpengujian` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `judul` varchar(45) NOT NULL,
  `bidang` varchar(45) NOT NULL,
  `jenis` varchar(45) NOT NULL,
  `idjurusan` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengujian`
--

INSERT INTO `pengujian` (`idpengujian`, `idusers`, `judul`, `bidang`, `jenis`, `idjurusan`, `created_at`, `updated_at`) VALUES
('2a561025-3ed0-452f-a096-92f8f421fd70', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Rancang bangun Sistem Informasi BKD STTAL', 'Teknik Informatika', 'Tugas Akhir', '2770e10c-132f-4feb-96f5-9c97295466ae', '2025-03-20 13:59:15', '2025-03-20 14:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `penunjang_lain`
--

CREATE TABLE `penunjang_lain` (
  `idpenunjang` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `nama_keg` varchar(65) NOT NULL,
  `instansi` varchar(65) NOT NULL,
  `no_sk` varchar(65) NOT NULL,
  `terhitung_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

CREATE TABLE `publikasi` (
  `idpublikasi` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `kategori_keg` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kategori_capaian` varchar(100) NOT NULL,
  `aktivitas_litabmas` varchar(150) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `jml_hal` int(11) NOT NULL,
  `penerbit` varchar(65) NOT NULL,
  `ISBN` varchar(65) NOT NULL,
  `tautan_external` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_dokumen`
--

CREATE TABLE `publikasi_dokumen` (
  `idpublikasi_doc` varchar(36) NOT NULL,
  `idpublikasi` varchar(36) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `file` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_dosen`
--

CREATE TABLE `publikasi_dosen` (
  `idpublikasi_dosen` varchar(36) NOT NULL,
  `idpublikasi` varchar(36) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(45) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_lain`
--

CREATE TABLE `publikasi_lain` (
  `idpublikasi_lain` varchar(36) NOT NULL,
  `idpublikasi` varchar(36) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(45) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_mahasiswa`
--

CREATE TABLE `publikasi_mahasiswa` (
  `idpublikasi_mhs` varchar(36) NOT NULL,
  `idpublikasi` varchar(36) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `urutan` int(11) NOT NULL,
  `afiliasi` varchar(45) NOT NULL,
  `peran` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kerja`
--

CREATE TABLE `riwayat_kerja` (
  `idriwayat_kerja` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `bidang_usaha` varchar(56) NOT NULL,
  `jenis_pekerjaan` varchar(56) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `instansi` varchar(56) NOT NULL,
  `divisi` varchar(45) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `mulai_kerja` date NOT NULL,
  `selesai_kerja` date NOT NULL,
  `area` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_kerja`
--

INSERT INTO `riwayat_kerja` (`idriwayat_kerja`, `idusers`, `bidang_usaha`, `jenis_pekerjaan`, `jabatan`, `instansi`, `divisi`, `deskripsi`, `mulai_kerja`, `selesai_kerja`, `area`, `created_at`, `updated_at`) VALUES
('c8544494-ce6d-4812-92a8-614bbeccc588', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Aktivitas Jasa Lainnya', 'Pimpinan / Manajerial', 'Kaprodi D3 Teknik Informa', 'TNI AL', 'STTAL', 'memiliki tugas utama dalam mengelola dan mengembangkan program studi agar sesuai dengan standar akademik dan kebutuhan industri', '2024-05-07', '2025-03-28', 'Dalam Negeri', '2025-03-28 10:55:14', '2025-03-28 10:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `satker`
--

CREATE TABLE `satker` (
  `idsatker` varchar(36) NOT NULL,
  `namasatker` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
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

CREATE TABLE `sertifikasi` (
  `idsertifikasi` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `jenis` varchar(45) NOT NULL,
  `bidang` varchar(56) NOT NULL,
  `nomor_sk` varchar(56) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nomor_peserta` int(11) NOT NULL,
  `nomor_regis` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `idtes` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `jenis_tes` text NOT NULL,
  `nama_tes` varchar(45) NOT NULL,
  `penyelenggara` varchar(56) NOT NULL,
  `tgl_tes` date NOT NULL,
  `tahun` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_tambahan`
--

CREATE TABLE `tugas_tambahan` (
  `idtugas` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `tugas` varchar(150) NOT NULL,
  `unit` varchar(56) NOT NULL,
  `instansi` varchar(65) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas_tambahan`
--

INSERT INTO `tugas_tambahan` (`idtugas`, `idusers`, `tugas`, `unit`, `instansi`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
('dfc2139a-19fc-4fed-999e-a7921915e377', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Koordinator Keamanan Jaringan', 'Pusat Data dan Keamanan Siber', 'Universitas Airlangga', '2023-02-08', '2023-02-27', '2025-04-04 20:29:49', '2025-04-04 20:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` varchar(36) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nrp` varchar(25) DEFAULT NULL,
  `nama` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `idjabatan` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idsatker` varchar(36) NOT NULL,
  `idpangkat` varchar(36) NOT NULL,
  `idkorps` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `email`, `pass`, `nrp`, `nama`, `foto`, `idjabatan`, `idsatker`, `idpangkat`, `idkorps`, `created_at`, `updated_at`) VALUES
('1ffb916f-1c1c-401d-aaf8-aac2fb5ebfe0', 'pompy', 'pompy@gmail.com', 'aGtq', '17816/P', 'Pompy, S.T., M.T., M.Tr.Opsla', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '4dedc097-e0d5-48d2-b997-53faeb13c75c', '2025-03-20 11:30:29', '2025-03-20 11:30:29'),
('5151366e-4d7d-47cf-b94a-96e490730d24', 'bagusirawan', 'bagusirawan@gmail.com', 'aGtq', '15618/P', 'Bagus Irawan, S.T.,M.T', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5499fb13-2815-4d0a-9bdb-49610f855dbb', '2025-03-20 11:28:19', '2025-03-20 11:28:29'),
('5ee15370-33ae-43c6-8d4d-bc0d6a965825', 'wawankusdiana', 'wawankusdiana@gmail.com', 'aGtq', '11468/P', 'Dr. Wawan Kusdiana, S.T., M.T.,', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', 'd71dab4d-5ca5-4402-a959-8adac6849720', '4dedc097-e0d5-48d2-b997-53faeb13c75c', '2025-03-20 13:04:55', '2025-03-20 13:04:55'),
('d53e6d1e-36f8-4854-a597-4fd2afc812ac', 'zainalsyahlan', 'zainalsyahlan@gmail.com', 'aGtq', '17813/P', 'Zainal Syahlan, S.T., M.Kom., M.Tr.Opsla', '1742796168_770a9c227ace8ed6dad1.jpeg', '6e32c857-5fb7-4754-87ed-bd740c658e52', '23a0b274-6252-4d10-9387-349486727e97', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5c8da38b-1e92-4f3b-aad5-02276c4de86a', '2025-03-20 10:29:34', '2025-03-24 13:02:48'),
('ddced26c-3b25-4e7a-9097-3729585f5518', 'isnadi', 'isnadi@gmail.com', 'aGtq', '18328/P', 'Isnadi, S.Kom., M.Tr.Opsla', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '47e28f2b-8189-4cb1-bb56-e3cac3e1a689', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5499fb13-2815-4d0a-9bdb-49610f855dbb', '2025-03-20 12:36:02', '2025-03-20 12:36:02'),
('eb3012cf-2eb9-4a2a-a3b1-5e98018b9796', 'arifsudaryoko', 'arifsudaryoko@gmail.com', 'aGtq', '16284/P', 'Arif Sudaryoko.S.pd', '', '6e32c857-5fb7-4754-87ed-bd740c658e52', '6b49d143-2129-4472-8fdc-5d204f189395', '854c9f71-9bd4-4edb-a647-5dd4d25f7b03', '5c8da38b-1e92-4f3b-aad5-02276c4de86a', '2025-03-20 11:25:17', '2025-03-20 11:25:17'),
('U00001', 'ADMIN', 'admin@gmail.com', 'aGtq', 'admin', 'Administrator', '1739432338_d8f676931205a36e774b.png', 'f093ffbe-41f5-42c7-a184-19226cd97a69', '23a0b274-6252-4d10-9387-349486727e97', 'd6eb5530-b3f1-4d81-a43a-ef3615e2dffe', '7ea37a7d-a41d-43c3-a7b2-c48092c26eab', '2024-12-29 10:54:06', '2025-03-20 14:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `users_detil`
--

CREATE TABLE `users_detil` (
  `idusers_detil` varchar(36) NOT NULL,
  `nidn` varchar(45) NOT NULL,
  `jkel` varchar(15) NOT NULL,
  `tmp_lahir` varchar(55) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visiting`
--

CREATE TABLE `visiting` (
  `idvisiting` varchar(36) NOT NULL,
  `idusers` varchar(36) NOT NULL,
  `pt_pengundang` varchar(55) NOT NULL,
  `lama_kegiatan` int(11) NOT NULL,
  `kategori_kegiatan` varchar(45) NOT NULL,
  `kegiatan_penting` varchar(150) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `sk_penugasan` varchar(55) NOT NULL,
  `tgl_sk` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visiting`
--

INSERT INTO `visiting` (`idvisiting`, `idusers`, `pt_pengundang`, `lama_kegiatan`, `kategori_kegiatan`, `kegiatan_penting`, `tgl_pelaksanaan`, `sk_penugasan`, `tgl_sk`, `created_at`, `updated_at`) VALUES
('216f2a04-ff84-42d6-b848-d267c006df39', 'd53e6d1e-36f8-4854-a597-4fd2afc812ac', 'Institut teknologi sepuluh nopember', 1, 'Riset dalam bidang kecerdasan buatan', 'Pengembangan model Machine Learning untuk deteksi wajah', '2024-10-09', 'SK Rektor No. 044/IT/2024', '2024-10-08', '2025-04-04 20:15:40', '2025-04-04 20:15:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_kontak`
--
ALTER TABLE `alamat_kontak`
  ADD PRIMARY KEY (`idalamat`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `anggota_profesi`
--
ALTER TABLE `anggota_profesi`
  ADD PRIMARY KEY (`idang_profesi`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `bahanajar`
--
ALTER TABLE `bahanajar`
  ADD PRIMARY KEY (`idbahanajar`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`idbimbingan`),
  ADD KEY `idusers` (`idusers`),
  ADD KEY `idjurusan` (`idjurusan`);

--
-- Indexes for table `bimbingan_dosen`
--
ALTER TABLE `bimbingan_dosen`
  ADD PRIMARY KEY (`idbimbingan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `datasering`
--
ALTER TABLE `datasering`
  ADD PRIMARY KEY (`iddatasering`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `diklat`
--
ALTER TABLE `diklat`
  ADD PRIMARY KEY (`iddiklat`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `dosen_jurusan`
--
ALTER TABLE `dosen_jurusan`
  ADD PRIMARY KEY (`idjurusandosen`),
  ADD KEY `idfakultas` (`idfakultas`),
  ADD KEY `idjurusan` (`idjurusan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`idfakultas`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`idgolongan`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `inpassing`
--
ALTER TABLE `inpassing`
  ADD PRIMARY KEY (`id_inpassing`),
  ADD KEY `idusers` (`idusers`),
  ADD KEY `idgolongan` (`idgolongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `jabatan_fungsional`
--
ALTER TABLE `jabatan_fungsional`
  ADD PRIMARY KEY (`id_jab_fungsi`);

--
-- Indexes for table `jabatan_fungsional_dosen`
--
ALTER TABLE `jabatan_fungsional_dosen`
  ADD PRIMARY KEY (`idjab_fungsi_dosen`),
  ADD KEY `id_jab_fungsi` (`id_jab_fungsi`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `jabstruktural`
--
ALTER TABLE `jabstruktural`
  ADD PRIMARY KEY (`idjabstruktural`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`idjenis_dok`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`idjurusan`),
  ADD KEY `idfakultas` (`idfakultas`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`idkeluarga`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `kepangkatan`
--
ALTER TABLE `kepangkatan`
  ADD PRIMARY KEY (`idkepangkatan`),
  ADD KEY `idgolongan` (`idgolongan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `kepegawaian`
--
ALTER TABLE `kepegawaian`
  ADD PRIMARY KEY (`idkepegawaian`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `kependudukan`
--
ALTER TABLE `kependudukan`
  ADD PRIMARY KEY (`idkependudukan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `korps`
--
ALTER TABLE `korps`
  ADD PRIMARY KEY (`idkorps`);

--
-- Indexes for table `lain_lain`
--
ALTER TABLE `lain_lain`
  ADD PRIMARY KEY (`idlain`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `orasi_ilmiah`
--
ALTER TABLE `orasi_ilmiah`
  ADD PRIMARY KEY (`idorasi`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`idpangkat`);

--
-- Indexes for table `paten`
--
ALTER TABLE `paten`
  ADD PRIMARY KEY (`idpaten`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `paten_dokumen`
--
ALTER TABLE `paten_dokumen`
  ADD PRIMARY KEY (`idpaten_doc`),
  ADD KEY `idpaten` (`idpaten`);

--
-- Indexes for table `paten_dosen`
--
ALTER TABLE `paten_dosen`
  ADD PRIMARY KEY (`idpaten_dosen`),
  ADD KEY `idpaten` (`idpaten`);

--
-- Indexes for table `paten_lain`
--
ALTER TABLE `paten_lain`
  ADD PRIMARY KEY (`idpaten_lain`),
  ADD KEY `idpaten` (`idpaten`);

--
-- Indexes for table `paten_mahasiswa`
--
ALTER TABLE `paten_mahasiswa`
  ADD PRIMARY KEY (`idpaten_mhs`),
  ADD KEY `idpaten` (`idpaten`);

--
-- Indexes for table `pembicara`
--
ALTER TABLE `pembicara`
  ADD PRIMARY KEY (`idpembicara`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pembinaan`
--
ALTER TABLE `pembinaan`
  ADD PRIMARY KEY (`idpembinaan`),
  ADD KEY `idusers` (`idusers`),
  ADD KEY `idjurusan` (`idjurusan`);

--
-- Indexes for table `pendidikan_formal`
--
ALTER TABLE `pendidikan_formal`
  ADD PRIMARY KEY (`idpendformal`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`idpenelitian`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `penelitian_dokumen`
--
ALTER TABLE `penelitian_dokumen`
  ADD PRIMARY KEY (`idpenelitian_doc`),
  ADD KEY `idpenelitian` (`idpenelitian`);

--
-- Indexes for table `penelitian_dosen`
--
ALTER TABLE `penelitian_dosen`
  ADD PRIMARY KEY (`idpenelitian_dosen`),
  ADD KEY `idpenelitian` (`idpenelitian`);

--
-- Indexes for table `penelitian_mahasiswa`
--
ALTER TABLE `penelitian_mahasiswa`
  ADD PRIMARY KEY (`idpenelitian_mhs`),
  ADD KEY `idpenelitian` (`idpenelitian`);

--
-- Indexes for table `penelitian_non_civitas`
--
ALTER TABLE `penelitian_non_civitas`
  ADD PRIMARY KEY (`idpenelitian_non_civitas`),
  ADD KEY `idpenelitian` (`idpenelitian`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`idpenempatan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`idpengabdian`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pengabdian_doc`
--
ALTER TABLE `pengabdian_doc`
  ADD PRIMARY KEY (`idpengabdian_doc`),
  ADD KEY `idpengabdian` (`idpengabdian`);

--
-- Indexes for table `pengabdian_dosen`
--
ALTER TABLE `pengabdian_dosen`
  ADD PRIMARY KEY (`idpengabdian_dosen`),
  ADD KEY `idpengabdian` (`idpengabdian`);

--
-- Indexes for table `pengabdian_lain`
--
ALTER TABLE `pengabdian_lain`
  ADD PRIMARY KEY (`idpengabdian_lain`),
  ADD KEY `idpengabdian` (`idpengabdian`);

--
-- Indexes for table `pengabdian_mhs`
--
ALTER TABLE `pengabdian_mhs`
  ADD PRIMARY KEY (`idpengabdian_mhs`),
  ADD KEY `idpengabdian` (`idpengabdian`);

--
-- Indexes for table `pengajaran`
--
ALTER TABLE `pengajaran`
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pengelola_jurnal`
--
ALTER TABLE `pengelola_jurnal`
  ADD PRIMARY KEY (`idpengelolajurnal`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`idpenghargaan`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `pengujian`
--
ALTER TABLE `pengujian`
  ADD PRIMARY KEY (`idpengujian`),
  ADD KEY `idusers` (`idusers`),
  ADD KEY `idjurusan` (`idjurusan`);

--
-- Indexes for table `penunjang_lain`
--
ALTER TABLE `penunjang_lain`
  ADD PRIMARY KEY (`idpenunjang`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `publikasi`
--
ALTER TABLE `publikasi`
  ADD PRIMARY KEY (`idpublikasi`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `publikasi_dokumen`
--
ALTER TABLE `publikasi_dokumen`
  ADD PRIMARY KEY (`idpublikasi_doc`),
  ADD KEY `idpublikasi` (`idpublikasi`);

--
-- Indexes for table `publikasi_dosen`
--
ALTER TABLE `publikasi_dosen`
  ADD PRIMARY KEY (`idpublikasi_dosen`),
  ADD KEY `idpublikasi` (`idpublikasi`);

--
-- Indexes for table `publikasi_lain`
--
ALTER TABLE `publikasi_lain`
  ADD PRIMARY KEY (`idpublikasi_lain`),
  ADD KEY `idpublikasi` (`idpublikasi`);

--
-- Indexes for table `publikasi_mahasiswa`
--
ALTER TABLE `publikasi_mahasiswa`
  ADD PRIMARY KEY (`idpublikasi_mhs`),
  ADD KEY `idpublikasi` (`idpublikasi`);

--
-- Indexes for table `riwayat_kerja`
--
ALTER TABLE `riwayat_kerja`
  ADD PRIMARY KEY (`idriwayat_kerja`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `satker`
--
ALTER TABLE `satker`
  ADD PRIMARY KEY (`idsatker`);

--
-- Indexes for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  ADD PRIMARY KEY (`idsertifikasi`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`idtes`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `tugas_tambahan`
--
ALTER TABLE `tugas_tambahan`
  ADD PRIMARY KEY (`idtugas`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `FK_users_jabatan` (`idjabatan`),
  ADD KEY `FK_users_pangkat` (`idpangkat`),
  ADD KEY `FK_users_satker` (`idsatker`),
  ADD KEY `FK_users_korps` (`idkorps`);

--
-- Indexes for table `users_detil`
--
ALTER TABLE `users_detil`
  ADD PRIMARY KEY (`idusers_detil`),
  ADD KEY `idusers` (`idusers`);

--
-- Indexes for table `visiting`
--
ALTER TABLE `visiting`
  ADD PRIMARY KEY (`idvisiting`),
  ADD KEY `idusers` (`idusers`);

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
-- Constraints for table `jabstruktural`
--
ALTER TABLE `jabstruktural`
  ADD CONSTRAINT `jabstruktural_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `pembicara`
--
ALTER TABLE `pembicara`
  ADD CONSTRAINT `pembiacara_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD CONSTRAINT `pengabdian_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengabdian_doc`
--
ALTER TABLE `pengabdian_doc`
  ADD CONSTRAINT `pengabdian_doc_ibfk_1` FOREIGN KEY (`idpengabdian`) REFERENCES `pengabdian` (`idpengabdian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengabdian_dosen`
--
ALTER TABLE `pengabdian_dosen`
  ADD CONSTRAINT `pengabdian_dosen_ibfk_1` FOREIGN KEY (`idpengabdian`) REFERENCES `pengabdian` (`idpengabdian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengabdian_lain`
--
ALTER TABLE `pengabdian_lain`
  ADD CONSTRAINT `pengabdian_lain_ibfk_1` FOREIGN KEY (`idpengabdian`) REFERENCES `pengabdian` (`idpengabdian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengabdian_mhs`
--
ALTER TABLE `pengabdian_mhs`
  ADD CONSTRAINT `pengabdian_mhs_ibfk_1` FOREIGN KEY (`idpengabdian`) REFERENCES `pengabdian` (`idpengabdian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajaran`
--
ALTER TABLE `pengajaran`
  ADD CONSTRAINT `pengajaran_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengelola_jurnal`
--
ALTER TABLE `pengelola_jurnal`
  ADD CONSTRAINT `pengelola_jurnal_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

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
