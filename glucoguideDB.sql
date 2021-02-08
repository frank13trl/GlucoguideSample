-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2021 at 04:16 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glucoguide`
--

-- --------------------------------------------------------

--
-- Table structure for table `casefile`
--

CREATE TABLE `casefile` (
  `patient_id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `doctor_id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `default_testcount` int(2) NOT NULL,
  `lower_normal` int(3) NOT NULL,
  `upper_normal` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casefile`
--

INSERT INTO `casefile` (`patient_id`, `doctor_id`, `default_testcount`, `lower_normal`, `upper_normal`) VALUES
('PA001', 'DO001', 5, 120, 180),
('PA002', 'DO001', 4, 100, 150),
('PA003', 'DO001', 5, 120, 180),
('PA004', 'DO002', 5, 120, 180),
('PA005', 'DO002', 5, 120, 180),
('PA006', 'DO002', 5, 120, 180),
('PA007', 'DO003', 5, 120, 180),
('PA008', 'DO003', 5, 120, 180),
('PA009', 'DO003', 5, 120, 180),
('PA010', 'DO003', 5, 120, 180);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_info`
--

CREATE TABLE `doctor_info` (
  `id` int(5) NOT NULL,
  `userid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(11) NOT NULL,
  `hospital` text NOT NULL,
  `city` text NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_info`
--

INSERT INTO `doctor_info` (`id`, `userid`, `name`, `email`, `phone`, `hospital`, `city`, `description`) VALUES
(1, 'DO001', 'Doctor 1', 'do1@doc.com', 1234567890, 'Doc1 Hosp', 'Doc1 city', 'Desc'),
(2, 'DO002', 'Doctor 2', 'do2@doc.com', 1234567890, 'Doc2 Hosp', 'Doc2 city', 'Doc2 hosp'),
(3, 'DO003', 'Doctor 3', 'do3@doc.com', 1234567890, 'Doc3 Hosp', 'Doc3 city', 'Doc3 desc'),
(4, 'DO010', 'Doctor 10', 'do10@doc.com', 1234567890, 'Doc10 Hosp', 'Doc10 city', 'Doc10 desc');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_settings`
--

CREATE TABLE `doctor_settings` (
  `doctor_id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `default_testcount` int(2) NOT NULL DEFAULT 5,
  `lower_normal` int(3) NOT NULL DEFAULT 120,
  `upper_normal` int(3) NOT NULL DEFAULT 180
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_settings`
--

INSERT INTO `doctor_settings` (`doctor_id`, `default_testcount`, `lower_normal`, `upper_normal`) VALUES
('DO001', 4, 120, 170),
('DO002', 5, 120, 180),
('DO003', 5, 120, 180),
('DO010', 5, 120, 180);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `userid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(20) NOT NULL,
  `category` text NOT NULL,
  `add_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `userid`, `password`, `category`, `add_datetime`) VALUES
