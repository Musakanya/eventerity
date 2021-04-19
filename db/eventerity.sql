-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 06:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventerity`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(25) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `street_address` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `post_code` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `event_description` varchar(150) NOT NULL,
  `tickets_available` int(11) DEFAULT NULL,
  `event_owner` varchar(100) DEFAULT NULL,
  `event_type` varchar(150) DEFAULT NULL,
  `participation_type` varchar(15) DEFAULT NULL,
  `bought` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_time`, `street_address`, `city`, `post_code`, `country`, `price`, `event_description`, `tickets_available`, `event_owner`, `event_type`, `participation_type`, `bought`) VALUES
(16, 'Octoberfest 2021', '2021-04-15', '21:00:00', 'Woodlands plot 3223', 'Lusaka', 10101, 'zambia', 500, 'Ready to dance? Come to this year\'s Octoberfest Live!', 500, 'musakanyakapoma@gmail.com', 'festival', 'on_site', NULL),
(17, 'Novemberfest 2021', '2021-04-14', '12:15:00', 'dfdsfds', 'Lusaka', 10101, 'zambia', 500, 'Novemberfest blah blah blah', 500, 'musakanyakapoma@gmail.com', 'festival', 'on_site', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`event_type`) VALUES
('conference'),
('festival'),
('seminar'),
('speaker_session'),
('workshop');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `user` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `event_id`, `order_date`, `user`) VALUES
(1, 17, '2021-04-15', 'sumi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `participation_type`
--

CREATE TABLE `participation_type` (
  `participation_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation_type`
--

INSERT INTO `participation_type` (`participation_type`) VALUES
('online'),
('on_site');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_no` varchar(30) DEFAULT NULL,
  `user_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `first_name`, `last_name`, `phone_no`, `user_type`) VALUES
('musakanyakapoma@gmail.com', '$2y$10$i9uE0Yz./NTwogl2jBmQOeuGJlLnIO8bPMyLAFeNGOF/ubNEelEfS', 'Musakanya', 'Kapoma', '', 'US'),
('sumi@gmail.com', '$2y$10$tNWS65ULdkueqMf0iF8KuOqaCdPaUa7kDXuszkbUJur.JTO4jTV8y', 'Sumi', 'M', '', 'US'),
('test@email.com', '$2y$10$dJboWm/U9v1DgndWBPjDKOMd6f0ZJ6iXnlUxmXD9fA0.acNKB0LdC', 'test', 'test', '', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `user_on_event`
--

CREATE TABLE `user_on_event` (
  `id` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_on_event`
--

INSERT INTO `user_on_event` (`id`, `email`, `event_id`) VALUES
(4, 'sumi@gmail.com', 17);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type` varchar(10) NOT NULL,
  `deescription` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type`, `deescription`) VALUES
('AD', 'Administrator'),
('US', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_name` (`event_name`),
  ADD KEY `owner` (`event_owner`),
  ADD KEY `event_type` (`event_type`),
  ADD KEY `participation_type` (`participation_type`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_type`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `participation_type`
--
ALTER TABLE `participation_type`
  ADD PRIMARY KEY (`participation_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_on_event`
--
ALTER TABLE `user_on_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `user_on_event`
--
ALTER TABLE `user_on_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_owner`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`event_type`) REFERENCES `event_type` (`event_type`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`participation_type`) REFERENCES `participation_type` (`participation_type`);

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `order_history_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`email`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`user_type`);

--
-- Constraints for table `user_on_event`
--
ALTER TABLE `user_on_event`
  ADD CONSTRAINT `user_on_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `user_on_event_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
