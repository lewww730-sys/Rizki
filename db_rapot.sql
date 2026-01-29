-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 03:34 AM
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
-- Database: `db_rapot`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_rizki`
--

CREATE TABLE `absensi_rizki` (
  `id_absen` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alfa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_rizki`
--

INSERT INTO `absensi_rizki` (`id_absen`, `nis`, `sakit`, `izin`, `alfa`) VALUES
(12, 102457, 4, 6, 8),
(13, 102458, 4, 1, 1),
(17, 102456, 1, 2, 3),
(20, 102459, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `guru_rizki`
--

CREATE TABLE `guru_rizki` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `no_telp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_rizki`
--

CREATE TABLE `kelas_rizki` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_rizki`
--

INSERT INTO `kelas_rizki` (`id_kelas`, `nama_kelas`, `id_guru`) VALUES
(1, 'X RPL A', 132456),
(2, 'X RPL B', 879465),
(3, 'XI RPL A', 654789),
(4, 'XI RPL A', 789464);

-- --------------------------------------------------------

--
-- Table structure for table `mapel_rizki`
--

CREATE TABLE `mapel_rizki` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(125) NOT NULL,
  `kkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel_rizki`
--

INSERT INTO `mapel_rizki` (`id_mapel`, `nama_mapel`, `kkm`) VALUES
(1, 'Matematika', 80),
(2, 'B.Inggris', 80),
(3, 'B.Jepang', 80),
(4, 'B.Indonesia', 80);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_rizki`
--

CREATE TABLE `nilai_rizki` (
  `id_nilai` varchar(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nilai_tugas` decimal(10,0) NOT NULL,
  `nilai_uts` decimal(10,0) NOT NULL,
  `nilai_uas` decimal(10,0) NOT NULL,
  `nilai_akhir` decimal(10,0) NOT NULL,
  `deskripsi` text NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_rizki`
--

INSERT INTO `nilai_rizki` (`id_nilai`, `nis`, `id_mapel`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `nilai_akhir`, `deskripsi`, `semester`, `tahun_ajaran`) VALUES
('NP001', 102459, 4, 57, 78, 98, 78, 'sangat baik', 'Genap', '2024'),
('NP002', 102459, 2, 89, 89, 84, 0, 'sangat baik', 'Genap', '6'),
('NP003', 102459, 1, 78, 76, 56, 0, 'sangat baik', 'Genap', '2028');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_rizki`
--

CREATE TABLE `siswa_rizki` (
  `nis` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa_rizki`
--

INSERT INTO `siswa_rizki` (`nis`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `id_kelas`) VALUES
(102456, 'Dirgahayu', 'Cimahi', '2008-08-17', 'Citereup', 3),
(102457, 'M.Rizki', 'Cimahi', '2008-07-17', 'Pakuhaji', 3),
(102458, 'Novri', 'Cimahi', '2008-06-17', 'Sangkuriang', 2),
(102459, 'alif', 'Cimahi', '2008-05-17', 'Kebon Kopi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_rizki`
--

CREATE TABLE `user_rizki` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` enum('admin','guru','wali kelas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rizki`
--

INSERT INTO `user_rizki` (`id`, `username`, `password`, `role`) VALUES
(135778, 'dirganz', '126548', 'admin'),
(652315, 'alifnz', '641258', 'wali kelas'),
(656565, 'novrinz', '54664865', 'admin'),
(753156, 'rizkiq', '564164', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_rizki`
--
ALTER TABLE `absensi_rizki`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `guru_rizki`
--
ALTER TABLE `guru_rizki`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas_rizki`
--
ALTER TABLE `kelas_rizki`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `mapel_rizki`
--
ALTER TABLE `mapel_rizki`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `nilai_rizki`
--
ALTER TABLE `nilai_rizki`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `siswa_rizki`
--
ALTER TABLE `siswa_rizki`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `user_rizki`
--
ALTER TABLE `user_rizki`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mapel_rizki`
--
ALTER TABLE `mapel_rizki`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi_rizki`
--
ALTER TABLE `absensi_rizki`
  ADD CONSTRAINT `FK_nis` FOREIGN KEY (`nis`) REFERENCES `siswa_rizki` (`nis`);

--
-- Constraints for table `guru_rizki`
--
ALTER TABLE `guru_rizki`
  ADD CONSTRAINT `fk_guru` FOREIGN KEY (`id_guru`) REFERENCES `kelas_rizki` (`id_guru`);

--
-- Constraints for table `nilai_rizki`
--
ALTER TABLE `nilai_rizki`
  ADD CONSTRAINT `FK_id_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel_rizki` (`id_mapel`),
  ADD CONSTRAINT `FK_nis2` FOREIGN KEY (`nis`) REFERENCES `siswa_rizki` (`nis`);

--
-- Constraints for table `siswa_rizki`
--
ALTER TABLE `siswa_rizki`
  ADD CONSTRAINT `fk_id_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas_rizki` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