(1, 'Doctor 1', 'DO001', '123456', 'Doctor', '2021-02-07 12:48:53'),
(2, 'Patient 1', 'PA001', '123456', 'Patient', '2021-02-07 12:50:10'),
(3, 'Doctor 2', 'DO002', '123456', 'Doctor', '2021-02-07 23:51:02'),
(4, 'Doctor 3', 'DO003', '123456', 'Doctor', '2021-02-08 00:12:21'),
(5, 'Patient 2', 'PA002', '123456', 'Patient', '2021-02-08 00:15:38'),
(6, 'Patient 3', 'PA003', '123456', 'Patient', '2021-02-08 00:17:46'),
(7, 'Patient 4', 'PA004', '123456', 'Patient', '2021-02-08 00:19:51'),
(8, 'Patient 5', 'PA005', '123456', 'Patient', '2021-02-08 00:20:52'),
(9, 'Patient 6', 'PA006', '123456', 'Patient', '2021-02-08 00:21:43'),
(10, 'Patient 7', 'PA007', '123456', 'Patient', '2021-02-08 00:23:12'),
(11, 'Patient 8', 'PA008', '123456', 'Patient', '2021-02-08 00:24:35'),
(12, 'Patient 9', 'PA009', '123456', 'Patient', '2021-02-08 00:26:13'),
(13, 'Doctor 10', 'DO010', '123456', 'Doctor', '2021-02-08 17:30:18'),
(14, 'Patient 10', 'PA010', '123456', 'Patient', '2021-02-08 17:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `id` int(5) NOT NULL,
  `userid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(11) NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`id`, `userid`, `name`, `email`, `phone`, `city`) VALUES
(1, 'PA001', 'Patient 1', 'pa1@pat.com', 1234567890, 'Pat1 city'),
(2, 'PA002', 'Patient 2', 'pa2@pat.com', 1234567890, 'Pat2 city'),
(3, 'PA003', 'Patient 3', 'pa3@pat.com', 1234567890, 'Pat3 city'),
(4, 'PA004', 'Patient 4', 'pa4@pat.com', 1234567890, 'Pat4 city'),
(5, 'PA005', 'Patient 5', 'pa5@pat.com', 1234567890, 'Pat5 city'),
(6, 'PA006', 'Patient 6', 'pa6@pat.com', 1234567890, 'Pat6 city'),
(7, 'PA007', 'Patient 7', 'pa7@pat.com', 1234567890, 'Pat7 city'),
(8, 'PA008', 'Patient 8', 'pa8@pat.com', 1234567890, 'Pat8 city'),
(9, 'PA009', 'Patient 9', 'pa9@pat.com', 1234567890, 'Pat9 city'),
(10, 'PA010', 'Patient 10', 'pa10@pat.com', 1234567890, 'Pat10 city');

-- --------------------------------------------------------

--
-- Table structure for table `patient_reading`
--

CREATE TABLE `patient_reading` (
  `patient_id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `readings` text NOT NULL,
  `reading_avg` int(3) NOT NULL,
  `pricked` int(3) NOT NULL,
  `action_taken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_reading`
--

INSERT INTO `patient_reading` (`patient_id`, `readings`, `reading_avg`, `pricked`, `action_taken`) VALUES
('PA001', '100,120,140,110,105', 115, 125, '2021-02-07 12:54:26'),
('PA001', '120,122,124,126,128', 124, 0, '2021-02-07 12:59:34'),
('PA001', '120,130,140,150,160', 140, 0, '2021-02-07 13:00:22'),
('PA001', '200,202,204,206,208', 204, 150, '2021-02-07 13:01:08'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:16:02'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:16:45'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:17:21'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:18:03'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:18:52'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:20:17'),
('PA001', '120 , 140 , 150 , 150 , 160', 144, 0, '2021-02-08 15:20:35'),
('PA002', '140 , 150 , 140 , 150 , 180', 152, 0, '2021-02-08 16:47:43'),
('PA003', '150 , 160 , 140 , 120 , 145', 143, 0, '2021-02-08 17:09:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casefile`
--
ALTER TABLE `casefile`
  ADD PRIMARY KEY (`patient_id`,`doctor_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_info`
--
ALTER TABLE `doctor_info`
  ADD PRIMARY KEY (`id`,`userid`) USING BTREE,
  ADD UNIQUE KEY `userid` (`userid`) USING BTREE;

--
-- Indexes for table `doctor_settings`
--
ALTER TABLE `doctor_settings`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`,`userid`),
  ADD UNIQUE KEY `userid` (`userid`) USING BTREE;

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`id`,`userid`) USING BTREE,
  ADD UNIQUE KEY `userid` (`userid`) USING BTREE;

--
-- Indexes for table `patient_reading`
--
ALTER TABLE `patient_reading`
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor_info`
--
ALTER TABLE `doctor_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `casefile`
--
ALTER TABLE `casefile`
  ADD CONSTRAINT `casefile_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_info` (`userid`),
  ADD CONSTRAINT `casefile_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_settings` (`doctor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor_info`
--
ALTER TABLE `doctor_info`
  ADD CONSTRAINT `doctor_info_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`);

--
-- Constraints for table `doctor_settings`
--
ALTER TABLE `doctor_settings`
  ADD CONSTRAINT `doctor_settings_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_info` (`userid`);

--
-- Constraints for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD CONSTRAINT `patient_info_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`);

--
-- Constraints for table `patient_reading`
--
ALTER TABLE `patient_reading`
  ADD CONSTRAINT `patient_reading_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `casefile` (`patient_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
