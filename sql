-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 08:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qldkhtt`
--

-- --------------------------------------------------------

--
-- Table structure for table `giao vien`
--

CREATE TABLE `giao vien` (
  `magv` int(20) NOT NULL,
  `tengv` varchar(20) NOT NULL,
  `sdt` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoc sinh`
--

CREATE TABLE `hoc sinh` (
  `mahs` int(20) NOT NULL,
  `tenhs` varchar(20) NOT NULL,
  `sdt` int(20) NOT NULL,
  `dc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mon hoc`
--

CREATE TABLE `mon hoc` (
  `mamh` int(20) NOT NULL,
  `tenmh` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giao vien`
--
ALTER TABLE `giao vien`
  ADD PRIMARY KEY (`magv`);

--
-- Indexes for table `hoc sinh`
--
ALTER TABLE `hoc sinh`
  ADD PRIMARY KEY (`mahs`);

--
-- Indexes for table `mon hoc`
--
ALTER TABLE `mon hoc`
  ADD PRIMARY KEY (`mamh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
