-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 04:51 AM
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
-- Table structure for table `pahiram_chat`
--

CREATE TABLE `pahiram_chat` (
  `chat_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `chat` varchar(500) NOT NULL,
  `image_location` varchar(255) NOT NULL,
  `chat_type` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pahiram_chat`
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
  `participant_id` int(11) NOT NULL,
  `participant_first_name` varchar(255) NOT NULL,
  `participant_last_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `rent_due` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `time_posted` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `tags` varchar(255) NOT NULL,
  `image_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pahiram_post`
--



-- --------------------------------------------------------

--
-- Table structure for table `pahiram_request`
--

CREATE TABLE `pahiram_request` (
  `request_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pahiram_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasabay_chat`
--

CREATE TABLE `pasabay_chat` (
  `chat_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `chat` varchar(255) NOT NULL,
  `image_location` varchar(255) NOT NULL,
  `chat_type` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasabay_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasabay_delivery`
--

CREATE TABLE `pasabay_delivery` (
  `delivery_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasabay_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasabay_post`
--

CREATE TABLE `pasabay_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `pasabay_request`
--

CREATE TABLE `pasabay_request` (
  `request_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasabay_request`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pahiram_chat`
--
ALTER TABLE `pahiram_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `participant_id` (`participant_id`);

--
-- Indexes for table `pahiram_request`
--
ALTER TABLE `pahiram_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pasabay_chat`
--
ALTER TABLE `pasabay_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pasabay_delivery`
--
ALTER TABLE `pasabay_delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `requestor_id` (`requestor_id`);

--
-- Indexes for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `pasabay_request`
--
ALTER TABLE `pasabay_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pahiram_chat`
--
ALTER TABLE `pahiram_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `pahiram_request`
--
ALTER TABLE `pahiram_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pasabay_chat`
--
ALTER TABLE `pasabay_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pasabay_delivery`
--
ALTER TABLE `pasabay_delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pasabay_request`
--
ALTER TABLE `pasabay_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pahiram_chat`
--
ALTER TABLE `pahiram_chat`
  ADD CONSTRAINT `pahiram_chat_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pahiram_post` (`post_id`),
  ADD CONSTRAINT `pahiram_chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pahiram_post`
--
ALTER TABLE `pahiram_post`
  ADD CONSTRAINT `pahiram_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pahiram_request`
--
ALTER TABLE `pahiram_request`
  ADD CONSTRAINT `pahiram_request_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pahiram_post` (`post_id`),
  ADD CONSTRAINT `pahiram_request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pasabay_chat`
--
ALTER TABLE `pasabay_chat`
  ADD CONSTRAINT `pasabay_chat_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pasabay_post` (`post_id`),
  ADD CONSTRAINT `pasabay_chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pasabay_delivery`
--
ALTER TABLE `pasabay_delivery`
  ADD CONSTRAINT `pasabay_delivery_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pasabay_post` (`post_id`),
  ADD CONSTRAINT `pasabay_delivery_ibfk_2` FOREIGN KEY (`requestor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pasabay_post`
--
ALTER TABLE `pasabay_post`
  ADD CONSTRAINT `pasabay_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pasabay_request`
--
ALTER TABLE `pasabay_request`
  ADD CONSTRAINT `pasabay_request_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pasabay_post` (`post_id`),
  ADD CONSTRAINT `pasabay_request_ibfk_2` FOREIGN KEY (`poster_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
