-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 02:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pahiream`
--

-- --------------------------------------------------------

--
-- Table structure for table `pahiram_post`
--

CREATE TABLE `pahiram_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `time_posted` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasabay_post`
--

CREATE TABLE `pasabay_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `time_posted` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image_location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasabay_post`
--

INSERT INTO `pasabay_post` (`post_id`, `user_id`, `first_name`, `last_name`, `type`, `points`, `location`, `rate`, `time_posted`, `delivery_time`, `date`, `tags`, `image_location`, `status`) VALUES
(1, 1, 'marvin', 'dalida', 'pasabay', 100, 'siven iliben', 10, '12-12-12', '10', 'date', '0', '0', 'deactivated'),
(2, 1, 'marvin', 'dalida', 'pasabay', 100, 'siven iliben', 10, '12-12-12', '10', 'date', '0', '0', 'deactivated'),
(3, 1, 'marvin', 'dalida', 'pasabay', 100, 'siven iliben', 10, '12-12-12', '10', 'date', 'architecture,tsquare', 'none', 'deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tup_id` varchar(255) NOT NULL,
  `image_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `points`, `user_type`, `status`, `tup_id`, `image_location`) VALUES
(1, 'marvin ray ', 'dalida', 'marvinray.dalida@tup.edu.ph', 'marvin', 0, 'user', 'active', 'tupm-19-1471', 'none'),
(2, '1', '1', '1', '', 1, '1', '1', '1', '1'),
(3, '2', '2', '2', '', 2, '2', '2', '2', '2'),
(4, '3', '3', '3', '', 3, '3', '3', '3', '3'),
(5, '1', '1', '1', '', 1, '1', '1', '1', '1'),
(6, '1', '1', '1', '', 1, '1', '1', '1', '1'),
(7, '1', '11', '11', '', 11, '11', '11', '11', '1'),
(8, '4', '4', '4', '', 4, '4', '4', '4', '4'),
(9, '5', '5', '5', '', 5, '5', '5', '5', '5'),
(10, '6', '6', '6', '', 6, '6', '6', '6', '6'),
(11, '1', '1', '1', '', 1, '1', '1', '1', '1'),
(12, '4', '4', '4', '', 4, '4', '4', '4', '4'),
(14, 'test', 'test', 'test', '', 0, 'test', 'test', 'test', 'test'),
(15, 'test', 'test', 'test', '', 0, 'test', 'test', 'test', 'test'),
(16, '32', '32', '3232', '', 32, '32', '323', '32', '32'),
(17, 'test', 'test', 'test', 'test', 0, '', '', 'test', ''),
(18, 'pangalan', 'apelyido', 'emeyl@emeyl', '123123', 0, '', '', 'numero', ''),
(19, 'amben', 'uchiha', 'amben@gmail.com', '123', 0, '', '', 'wawa', ''),
(20, 'testing1', 'testing1', 'testing1', 'testing1', 0, '', '', 'testing1', ''),
(21, 'testing123', 'testing123', 'testing123', 'testing123', 0, '', '', 'testing123', ''),
(22, 'testing123', 'testing123', 'testing123', 'testing123', 0, '', '', 'testing123', ''),
(26, 'marvin', 'marvin', 'marvinray.dalida@tup.edu.ph', '123', 0, '', '', '21', ''),
(27, 'marvin', 'marvin', 'marvinray.dalida@tup.edu.ph', '123', 0, '', '', '212', ''),
(28, 'marvin', 'marvin', 'marvinray.dalida@tup.edu.ph', '123', 0, '', '', '21233', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  ADD CONSTRAINT `pahiram_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  ADD CONSTRAINT `pasabay_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
