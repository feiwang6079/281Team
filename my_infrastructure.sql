-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2018 at 08:27 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_infrastructure`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(30) NOT NULL,
  `building_address` varchar(50) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`, `building_address`, `time`) VALUES
(1, 'SJSU Engineering Building', '1 Washington Square, San Jose, CA 95112', '0000-00-00 00:00:00'),
(2, 'SJSU Clark Hall', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `building_floor`
--

CREATE TABLE `building_floor` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `floor_cluster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building_floor`
--

INSERT INTO `building_floor` (`id`, `building_id`, `floor_cluster_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(13, 1, 7),
(14, 1, 8),
(15, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `floor_cluster_id` int(11) NOT NULL,
  `location` varchar(15) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`floor_cluster_id`, `location`, `time`) VALUES
(1, '1st floor', '2018-11-01 07:00:00'),
(2, '2nd floor', '2018-11-02 07:00:00'),
(3, '3rd floor', '2018-11-03 07:00:00'),
(4, '4th floor', '2018-11-04 07:00:00'),
(5, '5th floor', '2018-11-05 08:00:00'),
(6, '6th floor', '2018-11-06 08:00:00'),
(7, '7th floor', '2018-11-20 01:36:16'),
(8, '8th floor', '2018-11-20 23:32:30'),
(9, '9th floor', '2018-11-20 23:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `floor_node`
--

CREATE TABLE `floor_node` (
  `id` int(11) NOT NULL,
  `floor_cluster_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor_node`
--

INSERT INTO `floor_node` (`id`, `floor_cluster_id`, `node_id`) VALUES
(1, 1, 101),
(2, 1, 102),
(3, 1, 103),
(4, 1, 104),
(5, 1, 105),
(6, 1, 106),
(9, 1, 107);

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `node_id` int(11) NOT NULL,
  `location` varchar(20) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`node_id`, `location`, `time`) VALUES
(101, '1st floor room 101', '2018-11-01 07:00:00.000000'),
(102, '1st floor room 102', '2018-11-02 07:00:00.000000'),
(103, '1st floor room 103', '2018-11-03 07:00:00.000000'),
(104, '1st floor room 104', '2018-11-04 07:00:00.000000'),
(105, '1st floor room 105', '2018-11-05 08:00:00.000000'),
(106, '1st floor room 106', '2018-11-06 08:00:00.000000'),
(107, '1st floor room 107', '2018-11-20 01:26:43.480781');

-- --------------------------------------------------------

--
-- Table structure for table `node_sensor`
--

CREATE TABLE `node_sensor` (
  `id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_sensor`
--

INSERT INTO `node_sensor` (`id`, `node_id`, `sensor_id`) VALUES
(1, 101, 1),
(2, 101, 2),
(3, 101, 3),
(4, 101, 4),
(5, 101, 5),
(6, 101, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `sensor_id` int(11) NOT NULL,
  `sensor_type` varchar(11) NOT NULL,
  `sensor_status` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`sensor_id`, `sensor_type`, `sensor_status`, `time`) VALUES
(1, 'light', 1, '2018-11-01 07:00:00'),
(2, 'light', 0, '2018-11-02 07:00:00'),
(3, 'light', 2, '2018-11-03 07:00:00'),
(4, 'light', 2, '2018-11-04 07:00:00'),
(5, 'light', 2, '2018-11-05 08:00:00'),
(6, 'light', 1, '2018-11-06 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `street`
--

CREATE TABLE `street` (
  `street_id` int(11) NOT NULL,
  `street_name` varchar(20) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `street_building`
--

CREATE TABLE `street_building` (
  `id` int(11) NOT NULL,
  `street_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `token` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_password`, `token`, `time`) VALUES
(1, 'admin', 'admin', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `building_floor`
--
ALTER TABLE `building_floor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `floor_cluster_id` (`floor_cluster_id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`floor_cluster_id`);

--
-- Indexes for table `floor_node`
--
ALTER TABLE `floor_node`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `node_id` (`node_id`);

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`node_id`);

--
-- Indexes for table `node_sensor`
--
ALTER TABLE `node_sensor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `node_id` (`node_id`,`sensor_id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`sensor_id`);

--
-- Indexes for table `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`street_id`);

--
-- Indexes for table `street_building`
--
ALTER TABLE `street_building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building_floor`
--
ALTER TABLE `building_floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `floor_node`
--
ALTER TABLE `floor_node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `node_sensor`
--
ALTER TABLE `node_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
