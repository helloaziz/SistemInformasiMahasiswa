-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 01:35 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_universitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(27) NOT NULL,
  `npp` varchar(27) NOT NULL,
  `nama` varchar(27) NOT NULL,
  `jenis_kelamin` varchar(28) NOT NULL,
  `program_studi` varchar(27) NOT NULL,
  `foto` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `npp`, `nama`, `jenis_kelamin`, `program_studi`, `foto`) VALUES
(5, '0686.11.2000.192', 'SETYO BUDI M.Kom.', 'LAKI-LAKI', 'SISTEM INFORMASI', 'small_med_0686.11.2000.192.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(17) NOT NULL,
  `nim` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `program_studi` varchar(25) NOT NULL,
  `foto` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(17) NOT NULL,
  `nim` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `program_studi` varchar(25) NOT NULL,
  `foto` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jenis_kelamin`, `program_studi`, `foto`) VALUES
(7, 'a12.2019.06316', 'Muhammad Alwi Abdul Aziz', 'LAKI-LAKI', 'SISTEM INFORMASI', 'Foto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(17) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(5, 'Muhammad Alwi Abdul Aziz', '$2y$10$cNJ96fjVIY.6sKlYzu3uCeZDNYEan72F9aeu6dUquUUp5lCEA.JZy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(27) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
