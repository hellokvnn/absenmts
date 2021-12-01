-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 01:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` int(11) NOT NULL,
  `nik` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `start` time NOT NULL,
  `finish` time DEFAULT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id`, `nik`, `tanggal`, `start`, `finish`, `keterangan`) VALUES
(1, '3273132103710001', '2021-10-13', '07:01:06', '07:01:07', ''),
(2, '3273230608780005', '2021-10-13', '07:04:46', '07:04:48', ''),
(3, '3204051410680004', '2021-10-13', '16:11:42', '16:11:44', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nik` varchar(200) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `nama`, `nik`, `umur`, `alamat`, `telepon`, `jabatan`) VALUES
(1, 'Acep Budi Jatnika', '3273132103710001', 50, 'Jl. Nilem I, No 17, RT/RW 006/005, Kota Bandung', '082119855566', 'Marketing'),
(2, 'Ahmad Asrori', '3273250902760003', 45, 'Babakan Desa, RT/RW 001/001, Kota Bandung', '082317717414', 'Finance'),
(3, 'Dadan Moh. Hidayat', '3204051410680004', 53, 'Kp. Andir, RT/RW 001/016, Bandung', '081321345983', 'Marketing'),
(4, 'Helgy Sundara', '3273230608780005', 43, 'Kp. Lio, RT/RW 002/001, Kota Bandung', '081214920358', 'Marketing'),
(5, 'Ismayana Prasetya', '3273231707750003', 43, 'Jl, Taman Saturnus III, No 20, RT/RW 001/016, Kota Bandung', '082219323919', 'Marketing'),
(6, 'Joko Mulyono', '3211151505980006', 23, 'Dusun Cahayasari, RT/RW 005/009, Sumedang', '081214938803', 'Lapangan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, '3273132103710001', '41344ed9c8bc6d1303849cf50ec0c1b3', 'User'),
(3, '3273230608780005', 'aba062397900bdb955f8b4dd67bfa86b', 'User'),
(4, '3204051410680004', 'eecf0d359e6ed8021a4426debd5babce', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD CONSTRAINT `tb_absen_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_karyawan` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
