-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 06:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_abcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `status`, `create_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Aktif', '2023-12-30 06:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `mdt_buku`
--

CREATE TABLE `mdt_buku` (
  `id_buku` int(5) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `jenis_buku` enum('Buku Bacaan','Buku Ajar(Diktat)') NOT NULL,
  `id_admin` int(5) NOT NULL,
  `file` varchar(50) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mdt_buku`
--

INSERT INTO `mdt_buku` (`id_buku`, `judul_buku`, `deskripsi`, `pengarang`, `jenis_buku`, `id_admin`, `file`, `create_date`) VALUES
(4, 'ALGORITMA PEMROGRAMAN', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita ea iusto aut assumenda, delectus soluta culpa dolore placeat provident repudiandae nihil error pariatur obcaecati nisi exercitationem deserunt, quibusdam saepe cumque?\r\n', 'Edy Budiman', 'Buku Ajar(Diktat)', 1, 'ALPRO.pdf', '2023-12-30 09:06:52'),
(5, 'Pemrograman Web', 'Pemrograman web adalah belajar tentang HTML CSS dan JS', 'Raffi Digital', 'Buku Bacaan', 1, 'Mengenal dan Menggunakan java.pdf', '2023-12-31 04:55:03'),
(20, 'Belajar Dasar Laravel', 'Mempelajari Tentang Laravel dan Konsepnya', 'Arnold Frimawan', 'Buku Bacaan', 1, 'Laravel.pdf', '2023-12-31 05:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `mdt_laporan_ta`
--

CREATE TABLE `mdt_laporan_ta` (
  `id_laporan` int(5) NOT NULL,
  `judul_laporan` varchar(255) NOT NULL,
  `abstrak` text NOT NULL,
  `nim` int(8) NOT NULL,
  `id_prodi` int(5) NOT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('Proses','Selesai') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mdt_laporan_ta`
--

INSERT INTO `mdt_laporan_ta` (`id_laporan`, `judul_laporan`, `abstrak`, `nim`, `id_prodi`, `file`, `status`, `create_date`) VALUES
(2, 'sistem persediaan barang', 'lorem', 20302031, 1, 'sistem persediaan barang.pdf', 'Selesai', '2023-12-30 11:11:51'),
(9, 'Rancang Bangun Elearning', 'TA Rancang Bangun', 20302030, 1, 'Rancang Bangun Elearning.pdf', 'Proses', '2023-12-31 05:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `nim` int(8) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') NOT NULL,
  `id_prodi` int(5) NOT NULL,
  `id_smt` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('Aktif','Cuti','DO','Undri') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nim`, `nama_mhs`, `jenkel`, `id_prodi`, `id_smt`, `email`, `password`, `status`) VALUES
(20302030, 'Agus Iki Amadan', 'Laki-laki', 1, 5, 'Agus@gmail.com', 'e8d67585936afcae8878c354f215aa40', 'Aktif'),
(20302031, 'Aang Asim', 'Laki-laki', 1, 6, 'Aang@gmail.com', 'e1b102bcfd18317b1faa02095bde8275', 'Aktif'),
(22302040, 'Ahmad Fajar ismail', 'Laki-laki', 1, 1, 'afajarismail.gmail.com', 'c2bf1ffe6db776b3af615578dd4adcf6', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(5) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` enum('D3','D4') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `jenjang`, `status`, `create_date`) VALUES
(1, 'TEKNIK INFORMATIKA', 'D3', 'Aktif', '2023-12-19 01:02:47'),
(2, 'TEKNIK OTOMATIF', 'D3', 'Aktif', '2023-12-19 01:02:47'),
(3, 'BUDIDAYA TANAMAN PERKEBUNAN', 'D3', 'Aktif', '2023-12-19 01:02:47'),
(4, 'BISNIS DIGITAL', 'D4', 'Aktif', '2023-12-19 01:02:47'),
(5, 'MANAJEMEN PEMASARAN INTERNASIONAL', 'D4', 'Aktif', '2023-12-19 01:02:47'),
(6, 'AKUNTANSI BISNIS DIGITAL', 'D4', 'Aktif', '2023-12-19 01:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `smt`
--

CREATE TABLE `smt` (
  `id_smt` int(5) NOT NULL,
  `nama_smt` enum('I','II','III','IV','V','VI','VII','VIII') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smt`
--

INSERT INTO `smt` (`id_smt`, `nama_smt`, `create_date`) VALUES
(1, 'I', '2023-12-19 01:04:18'),
(2, 'II', '2023-12-30 07:09:32'),
(3, 'III', '2023-12-30 07:09:32'),
(4, 'IV', '2023-12-30 07:09:32'),
(5, 'V', '2023-12-30 07:09:32'),
(6, 'VI', '2023-12-30 07:09:32'),
(7, 'VII', '2023-12-30 07:09:32'),
(8, 'VIII', '2023-12-30 07:09:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `mdt_buku`
--
ALTER TABLE `mdt_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_admin_2` (`id_admin`);

--
-- Indexes for table `mdt_laporan_ta`
--
ALTER TABLE `mdt_laporan_ta`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `nim` (`nim`,`id_prodi`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_prodi` (`id_prodi`,`id_smt`),
  ADD KEY `id_smt` (`id_smt`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `smt`
--
ALTER TABLE `smt`
  ADD PRIMARY KEY (`id_smt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mdt_buku`
--
ALTER TABLE `mdt_buku`
  MODIFY `id_buku` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mdt_laporan_ta`
--
ALTER TABLE `mdt_laporan_ta`
  MODIFY `id_laporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `nim` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22302041;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `smt`
--
ALTER TABLE `smt`
  MODIFY `id_smt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mdt_buku`
--
ALTER TABLE `mdt_buku`
  ADD CONSTRAINT `mdt_buku_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mdt_laporan_ta`
--
ALTER TABLE `mdt_laporan_ta`
  ADD CONSTRAINT `mdt_laporan_ta_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mhs` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mdt_laporan_ta_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_ibfk_2` FOREIGN KEY (`id_smt`) REFERENCES `smt` (`id_smt`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
