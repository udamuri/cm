-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2016 at 09:41 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `nestamenu`
--

CREATE TABLE `nestamenu` (
  `menu_id` int(3) NOT NULL,
  `menu_parent_id` int(3) DEFAULT NULL,
  `menu_sort` int(3) DEFAULT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nestamenu`
--

INSERT INTO `nestamenu` (`menu_id`, `menu_parent_id`, `menu_sort`, `menu_title`, `menu_link`, `menu_status`) VALUES
(1, 0, 1, 'Home', 'empty', 1),
(2, 0, 2, 'Perfectplaces', 'empty', 1),
(3, 2, 3, 'Lakerentals', 'empty', 1),
(4, 2, 4, 'Mountainskirentals', 'empty', 1),
(5, 0, 5, 'Redawning', 'empty', 1),
(6, 5, 6, 'Booking', 'empty', 1),
(7, 4, 7, 'Jakarta', 'empty', 1),
(8, 6, 8, 'Medan', 'empty', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nestamenu`
--
ALTER TABLE `nestamenu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nestamenu`
--
ALTER TABLE `nestamenu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
