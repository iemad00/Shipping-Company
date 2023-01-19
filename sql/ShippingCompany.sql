-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2022 at 03:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ShippingCompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `locationType` varchar(50) NOT NULL,
  `retailCenterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `city`, `address`, `locationType`, `retailCenterID`) VALUES
(1, 'Riyadh ', 'Alsalam, area 1', 'Warehouse', 4),
(2, 'Dammam', 'KFUPM', 'Plane', 2),
(3, 'Tabuk', 'Alsalam', 'Truck', 1),
(5, 'tabuk', 'aaa', 'Truck', 1),
(8, 'awd', 'awd', 'Truck', 1),
(9, 'awd', 'awdd', 'Truck', 1),
(10, 'hello', 'awd', 'Truck', 1),
(11, 'adaw', 'awwaw', 'Truck', 1),
(12, 'wawd', 'dwa', 'Truck', 1),
(13, 'daw', 'daa', 'Truck', 1),
(14, 'awddd', 'wad', 'Truck', 1),
(15, 'aa', 'aa', 'Truck', 1),
(16, 'kkk', 'aaa', 'Warehouse', 1),
(17, 'awad', '2ad', 'Truck', 1),
(18, 'tabuk', 'alsalam', 'Truck', 1),
(19, 'awd', 'awd', 'Truck', 1),
(20, 'tabuk', 'alsalam', 'Truck', 1),
(21, 'daw', 'awdaw', 'Truck', 1),
(22, 'awdaw', 'wda', 'Truck', 1),
(23, 'dddaw', 'ddd', 'Truck', 1),
(24, 'awdaw', 'adwdaw', 'Truck', 1),
(25, 'awdaw', 'wadaw', 'Truck', 1),
(26, 'awd', 'awdaw', 'Truck', 1),
(27, 'awddaw', 'wadawd', 'Truck', 1),
(28, 'aaa', 'daw', 'Truck', 1),
(29, 'awd', 'dawd', 'Truck', 1),
(30, 'NY', 'NY street xyz', 'Plane', 5),
(43, 'NY', 'NY street 123 xxx', 'Plane', 1),
(44, 'Dubai', 'Khalefa A street', 'Plane', 1),
(45, 'Riyadh', 'Street 123 Area A', 'Plane', 1),
(46, 'Tabuk', 'Alulaya', 'Warehouse', 1),
(47, 'Tabuk', 'AlUlaya', 'Truck', 1),
(48, 'Riyadh', 'Street 1', 'Truck', 1),
(49, 'Dammam', 'Street 123', 'Plane', 1),
(50, 'Riyadh', 'wadawd', 'Warehouse', 1),
(51, 'Dhahran', 'adaw', 'Plane', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Package`
--

