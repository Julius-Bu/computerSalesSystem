-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 05:30 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `havatech`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(100) NOT NULL DEFAULT 1,
  `category` varchar(100) NOT NULL DEFAULT 'Computer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`image_id`, `image_name`, `price`, `quantity`, `category`) VALUES
(29, 'olympus34.jpg', 0, 4, 'Others'),
(34, 'Dell_LE3350.jpg', 1300000, 4, 'Computer'),
(36, 'Latitude_E3380.jpg', 3000000, 1, 'Computer'),
(37, 'Inspiron_5537.jpg', 4000000, 15, 'Computer'),
(38, 'Dell_E7480.jpg', 500000, 50, 'Computer'),
(40, 'PS_Console.jpg', 800000, 4, 'Peripheral'),
(41, 'Portable_Bluetooth.jpg', 150000, 49, 'Peripheral'),
(51, 'Printer_Catrigdes.jpg', 300000, 49, 'Others'),
(54, 'Wired_mouse.jpg', 20000, 297, 'Peripheral'),
(58, 'Wireless spk.jpg', 400000, 100, 'Others'),
(63, 'HDD - 1TB.jpg', 500000, 3, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uName` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'normal',
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `uDate` date NOT NULL DEFAULT current_timestamp(),
  `uTime` time(6) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uName`, `gender`, `email`, `type`, `password`, `contact`, `city`, `address`, `uDate`, `uTime`) VALUES
(6, 'Julius', 'Male', 'buwembojulius3@gmail.com', 'normal', '1c1b6f758aa617a6cb82d4d9a8e39b12', '0750047518', 'Kmpl', 'home', '2021-12-06', '09:57:55.000000'),
(7, 'Violet', 'Female', 'bandeseviolet@havatech.com', 'admin', '62dd3fb39925b203272af43ccd5b80d2', '0750047518', 'Kampala', 'home', '2021-12-07', '09:57:55.000000'),
(8, 'Mike', 'Male', 'mike@havatech.com', 'normal', '1c1b6f758aa617a6cb82d4d9a8e39b12', '0750047518', 'Kmpl', 'home', '2021-12-15', '09:57:55.000000'),
(9, 'Buwembo', 'Male', 'buwembojulius3@havatech.com', 'normal', '1c1b6f758aa617a6cb82d4d9a8e39b12', '0750047518', 'Kampala', 'Kampala, Rubaga North, Namungoona 2', '2021-12-16', '09:57:55.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `iName` varchar(100) DEFAULT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Computer',
  `quantity` int(100) NOT NULL DEFAULT 0,
  `amount` int(100) NOT NULL DEFAULT 0,
  `status` enum('Added to cart','Confirmed') NOT NULL,
  `tDate` date NOT NULL DEFAULT current_timestamp(),
  `tTime` time(6) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `iName`, `category`, `quantity`, `amount`, `status`, `tDate`, `tTime`) VALUES
(171, 7, 31, 'sony_dslr', 'Others', 1, 800000, 'Confirmed', '2021-12-13', '02:45:34.000000'),
(172, 7, 30, 'sony_dslr', 'Others', 1, 350000, 'Confirmed', '2021-12-13', '02:45:34.000000'),
(173, 7, 29, 'olympus', 'Others', 1, 700000, 'Confirmed', '2021-12-13', '02:45:34.000000'),
(174, 9, 36, 'Latitude_E3380', 'Computer', 1, 3000000, 'Confirmed', '2021-12-14', '05:29:59.000000'),
(175, 9, 34, 'Dell_LE3350', 'Computer', 1, 1300000, 'Confirmed', '2021-12-14', '05:30:24.000000'),
(177, 7, 59, 'IMG-20211207-WA0083', 'Others', 1, 0, 'Confirmed', '2021-12-15', '02:00:34.000000'),
(181, 7, 51, 'Printer_Catrigdes', 'Others', 1, 300000, 'Confirmed', '2021-12-15', '02:25:34.000000'),
(182, 7, 37, 'Inspiron_5537', 'Computer', 1, 4000000, 'Confirmed', '2021-12-15', '04:40:34.000000'),
(183, 7, 37, 'Inspiron_5537', 'Computer', 1, 4000000, 'Confirmed', '2021-12-16', '05:55:34.000000'),
(184, 7, 37, 'Inspiron_5537', 'Computer', 1, 4000000, 'Confirmed', '2021-12-17', '02:45:34.000000'),
(187, 7, 54, 'Wired_mouse', 'Peripheral', 1, 20000, 'Confirmed', '2021-12-17', '02:45:34.000000'),
(189, 7, 37, 'Inspiron_5537', 'Computer', 1, 4000000, 'Confirmed', '2021-12-17', '02:45:34.000000'),
(191, 7, 54, 'Wired_mouse', 'Peripheral', 1, 20000, 'Confirmed', '2021-12-17', '02:50:45.000000'),
(192, 7, 40, 'PS_Console', 'Peripheral', 1, 800000, 'Confirmed', '2021-12-17', '03:09:02.000000'),
(193, 7, 36, 'Latitude_E3380', 'Computer', 1, 3000000, 'Confirmed', '2021-12-18', '05:01:11.000000'),
(194, 6, 37, 'Inspiron_5537', 'Computer', 1, 4000000, 'Confirmed', '2021-12-18', '05:02:41.000000'),
(196, 7, 54, 'Wired_mouse', 'Peripheral', 1, 20000, 'Confirmed', '2021-12-18', '06:39:58.000000'),
(198, 7, 36, 'Latitude_E3380', 'Computer', 1, 3000000, 'Confirmed', '2021-12-24', '04:29:35.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `iName` (`image_name`,`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
