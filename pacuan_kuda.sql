-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 06, 2025 at 12:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pacuan_kuda`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri_gambar`
--

CREATE TABLE `galeri_gambar` (
  `id` int(11) NOT NULL,
  `path_gambar` varchar(255) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri_gambar`
--

INSERT INTO `galeri_gambar` (`id`, `path_gambar`, `alt_text`, `deskripsi`, `tanggal_upload`) VALUES
(3, 'img/imggaleri/gambar bawah/img_690c797d699898.11151242.jpg', '', 'foto1', '2025-11-06 17:33:33'),
(4, 'img/imggaleri/gambar bawah/img_690c79b3a9b132.90642163.jpg', '', 'foto_2', '2025-11-06 17:34:27'),
(5, 'img/imggaleri/gambar bawah/img_690c79be050e12.38329829.jpg', '', 'foto_3', '2025-11-06 17:34:38'),
(6, 'img/imggaleri/gambar bawah/img_690c79c8681ea8.67375842.jpg', '', 'foto_4', '2025-11-06 17:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_wa` varchar(20) NOT NULL,
  `tempat_tinggal` varchar(255) NOT NULL,
  `jadwal_latihan` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `program_latihan` varchar(100) NOT NULL,
  `kategori_anggota` varchar(50) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `bukti_pembayaran_path` varchar(255) DEFAULT NULL,
  `tgl_pendaftaran` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama_lengkap`, `nomor_wa`, `tempat_tinggal`, `jadwal_latihan`, `trainer`, `program_latihan`, `kategori_anggota`, `metode_pembayaran`, `nominal`, `bukti_pembayaran_path`, `tgl_pendaftaran`) VALUES
(2, 'rey', '12345678', 'vvvv', 'Selasa Sore', 'Nuriman', 'Group Lesson', 'Non Member', 'Transfer Bank', 1234567890.00, 'uploads/bukti_690a235fa12f7.jpg', '2025-11-04 23:01:35'),
(3, 'shin', '34567', 'vvvv', 'Kamis Sore', 'Yustuan/Pandi', 'Paket Horse Training Bulanan', 'Non Member', 'Transfer Bank', 123456789.00, 'uploads/bukti_690a24c203f98.jpg', '2025-11-04 23:07:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri_gambar`
--
ALTER TABLE `galeri_gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri_gambar`
--
ALTER TABLE `galeri_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
