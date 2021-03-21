-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2021 at 04:51 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `msg_from` varchar(7) NOT NULL,
  `msg_to` varchar(7) NOT NULL,
  `message` text NOT NULL,
  `sent_on` datetime NOT NULL DEFAULT current_timestamp(),
  `msg_read` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `patient_reading`
--

CREATE TABLE `patient_reading` (
  `patient_id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `readings` text NOT NULL,
  `fasting` varchar(15) NOT NULL,
  `reading_avg` int(3) NOT NULL,
  `pricked` int(3) NOT NULL,
  `action_taken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

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
