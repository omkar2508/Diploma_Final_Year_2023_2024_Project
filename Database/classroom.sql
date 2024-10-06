-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 07:34 PM
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
-- Database: `classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `owner`, `image`) VALUES
(9, 'Python', 'Domain Computers', 'images (3).jpeg'),
(13, 'PHP', 'GPKP', 'success.gif'),
(14, 'linux', 'GPKP', 'class.gif'),
(16, 'Technical Writing', 'GPN', 'go home2.JPG'),
(17, 'C Programming', 'GPP', 'go home2.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `c programming`
--

CREATE TABLE `c programming` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c programming`
--

INSERT INTO `c programming` (`id`, `message`, `unique_id`, `image`, `file`) VALUES
(1, 'hello welcome to this class', NULL, 'ask22.gif', ''),
(2, 'now we will start our session', NULL, '', ''),
(3, 'i will share you all a link', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `linux`
--

CREATE TABLE `linux` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linux`
--

INSERT INTO `linux` (`id`, `message`, `unique_id`, `image`, `file`) VALUES
(1, 'Linux ', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `php`
--

CREATE TABLE `php` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `python`
--

CREATE TABLE `python` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `python`
--

INSERT INTO `python` (`id`, `message`, `unique_id`, `image`, `file`) VALUES
(1, '', NULL, '', 0x6d6174657269616c2e706466),
(2, 'Hello Students Welcome...', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `technical writing`
--

CREATE TABLE `technical writing` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c programming`
--
ALTER TABLE `c programming`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- Indexes for table `linux`
--
ALTER TABLE `linux`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- Indexes for table `php`
--
ALTER TABLE `php`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- Indexes for table `python`
--
ALTER TABLE `python`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- Indexes for table `technical writing`
--
ALTER TABLE `technical writing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `c programming`
--
ALTER TABLE `c programming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `linux`
--
ALTER TABLE `linux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `php`
--
ALTER TABLE `php`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `python`
--
ALTER TABLE `python`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technical writing`
--
ALTER TABLE `technical writing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
