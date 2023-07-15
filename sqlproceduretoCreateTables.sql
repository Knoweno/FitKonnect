DELIMITER //

CREATE PROCEDURE executeSqlDump()
BEGIN
    SET @sql = "
        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        -- Host: localhost
        -- Generation Time: Jul 15, 2023 at 08:03 PM
        -- Server version: 10.4.28-MariaDB
        -- PHP Version: 8.0.28

        SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
        START TRANSACTION;
        SET time_zone = '+00:00';

        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;

        -- Database: `FitKonnect`

        -- Table structure for table `availableSports`
        DROP TABLE IF EXISTS `availableSports`;
        CREATE TABLE `availableSports` (
          `sportsCode` int(11) NOT NULL,
          `sportsName` varchar(20) NOT NULL,
          `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Dumping data for table `availableSports`
        INSERT INTO `availableSports` (`sportsCode`, `sportsName`, `dateCreated`) VALUES
        (1, 'Tennis', '2023-06-05 01:43:25'),
        (2, 'Karate', '2023-06-05 01:44:19'),
        (3, 'Football', '2023-06-05 01:45:32'),
        (4, 'Swimming', '2023-06-05 01:45:32'),
        (5, 'Rugby', '2023-06-05 01:45:32'),
        (6, 'Cricket', '2023-06-05 01:45:32'),
        (7, 'Horse Riding', '2023-06-05 02:10:49');

        -- Table structure for table `tbltrainerdocs`
        DROP TABLE IF EXISTS `tbltrainerdocs`;
        CREATE TABLE `tbltrainerdocs` (
          `id` int(11) NOT NULL,
          `trainer_id` int(11) NOT NULL,
          `id_path` varchar(100) NOT NULL,
          `license_cert_path` varchar(255) NOT NULL,
          `business_registration_cert_path` varchar(255) NOT NULL,
          `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Table structure for table `tbltrainers`
        DROP TABLE IF EXISTS `tbltrainers`;
        CREATE TABLE `tbltrainers` (
          `id` int(11) NOT NULL,
          `email` varchar(250) DEFAULT NULL,
          `firstName` varchar(20) DEFAULT NULL,
          `lastName` varchar(20) DEFAULT NULL,
          `phoneNumber` varchar(10) DEFAULT NULL,
          `educationLevel` varchar(20) DEFAULT NULL,
          `dateOfBirth` date DEFAULT NULL,
          `password` varchar(255) DEFAULT NULL,
          `dateCreated` timestamp NULL DEFAULT current_timestamp(),
          `isProfileComplete` tinyint(1) NOT NULL DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Dumping data for table `tbltrainers`
        INSERT INTO `tbltrainers` (`id`, `email`, `firstName`, `lastName`, `phoneNumber`, `educationLevel`, `dateOfBirth`, `password`, `dateCreated`, `isProfileComplete`) VALUES
        (1, 'kk', NULL, NULL, NULL, '', NULL, NULL, '2023-07-09 21:00:00', 0),
        (2, ':safeEmail', NULL, NULL, NULL, NULL, NULL, ':hashedPassword', '2023-07-09 21:00:00', 0),
        (3, 'mmama@gmail.com', NULL, NULL, NULL, NULL, NULL, '22ksmsmsmssnn', '2023-07-09 21:00:00', 0),
        (6, 'knowen@insert.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$nW7vcG4KqJln97kSO6CMKuBQsbjTmuW66VDtgzHmfoXLhXqHMcFvW', '2023-07-12 21:00:00', 0),
        (7, 'kk@ggm.cc', 'KK', NULL, NULL, NULL, NULL, 'LETMME', '2023-07-12 21:00:00', 0),
        (8, 'kkKK@MGMN.VM', NULL, NULL, NULL, NULL, NULL, 'LELELE', '2023-07-13 09:42:13', 0),
        (9, 'eknowen@gmail.com', 'ONLINE', 'DATA', '0722237689', NULL, NULL, '$2y$10$Ukt5rtx.HaQfjgFMeub2u.DgTx6281t0szR/OJ941H28V0VrFjxii', '2023-07-13 10:15:21', 0),
        (124, 'obiso@obysoft.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$QNM.cU3MlGi6CPG1Xx3diuBBAZ8GYquBersD5m7h5hAj26LIFgtba', '2023-07-13 10:25:30', 0),
        (125, 'knowenemmanuel@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$LcTOaJ56J72afgNl4PddYOdmlEN0QtFxgR8sHd19mS6UYbYmsIdw.', '2023-07-13 10:40:08', 0),
        (126, 'knkan@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$/EZV8NsY2ydLJxyK0tKOreczyHvM3SnHXcg4EfR23NS7d8LXwXKlu', '2023-07-13 21:00:19', 0);

        -- Table structure for table `tblusers`
        DROP TABLE IF EXISTS `tblusers`;
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

        -- Dumping data for table `tblusers`
        INSERT INTO `tblusers` (`id`, `firstName`, `lastName`, `phoneNumber`, `email`, `dateOfBirth`, `password`, `dateCreated`) VALUES
        (1, 'KNOWEN', 'OBISO', '0712088717', 'knowenemmanuel@gmail.com', '2023-06-04', '$2y$10$fwB7mqxQdzx6KVLvv6YMd.H7Y3DSFmYBkx4Gx0BjnJwm8i7mnzN4y', '2023-06-04 20:44:44.509928'),
        (3, 'KNOWEN', 'OBISO', '0715088717', 'knowenemmanuel34@gmail.com', '2023-06-05', '$2y$10$tzpXlE0kEEiSeIar7Vs.wuWlXPTReHnNaUHY.WGKb.hp8w5PpVWNq', '2023-06-04 21:48:12.570562'),
        (4, 'KNOWEN', 'OBISO', '0752088717', 'knowenemmanuel12@gmail.com', '2023-06-05', '$2y$10$9.zHq0MiYGnYWKCu5Tb67uhclvmxJ0jKDmKT.rf3Ed8moFd7YZDDm', '2023-06-04 22:12:49.296058'),
        (5, 'KNOWEN', 'OBISO', '0716668717', 'kn222owenemmanuel@gmail.com', '2000-06-12', '$2y$10$h8O2JAd35667J1qlOKd.nOVw0Tc.Qz90HooGHMBLl3CCeTvTqgFFO', '2023-06-04 22:50:02.708353'),
        (6, 'KNOWEN', 'OBISO', '0712088791', 'knowenemmanuel111@gmail.com', '2011-12-25', '$2y$10$ZrzXJCudp0ir08jc70HxWezavTN6gQaF2Gh.oXcw9OijUZDs5LDjy', '2023-06-05 00:09:01.466887'),
        (7, 'john', 'dow', '0809875431', 'sosin60564@lieboe.com', '2009-06-16', '$2y$10$LIV2z4T9.0GjCKf.pk8.7.Pw0R7Cp91f7X0aOPkeJydhJm2Myu0RC', '2023-06-06 12:05:24.851572'),
        (8, 'KNOWEN', 'OBISO', '0712086357', 'obiiso@gmail.com', '2009-06-30', '$2y$10$nwRoXJtUUNJbYEHHM7YW/uqlLYuSlsBFeHWcyH2uKQb.JU1XkOcDO', '2023-06-07 00:13:03.952916'),
        (9, 'JJJ', 'JJ', '0872088717', 'JJ@gmail.com', '1999-06-15', '$2y$10$grefdZvbYrzyl.LWeq/kGuZoi7TQyhbkjAxOgL5Lca6m6Rx6suFKy', '2023-07-09 23:09:45.284153'),
        (10, 'sd', 'baraka', '4092836405', 'jja@gmail.com', '1994-01-01', '$2y$10$HxzCaEpcnddBPXQP4kjQUuMBb0OPuA/a4INktBOOlYxjtKyDanTv2', '2023-07-13 09:01:42.873682'),
        (11, 'KNOWENe', 'OBISOe', '0775862839', 'knoewenemmanuel@gmail.com', '2017-04-18', '$2y$10$5QTQvWtfa4Qpl9OE2Cykm.AtuOGdo9Ic2LIXiH3qy3Ea9fLkQHBfC', '2023-07-13 09:07:51.726488'),
        (13, 'Knowen22', 'Obiso Ken', '2238383737', 'blank2@blanck.com', '1996-06-30', '$2y$10$BzdpwX4b.QcdP7E.XLZUGuBsy5trlS/tSZELAocXaJgHaYIBgQALy', '2023-07-13 18:57:56.400049'),
        (14, 'Mweni', 'fru', '0987665554', 'blanko@gga.cc', '1996-06-30', '$2y$10$cPNZKAWsR8Z8xFMb3Bhw7./70nwa1tUdoZBASMUgPsNENZM366Mku', '2023-07-13 19:12:40.783008'),
        (15, 'KNOWENFX', 'OBISOFXee', '0112088717', 'FXeknowen@gmail.com', '2017-04-18', '$2y$10$UT0jGIUVOYm8KHRNXxRumuVcAYhXs8OxUsPv4mB6JMc9uIYgmT0R6', '2023-07-14 20:45:02.443527'),
        (16, 'John', 'Doe', '1234567890', 'johndoe@example.com', '1990-01-01', '$2y$10$6EPEG48GuxMGDxSbwaclkePfXmVQqISzHZD5IIkLD5FEd8qW7xNEO', '2023-07-14 23:36:27.512359'),
        (18, 'John', 'Doe', '1334567890', 'johndoe@example2.com', '1990-01-01', '$2y$10$T.v0ueF8P2FYcgphvhGJ7ObR8/kqFru2Z/ShrQiobhmW/s4RTH/sC', '2023-07-14 23:47:22.927446'),
        (19, 'John', 'Doe', '1034567890', 'johnd@oeexample2.com', '1994-01-01', '$2y$10$rwohwTRpty13H.YJHdW9T.KHHG5roJm6KwJ599KFwhbcVnduy4DBu', '2023-07-14 23:59:34.964901'),
        (20, '', 'Doe', '4034567890', 'johnd@eoeexample2.com', '1994-01-01', '$2y$10$E9GSzr2ISssD7RAlbrW13unkQw5YaOjCGZvYGPRJWi20FRG4dhXwG', '2023-07-15 00:21:12.377548'),
        (22, '  ', 'Doe', '9876543210', 'johrnd@eoeexample2.com', '1994-01-01', '$2y$10$Dt6JF.9kgvmeLHrFjRpg6uU6ctW2OzZwTNEEsBUdwDzj.5.PPoAK.', '2023-07-15 00:28:46.758012'),
        (23, 'hh', 'Doe', '9976543210', 'jodhrnd@eoeexample2.com', '1994-01-01', '$2y$10$F7Xp3CO9Vp7tS5BoeDBpKO3TCF9Po.dFiNbpWCIYYfxt96Iv5D6Bu', '2023-07-15 00:32:18.899944'),
        (24, 'ggg', 'Doe', '9076543210', 'jodhrn@deoeexample2.com', '1994-01-01', '$2y$10$HmGpVNuGzYG4uzbo2uFICu.gzLHvCLkJYFAwjvtRuwpFCHlkrQwW6', '2023-07-15 01:10:30.779007');

        -- Indexes for dumped tables

        -- Indexes for table `availableSports`
        ALTER TABLE `availableSports`
          ADD PRIMARY KEY (`sportsCode`);

        -- Indexes for table `tbltrainerdocs`
        ALTER TABLE `tbltrainerdocs`
          ADD PRIMARY KEY (`id`),
          ADD UNIQUE KEY `trainerId` (`trainer_id`);

        -- Indexes for table `tbltrainers`
        ALTER TABLE `tbltrainers`
          ADD PRIMARY KEY (`id`),
          ADD UNIQUE KEY `email` (`email`);

        -- Indexes for table `tblusers`
        ALTER TABLE `tblusers`
          ADD PRIMARY KEY (`id`),
          ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
          ADD UNIQUE KEY `emailUnique` (`email`);

        -- AUTO_INCREMENT for dumped tables

        -- AUTO_INCREMENT for table `availableSports`
        ALTER TABLE `availableSports`
          MODIFY `sportsCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

        -- AUTO_INCREMENT for table `tbltrainerdocs`
        ALTER TABLE `tbltrainerdocs`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        -- AUTO_INCREMENT for table `tbltrainers`
        ALTER TABLE `tbltrainers`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

        -- AUTO_INCREMENT for table `tblusers`
        ALTER TABLE `tblusers`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
        ";

    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;
