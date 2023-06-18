-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 02:42 AM
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
-- Database: `FitKonnect` 
--

-- --------------------------------------------------------

--
-- Table structure for table `availableSports`
--

CREATE TABLE `availableSports` (
  `sportsCode` int(11) NOT NULL,
  `sportsName` varchar(20) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availableSports`
--

INSERT INTO `availableSports` (`sportsCode`, `sportsName`, `dateCreated`) VALUES
(1, 'Tennis', '2023-06-05 01:43:25'),
(2, 'Karate', '2023-06-05 01:44:19'),
(3, 'Football', '2023-06-05 01:45:32'),
(4, 'Swimmig', '2023-06-05 01:45:32'),
(5, 'Rugby', '2023-06-05 01:45:32'),
(6, 'Crikcet', '2023-06-05 01:45:32'),
(7, 'Horse Riding', '2023-06-05 02:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `password` varchar(250) NOT NULL,
  `dateCreated` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstName`, `lastName`, `phoneNumber`, `email`, `dateOfBirth`, `password`, `dateCreated`) VALUES
(1, 'KNOWEN', 'OBISO', '0712088717', 'knowenemmanuel@gmail.com', '2023-06-04', '$2y$10$KgiA9diUmLwR1oSdDqY.Pu3TIL1APauRDck2U354NEjokKtKIShWu', '2023-06-04 20:44:44.509928'),
(2, 'KNOWEN', 'OBISO', '0722088717', 'knowenemmanuel2@gmail.com', '2023-06-05', '$2y$10$ZEqEVg/DpnUgSlfqtlnYRO3CjKVGgI9aa6Q9zYYnXRGb36q1LjW5.', '2023-06-04 21:05:48.342759'),
(3, 'KNOWEN', 'OBISO', '0715088717', 'knowenemmanuel34@gmail.com', '2023-06-05', '$2y$10$tzpXlE0kEEiSeIar7Vs.wuWlXPTReHnNaUHY.WGKb.hp8w5PpVWNq', '2023-06-04 21:48:12.570562'),
(4, 'KNOWEN', 'OBISO', '0752088717', 'knowenemmanuel12@gmail.com', '2023-06-05', '$2y$10$9.zHq0MiYGnYWKCu5Tb67uhclvmxJ0jKDmKT.rf3Ed8moFd7YZDDm', '2023-06-04 22:12:49.296058'),
(5, 'KNOWEN', 'OBISO', '0716668717', 'kn222owenemmanuel@gmail.com', '2000-06-12', '$2y$10$h8O2JAd35667J1qlOKd.nOVw0Tc.Qz90HooGHMBLl3CCeTvTqgFFO', '2023-06-04 22:50:02.708353'),
(6, 'KNOWEN', 'OBISO', '0712088791', 'knowenemmanuel111@gmail.com', '2011-12-25', '$2y$10$ZrzXJCudp0ir08jc70HxWezavTN6gQaF2Gh.oXcw9OijUZDs5LDjy', '2023-06-05 00:09:01.466887'),
(7, 'john', 'dow', '0809875431', 'sosin60564@lieboe.com', '2009-06-16', '$2y$10$LIV2z4T9.0GjCKf.pk8.7.Pw0R7Cp91f7X0aOPkeJydhJm2Myu0RC', '2023-06-06 12:05:24.851572'),
(8, 'KNOWEN', 'OBISO', '0712086357', 'obiiso@gmail.com', '2009-06-30', '$2y$10$nwRoXJtUUNJbYEHHM7YW/uqlLYuSlsBFeHWcyH2uKQb.JU1XkOcDO', '2023-06-07 00:13:03.952916');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availableSports`
--
ALTER TABLE `availableSports`
  ADD PRIMARY KEY (`sportsCode`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD UNIQUE KEY `emailUnique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availableSports`
--
ALTER TABLE `availableSports`
  MODIFY `sportsCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
