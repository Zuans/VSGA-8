-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 07:27 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `regis`
--

CREATE TABLE `regis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `jurusan` varchar(12) NOT NULL,
  `jenis_kelamin` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regis`
--

INSERT INTO `regis` (`id`, `nama`, `password`, `nim`, `jurusan`, `jenis_kelamin`, `status`, `keterangan`) VALUES
(20, 'a[tpjw4pt', 'awj4t9pw34p9t', '0813675123', 'teknik-infor', 'pria', 'belum-menikah', 'ao4jtpwj4tjw4a9t'),
(21, 'a[tpjw4pt', 'gabus345', '0813675123', 'teknik-infor', 'pria', 'belum-menikah', 'ao4jtpwj4tjw4a9t'),
(22, 'John Doeaaojtop', 'gabus345', '0813675123', 'teknik-infor', 'wanita', 'belum-menikah', 'apie0iw0it0w-'),
(23, 'John Doe', 'gabus345', '0813675123', 'teknik-infor', 'wanita', 'belum-menikah', 'ajtpow3jpot3wojt'),
(24, 'Juan', 'gabus345', '221011402881', 'teknik-infor', 'pria', 'belum-menikah', 'a;gjjtoawpj4tw4at');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regis`
--
ALTER TABLE `regis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regis`
--
ALTER TABLE `regis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