CREATE TABLE `Package` (
  `packageNb` int(11) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `width` double NOT NULL,
  `length` double NOT NULL,
  `destination` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `insuranceAmount` double NOT NULL,
  `paid` varchar(50) NOT NULL DEFAULT 'No',
  `finalDeliveryDate` date DEFAULT NULL,
  `packageType` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Package`
--

INSERT INTO `Package` (`packageNb`, `weight`, `height`, `width`, `length`, `destination`, `price`, `insuranceAmount`, `paid`, `finalDeliveryDate`, `packageType`, `userID`, `date`) VALUES
(5, 123, 1, 2, 2, 'NY', 1875, 93.75, 'No', NULL, 'Regular', 3, '2022-12-15 14:48:31'),
(8, 666, 3, 3, 12, 'Dammam m', 42, 4, 'Yes', NULL, 'Chemical', 1, '2022-12-15 19:16:47'),
(10, 666, 3, 3, 12, 'Dammam m', 42, 4, 'Yes', NULL, 'Regular', 1, '2022-12-15 16:02:08'),
(12, 666, 3, 3, 12, 'Dammam', 10020, 501, 'No', NULL, 'Fragile', 1, '2022-12-15 19:17:25'),
(13, 666, 3, 3, 12, 'Dammam', 42, 4, 'No', NULL, 'Regular', 1, '2022-12-15 18:49:22'),
(14, 666, 3, 3, 12, 'Dammam', 42, 4, 'Yes', NULL, 'Regular', 1, '2022-12-15 18:49:25'),
(15, 666, 3, 3, 12, 'Dammam', 42, 4, 'No', NULL, 'Regular', 1, '2022-12-15 18:49:27'),
(16, 666, 3, 3, 12, 'Dammam m', 42, 4, 'Yes', NULL, 'Regular', 1, '2022-12-15 20:13:46'),
(17, 666, 3, 3, 12, 'Dammam m', 42, 4, 'No', NULL, 'Chemical', 1, '2022-12-15 19:07:54'),
(18, 2222, 2, 3, 4, 'AdAd', 44, 5, 'Yes', NULL, 'Regular', 3, '2022-12-15 16:02:33'),
(19, 3, 2, 3, 4, 'Tabuk', 75, 3.75, 'No', NULL, 'Regular', 1, '2022-12-14 18:50:05'),
(20, 3, 2, 3, 4, 'Riyadh', 75, 3.75, 'No', NULL, 'Chemical', 3, '2022-12-14 21:45:29'),
(21, 3, 12, 32, 42, 'Dammam', 75, 3.75, 'No', NULL, 'Regular', 4, '2022-12-14 21:46:20'),
(23, 22, 3, 2, 1, 'Khobar', 360, 18, 'No', NULL, 'Fragile', 3, '2022-12-15 17:30:05'),
(24, 2, 3, 2, 3, 'Riyadh', 60, 3, 'No', NULL, 'Regular', 1, '2022-12-15 17:30:22'),
(25, 21, 1, 1, 1, 'Dammam', 345, 17.25, 'No', NULL, 'REGULAR', 3, '2022-12-15 21:40:48'),
(26, 2, 3, 4, 3, 'Riyadh', 60, 3, 'No', NULL, 'REGULAR', 8, '2022-12-15 23:36:24'),
(27, 23, 1, 2, 3, 'Riyadh', 375, 18.75, 'No', NULL, 'FRAGILE', 9, '2022-12-15 23:36:34'),
(28, 3, 4, 2, 1, 'Riyadh', 75, 3.75, 'No', NULL, 'CHEMICAL', 8, '2022-12-15 23:36:44'),
(29, 6, 3, 4, 5, 'Dhahran', 120, 6, 'No', NULL, 'REGULAR', 8, '2022-12-15 23:37:00'),
(30, 3, 3, 2, 4, 'Riyadh', 75, 3.75, 'No', NULL, 'LIQUID', 8, '2022-12-15 23:37:13'),
(31, 3, 44, 2, 3, 'Khobar', 75, 3.75, 'No', NULL, 'REGULAR', 1, '2022-12-16 12:56:54');

--
-- Triggers `Package`
--
DELIMITER $$
CREATE TRIGGER `tr_ins_pack` BEFORE INSERT ON `Package` FOR EACH ROW SET NEW.packageType = upper(new.packageType)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `retailCenter`
--

CREATE TABLE `retailCenter` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailCenter`
--

INSERT INTO `retailCenter` (`id`, `name`, `type`, `address`) VALUES
(1, 'retail center 1', 1, 'tabuk'),
(2, 'retail center 2', 1, 'Dammam'),
(3, 'retail center 3 ', 1, 'Jeddah'),
(4, 'retail center 4', 1, 'Riyadh'),
(5, 'retail center 5', 2, 'Riyadh');

-- --------------------------------------------------------

--
-- Table structure for table `transportationEvent`
--

CREATE TABLE `transportationEvent` (
  `scheduleNb` int(11) NOT NULL,
  `packageNb` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportationEvent`
--

INSERT INTO `transportationEvent` (`scheduleNb`, `packageNb`, `locationID`, `status`, `Date`) VALUES
(13, 5, 8, 'In Transit', '2022-12-14 18:26:08'),
(14, 5, 8, 'In Transit', '2022-12-14 18:28:28'),
(16, 19, 43, 'In Transit', '2022-12-14 18:50:48'),
(17, 19, 44, 'In Transit', '2022-12-14 18:51:11'),
(18, 19, 45, 'In Transit', '2022-12-14 18:51:57'),
(19, 19, 46, 'In Transit', '2022-12-14 18:52:34'),
(20, 19, 47, 'In Transit', '2022-12-14 18:52:53'),
(21, 19, 3, 'Delivered', '2022-12-14 18:53:16'),
(23, 8, 49, 'In Transit', '2022-12-14 21:48:57'),
(25, 15, 51, 'In Transit', '2022-12-16 00:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `Email`, `Phone`, `password`, `userType`) VALUES
(1, 'emad', 'emad@gmail.com', 542306039, '123', 'employee'),
(3, 'Khaled', 'khaled@hotmail.com', 555373032, '123', 'customer'),
(4, 'Mohammad', 'mohammad@hotmail.com', 534324543, '123', 'customer'),
(8, 'Faiz', 'fiaz@gmail.com', 555373037, '123', 'customer'),
(9, 'Ahmed', 'Ahmed@gmail.com', 555373737, '123', 'employee'),
(10, 'Yousif', 'Yousif@gmail.com', 55236237, '123', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retailCenterID` (`retailCenterID`);

--
-- Indexes for table `Package`
--
ALTER TABLE `Package`
  ADD PRIMARY KEY (`packageNb`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `retailCenter`
--
ALTER TABLE `retailCenter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportationEvent`
--
ALTER TABLE `transportationEvent`
  ADD PRIMARY KEY (`scheduleNb`),
  ADD KEY `locationID` (`locationID`),
  ADD KEY `packageID` (`packageNb`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `Package`
--
ALTER TABLE `Package`
  MODIFY `packageNb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `retailCenter`
--
ALTER TABLE `retailCenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transportationEvent`
--
ALTER TABLE `transportationEvent`
  MODIFY `scheduleNb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`retailCenterID`) REFERENCES `retailCenter` (`id`);

--
-- Constraints for table `Package`
--
ALTER TABLE `Package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transportationEvent`
--
ALTER TABLE `transportationEvent`
  ADD CONSTRAINT `transportationevent_ibfk_1` FOREIGN KEY (`packageNb`) REFERENCES `Package` (`packageNb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportationevent_ibfk_2` FOREIGN KEY (`locationID`) REFERENCES `location` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
