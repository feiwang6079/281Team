-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2018 at 12:01 AM
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
  `building_name` varchar(50) NOT NULL,
  `building_address` varchar(50) DEFAULT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`, `building_address`, `latitude`, `longitude`, `time`) VALUES
(1, 'SJSU Engineering Building', '1 Washington Square, San Jose, CA 95112', '37.336451', '-121.880437', '2018-12-02 08:00:00'),
(2, 'Dr. Martin Luther King, Jr. Library', '150 E San Fernando St, San Jose, CA 95112', '37.335938', '-121.885309', '2018-12-01 08:00:00'),
(3, 'San Jose Museum of Art', ' 110 S Market St, San Jose, CA 95113', '37.334003', '-121.889091', '2018-12-02 05:11:25');

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
(19, 2, 15),
(20, 3, 16),
(21, 2, 17),
(22, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `floor_cluster_id` int(11) NOT NULL,
  `location` varchar(15) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`floor_cluster_id`, `location`, `status`, `time`) VALUES
(1, '1st floor', 'on', '2018-11-01 07:00:00'),
(2, '2nd floor', 'off', '2018-11-02 07:00:00'),
(3, '3rd floor', 'on', '2018-11-03 07:00:00'),
(4, '4th floor', 'off', '2018-11-04 07:00:00'),
(5, '5th floor', 'inactive', '2018-11-05 08:00:00'),
(6, '6th floor', 'off', '2018-12-03 22:49:06'),
(15, '3th floor', 'on', '2018-12-03 00:49:38'),
(16, '1th floor', 'on', '2018-12-03 00:51:57'),
(17, '4th floor', 'off', '2018-12-03 02:15:28');

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
(10, 15, 19),
(11, 15, 34),
(12, 15, 20),
(13, 17, 158),
(14, 5, 501),
(15, 16, 15);

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `node_id` int(11) NOT NULL,
  `location` varchar(20) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`node_id`, `location`, `status`, `time`) VALUES
(15, '101 room 1th floor', 'on', '2018-12-03 22:48:02'),
(19, '109room ', 'on', '2018-12-03 01:03:48'),
(20, '401 room', 'inactive', '2018-12-03 01:11:12'),
(34, '301 room', 'off', '2018-12-03 01:09:30'),
(101, '1st floor room 101', 'off', '2018-12-03 01:03:48'),
(102, '1st floor room 102', 'inactive', '2018-12-03 01:03:48'),
(103, '1st floor room 103', 'on', '2018-12-03 01:03:48'),
(104, '1st floor room 104', 'off', '2018-12-03 01:03:48'),
(105, '1st floor room 105', 'inactive', '2018-12-03 01:03:48'),
(106, '1st floor room 106', 'on', '2018-12-03 01:03:48'),
(158, '3th floor', 'on', '2018-12-03 02:15:52'),
(501, '5th floor ', 'on', '2018-12-03 20:00:54');

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
(15, 15, 137),
(12, 34, 12),
(1, 101, 1),
(2, 101, 2),
(3, 101, 3),
(4, 101, 4),
(5, 101, 5),
(14, 103, 21313),
(13, 158, 123);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `sensor_id` int(11) NOT NULL,
  `sensor_type` varchar(11) NOT NULL,
  `sensor_status` varchar(10) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`sensor_id`, `sensor_type`, `sensor_status`, `time`) VALUES
(1, 'light', 'on', '2018-11-01 07:00:00'),
(2, 'light', 'off', '2018-11-02 07:00:00'),
(3, 'light', 'inactive', '2018-11-03 07:00:00'),
(4, 'light', 'off', '2018-11-04 07:00:00'),
(5, 'light', 'inactive', '2018-11-05 08:00:00'),
(12, 'tempture', 'on', '2018-12-03 02:13:31'),
(123, 'light', 'off', '2018-12-03 02:16:18'),
(137, 'light', 'off', '2018-12-03 22:48:23'),
(21313, 'light', 'on', '2018-12-03 18:11:44');

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
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `building_floor`
--
ALTER TABLE `building_floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `floor_cluster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `floor_node`
--
ALTER TABLE `floor_node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `node_sensor`
--
ALTER TABLE `node_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21314;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
