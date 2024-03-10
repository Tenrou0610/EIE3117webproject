-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 06:19 PM
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
-- Database: `pforumsignup`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profileimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`, `nickname`, `email`, `profileimage`) VALUES
(1, 'Carrie1', '$2y$10$0LiS1zOCU3J1umMR5YmI6.nr6eQLFb2GjOqkk9/PV6H/anPU/pRWq', 'Carrielam', 'Carrielam123@gmail.com', 'userimage/default.jpg'),
(8, 'Peterhui123', '$2y$10$hEeJaaiS8sv84d.hfqB0NOXOMOip7Vfw7aVRRY5/efYoZZt0YXJ7S', 'Peterhui', 'Peterhui123@gmail.com', 'userimage/default.jpg'),
(9, 'Audi1234', '$2y$10$wlFnLZyVHej2u1ZATsFnFupmAuKaBo0cnndWA25Hc3g0dBp.gm46C', 'Audi', 'Audi1234@gmail.com', 'userimage/default.jpg'),
(10, 'John123', '$2y$10$c.p0myOSTPNRz4W86SHIK.6jJaihHVZHZAMTLIZ1kjx9w8xWBgByy', 'John', 'John123@gmail.com', 'userimage/default.jpg'),
(11, 'Mary123', '$2y$10$TyzF4y5kulQ/iG4X2RweLOgaRACSlkHwSpRWYP1kZbtlkaq1Ld6kG', 'MaryLee', 'Mary123@gmail.com', 'userimage/default.jpg'),
(12, 'Henry123', '$2y$10$Avawf74DGwz5/x/U7YQmkud/Q0pJ5YuxWqqyHfmDenu4nqlxnl5Li', 'HenryHui', 'Henry123@gmail.com', 'userimage/default.jpg'),
(13, 'Faker123', '$2y$10$nrnXcdUwIxQ6087d3loHje6kkJ/73TNeqKjPZx7548yxfy36ZxTY2', 'Faker', 'Faker123@gmail.com', 'userimage/default.jpg'),
(14, 'kiin123', '$2y$10$ZkWt8SAmHBXANHDtxxEGK.1UavV0Goj7DlvQrN39.fMJZhaov9cc6', 'KiinLee', 'Kiin123@gmail.com', 'userimage/default.jpg'),
(15, 'Zeus123', '$2y$10$mWBVrA07CCp5xUM/AO0dHuFaBvgof.1fRgtTVUvmJvZeGfjzfx11S', 'Zeus', 'Zeus123@gmail.com', 'userimage/IMG-65ec3104244db3.22720391.png'),
(16, 'User123', '$2y$10$LHjAk3JzxstvnzL93.mNi.iuLzzbzmtVAwtOA3UBUA5ZfHNqaU2cm', 'User', 'User123@gmail.com', 'userimage/default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
