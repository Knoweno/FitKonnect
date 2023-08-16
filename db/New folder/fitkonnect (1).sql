-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 03:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitkonnect`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckTrainerEmail` (IN `p_email` VARCHAR(255), OUT `p_exists` INT)   BEGIN
    SELECT COUNT(*) INTO p_exists FROM tbltrainers WHERE email = p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllUsers` ()   BEGIN
    SELECT * FROM tblusers;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTrainer` (IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    INSERT INTO tbltrainers (email, password) VALUES (p_email, p_password);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `availablesports`
--

CREATE TABLE `availablesports` (
  `sportsCode` int(11) NOT NULL,
  `sportsName` varchar(20) NOT NULL,
  `sportDescription` varchar(500) NOT NULL,
  `Price` double NOT NULL DEFAULT 0,
  `TrainerID` int(11) NOT NULL DEFAULT 1,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availablesports`
--

INSERT INTO `availablesports` (`sportsCode`, `sportsName`, `sportDescription`, `Price`, `TrainerID`, `dateCreated`) VALUES
(10, 'Basketball3', 'Play basketball and have fun!', 25.09, 124, '2023-08-13 07:26:50'),
(11, 'Basketball', 'Play basketball and have fun!', 25.09, 124, '2023-08-13 07:26:56'),
(12, 'Tennis', 'Play basketball and have fun!', 25.09, 124, '2023-08-13 07:27:08'),
(13, 'Rugby', 'Play basketball and have fun!', 1200, 124, '2023-08-13 07:27:40'),
(14, 'Soccer', 'Play basketball and have fun!', 1200, 124, '2023-08-13 07:27:56'),
(15, 'Soccer', 'Play basketball and have fun!', 1200, 124, '2023-08-13 07:38:24'),
(16, 'ujf', 'yutyrfgghjuytygfvbhjuytgf', 677, 124, '2023-08-13 07:40:08'),
(17, 'j', 'jjjjjjjnn', 77, 124, '2023-08-13 07:50:27'),
(18, 'Sport area', 'test sport is sweet for your health', 1200, 124, '2023-08-15 01:53:33'),
(19, 'karate', 'kakaka', 3400, 124, '2023-08-15 01:59:47'),
(20, 'kk23', 'minmmm', 3200, 124, '2023-08-15 02:00:30'),
(21, 'yhh', 'hdhdhdh', 44, 124, '2023-08-15 02:00:55'),
(22, 'm', 'mmn', 7, 131, '2023-08-15 02:23:35'),
(23, 'sp', 'sp', 200, 131, '2023-08-15 02:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbleducationlevel`
--

CREATE TABLE `tbleducationlevel` (
  `id` int(11) NOT NULL,
  `educationLevel` varchar(250) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleducationlevel`
--

INSERT INTO `tbleducationlevel` (`id`, `educationLevel`, `createdDate`, `createdBy`) VALUES
(1, 'Primary school', '2023-08-13 00:00:00', 1),
(2, 'Secondary school', '2023-08-13 00:00:00', 1),
(5, 'Artisan', '2023-08-13 00:00:00', 1),
(6, 'College Certificate', '2023-08-13 00:00:00', 1),
(7, 'College Diploma', '2023-08-13 00:00:00', 1),
(8, 'University Student', '2023-08-13 00:00:00', 1),
(9, 'Bachelor\'s Degree', '2023-08-13 00:00:00', 1),
(10, 'Masters', '2023-08-13 00:00:00', 1),
(11, 'Ph.D', '2023-08-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgender`
--

CREATE TABLE `tblgender` (
  `id` int(11) NOT NULL,
  `genderName` varchar(20) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgender`
--

INSERT INTO `tblgender` (`id`, `genderName`, `createdDate`, `createdBy`) VALUES
(1, 'Male', '2023-08-13 04:31:49', 1),
(2, 'Female', '2023-08-13 04:31:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltrainerdocs`
--

CREATE TABLE `tbltrainerdocs` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `id_path` varchar(100) NOT NULL,
  `license_cert_path` varchar(255) NOT NULL,
  `business_registration_cert_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltrainerdocs`
--

INSERT INTO `tbltrainerdocs` (`id`, `trainer_id`, `id_path`, `license_cert_path`, `business_registration_cert_path`, `created_at`, `updated_at`) VALUES
(5, 10010010, '../trainer_docs/10010010_Obiso_2023/id_64b2f3fe3b8459.72476383.pdf', '../trainer_docs/10010010_Obiso_2023/license_64b2f3fe3b8581.16683657.pdf', '../trainer_docs/10010010_Obiso_2023/business_64b2f3fe3b85b7.69074448.pdf', '2023-07-15 19:31:10', '2023-07-15 19:31:10'),
(6, 234567, '../trainer_docs/234567_Knowen_2023/id_64b2f4312072f3.13804915.pdf', '../trainer_docs/234567_Knowen_2023/license_64b2f431207434.79931362.pdf', '../trainer_docs/234567_Knowen_2023/business_64b2f431207467.72512290.pdf', '2023-07-15 19:32:01', '2023-07-15 19:32:01'),
(7, 900877, '../trainer_docs/900877_Knowen_2023/id_64b3022973f598.69820899.pdf', '../trainer_docs/900877_Knowen_2023/license_64b3022973f7f9.63286269.pdf', '../trainer_docs/900877_Knowen_2023/business_64b3022973f824.96794766.pdf', '2023-07-15 20:31:37', '2023-07-15 20:31:37'),
(9, 23232344, '../trainer_docs/23232344_sakayo_2023/id_64d71a81b3a043.05880717.pdf', '../trainer_docs/23232344_sakayo_2023/license_64d71a81b3a307.94719088.pdf', '../trainer_docs/23232344_sakayo_2023/business_64d71a81b3a330.71335385.pdf', '2023-08-12 05:37:05', '2023-08-12 05:37:05'),
(10, 232323448, '../trainer_docs/232323448_sakayo2_2023/id_64d8316e47f4f5.04910229.pdf', '../trainer_docs/232323448_sakayo2_2023/license_64d8316e47f5a3.84996811.pdf', '../trainer_docs/232323448_sakayo2_2023/business_64d8316e47f5c4.14273571.pdf', '2023-08-13 01:27:10', '2023-08-13 01:27:10'),
(11, 2323236, '../trainer_docs/2323236_sakayo_2023/id_64d83bf25f4e16.14655684.pdf', '../trainer_docs/2323236_sakayo_2023/license_64d83bf25f4f78.00380580.pdf', '../trainer_docs/2323236_sakayo_2023/business_64d83bf25f4f99.52431229.pdf', '2023-08-13 02:12:02', '2023-08-13 02:12:02'),
(12, 2147483647, '../trainer_docs/2323239000_sakayo_2023/id_64d83ca0bb1111.51405437.pdf', '../trainer_docs/2323239000_sakayo_2023/license_64d83ca0bb1206.28298285.pdf', '../trainer_docs/2323239000_sakayo_2023/business_64d83ca0bb1226.07230293.pdf', '2023-08-13 02:14:56', '2023-08-13 02:14:56'),
(14, 232323900, '../trainer_docs/232323900_sakayo_2023/id_64d83d1f24a4d1.93029536.pdf', '../trainer_docs/232323900_sakayo_2023/license_64d83d1f24a557.33311587.pdf', '../trainer_docs/232323900_sakayo_2023/business_64d83d1f24a575.02125673.pdf', '2023-08-13 02:17:03', '2023-08-13 02:17:03'),
(21, 237623234, '../trainer_docs/237623234_sakayo_2023/id_64d841798d4440.92146547.pdf', '../trainer_docs/237623234_sakayo_2023/license_64d841798d44c1.97897302.pdf', '../trainer_docs/237623234_sakayo_2023/business_64d841798d44e4.58212633.pdf', '2023-08-13 02:35:37', '2023-08-13 02:35:37'),
(25, 2, '../trainer_docs/002_Zacks_2023/id_64d84455a41e59.07168637.pdf', '../trainer_docs/002_Zacks_2023/license_64d84455a41ef0.96838262.pdf', '../trainer_docs/002_Zacks_2023/business_64d84455a41f14.36160510.pdf', '2023-08-13 02:47:49', '2023-08-13 02:47:49'),
(28, 232323442, '../trainer_docs/232323442_sakayo_2023/id_64d845c002d393.50409029.pdf', '../trainer_docs/232323442_sakayo_2023/license_64d845c002d424.96514607.pdf', '../trainer_docs/232323442_sakayo_2023/business_64d845c002d441.62383410.pdf', '2023-08-13 02:53:52', '2023-08-13 02:53:52'),
(29, 4556768, '../trainer_docs/4556768_Test3_2023/id_64dbe51a0750d2.99770874.pdf', '../trainer_docs/4556768_Test3_2023/license_64dbe51a075474.92817095.pdf', '../trainer_docs/4556768_Test3_2023/business_64dbe51a075490.80277150.pdf', '2023-08-15 20:50:34', '2023-08-15 20:50:34'),
(30, 90085776, '../trainer_docs/90085776_MYTRAINER_2023/id_64dbe57beb6493.06350659.pdf', '../trainer_docs/90085776_MYTRAINER_2023/license_64dbe57beb6562.88558285.pdf', '../trainer_docs/90085776_MYTRAINER_2023/business_64dbe57beb6589.99871091.pdf', '2023-08-15 20:52:11', '2023-08-15 20:52:11'),
(31, 898777, '../trainer_docs/898777_HHH_2023/id_64dbe605372982.68574693.pdf', '../trainer_docs/898777_HHH_2023/license_64dbe605372a29.76223561.pdf', '../trainer_docs/898777_HHH_2023/business_64dbe605372a48.76493104.pdf', '2023-08-15 20:54:29', '2023-08-15 20:54:29'),
(32, 77, '../trainer_docs/77_H_2023/id_64dbe61fddccc3.83390307.pdf', '../trainer_docs/77_H_2023/license_64dbe61fddcd41.22029951.pdf', '../trainer_docs/77_H_2023/business_64dbe61fddcd64.64531516.pdf', '2023-08-15 20:54:55', '2023-08-15 20:54:55'),
(33, 88878, '../trainer_docs/88878_zacks_2023/id_64dbeccd345511.60905754.pdf', '../trainer_docs/88878_zacks_2023/license_64dbeccd345698.50436154.pdf', '../trainer_docs/88878_zacks_2023/business_64dbeccd3456b3.53159077.pdf', '2023-08-15 21:23:25', '2023-08-15 21:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbltrainers`
--

CREATE TABLE `tbltrainers` (
  `id` int(11) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `educationLevel` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT current_timestamp(),
  `isProfileComplete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltrainers`
--

INSERT INTO `tbltrainers` (`id`, `email`, `firstName`, `lastName`, `phoneNumber`, `educationLevel`, `gender`, `dateOfBirth`, `password`, `dateCreated`, `isProfileComplete`) VALUES
(1, 'kk', NULL, NULL, NULL, '', NULL, NULL, NULL, '2023-07-09 21:00:00', 0),
(2, ':safeEmail', NULL, NULL, NULL, NULL, NULL, NULL, ':hashedPassword', '2023-07-09 21:00:00', 0),
(3, 'mmama@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '22ksmsmsmssnn', '2023-07-09 21:00:00', 0),
(6, 'knowen@insert.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$nW7vcG4KqJln97kSO6CMKuBQsbjTmuW66VDtgzHmfoXLhXqHMcFvW', '2023-07-12 21:00:00', 0),
(7, 'kk@ggm.cc', 'KK', NULL, NULL, NULL, NULL, NULL, 'LETMME', '2023-07-12 21:00:00', 0),
(8, 'kkKK@MGMN.VM', NULL, NULL, NULL, NULL, NULL, NULL, 'LELELE', '2023-07-13 09:42:13', 0),
(9, 'eknowen@gmail.com', 'ONLINE', 'DATA', '0722237689', NULL, NULL, NULL, '$2y$10$Ukt5rtx.HaQfjgFMeub2u.DgTx6281t0szR/OJ941H28V0VrFjxii', '2023-07-13 10:15:21', 0),
(124, 'obiso@obysoft.com', 'Johny', 'Matokeh', '0023456789', 'Bachelor\'s Degree', NULL, '1990-01-15', '$2y$10$QNM.cU3MlGi6CPG1Xx3diuBBAZ8GYquBersD5m7h5hAj26LIFgtba', '2023-07-13 10:25:30', 0),
(125, 'knowenemmanuel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fwB7mqxQdzx6KVLvv6YMd.H7Y3DSFmYBkx4Gx0BjnJwm8i7mnzN4y', '2023-07-13 10:40:08', 0),
(126, 'knkan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$/EZV8NsY2ydLJxyK0tKOreczyHvM3SnHXcg4EfR23NS7d8LXwXKlu', '2023-07-13 21:00:19', 0),
(127, 'eee@obiso.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$5YIrofXLQkMO2ZAj33MlxuStibXdCLpXbQjc1GVkZ2tyLPlAC1sDe', '2023-07-15 18:16:43', 0),
(128, 'oknowenemmanuel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$y/nIIevAdF2nptLXcA3aGOhy4qGY.zf0bXCRIC5JNoNkOfHeHrbwu', '2023-07-15 18:33:25', 0),
(129, 'obiso@obiso.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$JAORIoGFWDX714/bGLM5xOHildHbc5N2K/HsROEEwy2HlXOFMRnu6', '2023-07-15 23:09:35', 0),
(130, 'obiso1@obiso.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$VqxQytJs8.Xcr6XNDgya6Oc19jKB49orwWtHilXsrY9nhU5qJyswG', '2023-07-15 23:35:06', 0),
(131, 'sakayo@sakayo.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KxANKAllKtCtczkEfIzlPOGw5xSu8zJMf6Vofm2arWAgePRriBmcW', '2023-08-12 04:28:54', 0),
(132, 'sakayo@sakayo2.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$EMulOm4jRIVgtbg2zfu9eO4GB.bAq90diVKE/Zs/AEd71N5owakAO', '2023-08-12 06:02:53', 0),
(133, 'sakayo1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$LYJnO1kL9yeR9ZU5YlnQLeYtvKtp9fbB3JZoFyn/uAtsOr1OFsp8i', '2023-08-12 12:23:34', 0),
(134, 'sakayo3@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$l9H1H9rEWYSsNDkJ1wr.POWhWhMjGrmxtdJ4.h6bU2/GtnCmMPepy', '2023-08-12 12:40:10', 0),
(135, 'sakayo11@sakayo.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$jRnqHGpqLt3yA5Fo2pjTeOMDlq5Dg4tb.YK3h8BRPX01dBQ9YMnsK', '2023-08-12 13:12:07', 0),
(136, 'sakayo10@gmail.com', 'ombogi', 'mo', '0987654321', '9', '2', '1998-11-11', '$2y$10$KxANKAllKtCtczkEfIzlPOGw5xSu8zJMf6Vofm2arWAgePRriBmcW', '2023-08-12 22:01:11', 0),
(137, 'kk@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kx0vQZy8QIVn/WeYltpKY.ybl9L0CFmpKZtKrmwAPAaciJTQjaf0m', '2023-08-12 22:03:15', 0),
(138, 'kkk@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$dphaueVZ7pSBIy8.wpe6MOVUcBzFxluE4QhReaqLDqiPFxAZfjo0y', '2023-08-12 22:05:42', 0),
(139, 'kkk2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Azv5byE1K09CXaVEjn/0z.d9opL/vfPHjS/E12LVOH/AWpXDNuatW', '2023-08-12 22:07:07', 0),
(140, 'mm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WyRpBHavAlnfkYnpA6w67O/du6mXBzyBiLLdLOr6Hr2ztzFrCpDsK', '2023-08-12 22:12:11', 0),
(141, 'm23@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Go.nop55mkvZJhyVqtP9yO1M7lEzmrIapU6yvmwJPk3lvcujrie02', '2023-08-12 22:13:31', 0);

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
(4, 'JIMMY', 'WANJIGI G', '0187654321', 'knowenemmanuel12@gmail.com', '1900-11-10', '$2y$10$9.zHq0MiYGnYWKCu5Tb67uhclvmxJ0jKDmKT.rf3Ed8moFd7YZDDm', '2023-06-04 22:12:49.296058'),
(5, 'KNOWEN', 'OBISO', '0716668717', 'kn222owenemmanuel@gmail.com', '2000-06-12', '$2y$10$h8O2JAd35667J1qlOKd.nOVw0Tc.Qz90HooGHMBLl3CCeTvTqgFFO', '2023-06-04 22:50:02.708353'),
(6, 'KNOWEN', 'OBISO', '0712088791', 'knowenemmanuel111@gmail.com', '2011-12-25', '$2y$10$ZrzXJCudp0ir08jc70HxWezavTN6gQaF2Gh.oXcw9OijUZDs5LDjy', '2023-06-05 00:09:01.466887'),
(7, 'john', 'dow', '0809875431', 'sosin60564@lieboe.com', '2009-06-16', '$2y$10$LIV2z4T9.0GjCKf.pk8.7.Pw0R7Cp91f7X0aOPkeJydhJm2Myu0RC', '2023-06-06 12:05:24.851572'),
(8, 'KNOWEN', 'OBISO', '0712086357', 'obiiso@gmail.com', '2009-06-30', '$2y$10$nwRoXJtUUNJbYEHHM7YW/uqlLYuSlsBFeHWcyH2uKQb.JU1XkOcDO', '2023-06-07 00:13:03.952916'),
(10, 'sd', 'baraka', '4092836405', 'jja@gmail.com', '1994-01-01', '$2y$10$HxzCaEpcnddBPXQP4kjQUuMBb0OPuA/a4INktBOOlYxjtKyDanTv2', '2023-07-13 09:01:42.873682'),
(11, 'KNOWENe', 'OBISOe', '0775862839', 'knoewenemmanuel@gmail.com', '2017-04-18', '$2y$10$5QTQvWtfa4Qpl9OE2Cykm.AtuOGdo9Ic2LIXiH3qy3Ea9fLkQHBfC', '2023-07-13 09:07:51.726488'),
(13, 'Knowen22', 'Obiso Ken', '2238383737', 'blank2@blanck.com', '1996-06-30', '$2y$10$BzdpwX4b.QcdP7E.XLZUGuBsy5trlS/tSZELAocXaJgHaYIBgQALy', '2023-07-13 18:57:56.400049'),
(15, 'KNOWENFX', 'OBISOFXee', '0112088717', 'FXeknowen@gmail.com', '2017-04-18', '$2y$10$UT0jGIUVOYm8KHRNXxRumuVcAYhXs8OxUsPv4mB6JMc9uIYgmT0R6', '2023-07-14 20:45:02.443527'),
(16, 'John', 'Doe', '1234567890', 'johndoe@example.com', '1990-01-01', '$2y$10$6EPEG48GuxMGDxSbwaclkePfXmVQqISzHZD5IIkLD5FEd8qW7xNEO', '2023-07-14 23:36:27.512359'),
(18, 'John', 'Doe', '1334567890', 'johndoe@example2.com', '1990-01-01', '$2y$10$T.v0ueF8P2FYcgphvhGJ7ObR8/kqFru2Z/ShrQiobhmW/s4RTH/sC', '2023-07-14 23:47:22.927446'),
(19, 'John', 'Doe', '1034567890', 'johnd@oeexample2.com', '1994-01-01', '$2y$10$rwohwTRpty13H.YJHdW9T.KHHG5roJm6KwJ599KFwhbcVnduy4DBu', '2023-07-14 23:59:34.964901'),
(27, 'Makambo2', 'API2', '0809876778', 'makambo2@api2.com', '1998-11-11', '$2y$10$EAO3eZJOOB2HvPUJIfdv2uIBrNIFG52FIcERoSLYl0Qb4Ni7HX5wW', '2023-08-12 23:52:07.750782'),
(28, 'John1', 'Doe1', '0264567890', 'john.doe2@example.com', '1990-01-01', '$2y$10$P8gPfM/t.DdO7CuaNJPey.6WzSLAc7tmj/pw37Jq5T70AwchAqiyi', '2023-08-13 00:30:17.212344');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availablesports`
--
ALTER TABLE `availablesports`
  ADD PRIMARY KEY (`sportsCode`);

--
-- Indexes for table `tbleducationlevel`
--
ALTER TABLE `tbleducationlevel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgender`
--
ALTER TABLE `tblgender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltrainerdocs`
--
ALTER TABLE `tbltrainerdocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trainerId` (`trainer_id`);

--
-- Indexes for table `tbltrainers`
--
ALTER TABLE `tbltrainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `availablesports`
--
ALTER TABLE `availablesports`
  MODIFY `sportsCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbleducationlevel`
--
ALTER TABLE `tbleducationlevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblgender`
--
ALTER TABLE `tblgender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbltrainerdocs`
--
ALTER TABLE `tbltrainerdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbltrainers`
--
ALTER TABLE `tbltrainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
