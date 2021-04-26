-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 04:44 PM
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
  `event_url` varchar(150) DEFAULT NULL,
  `tickets_available` int(11) DEFAULT NULL,
  `event_owner` varchar(100) DEFAULT NULL,
  `event_type` varchar(150) DEFAULT NULL,
  `participation_type` varchar(15) DEFAULT NULL,
  `bought` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_time`, `street_address`, `city`, `post_code`, `country`, `price`, `event_description`, `event_url`, `tickets_available`, `event_owner`, `event_type`, `participation_type`, `bought`) VALUES
(16, 'Octoberfest 2021', '2021-04-15', '21:00:00', 'Woodlands plot 3223', 'Lusaka', 10101, 'zambia', 500, 'Ready to dance? Come to this year\'s Octoberfest Live!', NULL, 499, 'musakanyakapoma@gmail.com', 'festival', 'on_site', 0),
(18, 'Westminster', '2021-04-23', '12:00:00', 'Chilanga', 'Lusaka', 10101, 'zambia', 0, 'Work out', NULL, 0, 'test@email.com', 'conference', 'on_site', 7);

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
  `order_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `user` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`order_id`, `event_id`, `order_date`, `user`) VALUES
(0, 18, '2021-04-19', 'sumi@gmail.com'),
(1, 18, '2021-04-19', 'sumi@gmail.com'),
(1001, 18, '2021-04-19', 'sumi@gmail.com'),
(1002, 18, '2021-04-19', 'sumi@gmail.com'),
(1003, 18, '2021-04-19', 'sumi@gmail.com'),
(1004, 18, '2021-04-19', 'sumi@gmail.com'),
(1005, 16, '2021-04-19', 'sumi@gmail.com'),
(1009, 18, '2021-04-19', 'sumi@gmail.com'),
(10000, 16, '2021-04-06', 'sumi@gmail.com'),
(40398, 18, '2021-04-19', 'sumi@gmail.com'),
(57192, 18, '2021-04-19', 'sumi@gmail.com'),
(22535, 18, '2021-04-19', 'sumi@gmail.com'),
(98467, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(20997, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(80543, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(46216, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(87964, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(80367, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(59229, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(11782, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(55667, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(35593, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(66093, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(49271, 18, '2021-04-19', 'musakanyakapoma@gmail.com'),
(23199, 18, '2021-04-21', 'musakanyakapoma@gmail.com'),
(64142, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(32893, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(51248, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(62570, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(50109, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(69641, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(80055, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(18467, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(88391, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(57738, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(57683, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(72924, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(11985, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(65900, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(53936, 18, '2021-04-22', 'musakanyakapoma@gmail.com'),
(84166, 18, '2021-04-23', 'musakanyakapoma@gmail.com'),
(59296, 18, '2021-04-23', 'musakanyakapoma@gmail.com'),
(55335, 18, '2021-04-23', 'musakanyakapoma@gmail.com'),
(33997, 18, '2021-04-23', 'musakanyakapoma@gmail.com'),
(66273, 18, '2021-04-23', 'musakanyakapoma@gmail.com'),
(63051, 18, '2021-04-23', 'musakanyakapoma@gmail.com');

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
('admin@eventerity.com', '$2y$10$adqzRRZZ1q5ZdJ08fcCf9ekw9ezQ4lEAl.drkStA6m3nlnuwRHdhe', 'Nchima', 'Kapoma', '096-585-7131', 'AD'),
('kapomamusa@gmail.com', '$2y$10$dixRWFIJTLG0k4bDoGfo/ONTlv/NcPz3vQ.ZKLfp0JN441zoqqt9C', 'Musa', 'Kapoma', '445-778-7744', 'US'),
('musakanyakapoma@gmail.com', '$2y$10$i9uE0Yz./NTwogl2jBmQOeuGJlLnIO8bPMyLAFeNGOF/ubNEelEfS', 'Musakanya', 'Kapoma', '778-777-6666', 'US'),
('sumi@gmail.com', '$2y$10$tNWS65ULdkueqMf0iF8KuOqaCdPaUa7kDXuszkbUJur.JTO4jTV8y', 'Sumi', 'M', '999-444-7441', 'US'),
('test@email.com', '$2y$10$dJboWm/U9v1DgndWBPjDKOMd6f0ZJ6iXnlUxmXD9fA0.acNKB0LdC', 'Thodor', 'Smith', '', 'US'),
('tsukki@gmail.com', '$2y$10$OeO2TeSqIxQq8W70CfSmbO4kqeIfGYC2V.oKhFedBY2RSs.AhuSNy', 'Kei', 'Tsukishima', '', 'US');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
