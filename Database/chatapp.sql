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
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(8, 207396148, 676693097, 'hello....'),
(9, 676693097, 207396148, 'hi'),
(10, 189233613, 795191189, 'hello how are you?'),
(11, 615193120, 795191189, 'hello'),
(12, 1174649461, 1092727405, 'Hi '),
(13, 494856417, 1092727405, 'hi'),
(14, 494856417, 1092727405, 'can you please explain me what is java in simple terms?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(13, 615193120, 'pranav', 'gavde', 'pg@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '1708618411WhatsApp Image 2023-08-22 at 12.49.14.jpg', 'Offline now'),
(15, 1275551346, 'omkar ', 'hazare', 'omk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1708624787pdf password protector.png', 'Offline now'),
(17, 207396148, 'ajit', 'pawar', 'aju@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1708625266Screenshot (9).png', 'Offline now'),
(22, 676693097, 'aiwaz', 'nadaf', 'avi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1708626825Screenshot 2023-11-22 220927.png', 'Offline now'),
(24, 189233613, 'Shrinivas', 'Karad', 'karad@gmail.com', '123456', '1708630996Screenshot 2024-01-09 182257.png', 'Offline now'),
(25, 795191189, 'Ketan Jamdade', 'ketan_j32', 'ketan@gmail.com', '123456', '1711386901images (2).jpeg', 'Offline now'),
(26, 494856417, 'prithviraj', 'pr_123', 'prithvi@gmail.com', '123456', '1711902844images (2).jpeg', 'Offline now'),
(28, 1174649461, 'Sahil Patil', 'sahil234', 'sahil@gmail.com', '123456', '1713705199img1.jpg', 'Offline now'),
(29, 1092727405, 'john doe', 'john', 'abhay@gmail.com', '123456', '1713705644img1.jpg', 'Offline now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
