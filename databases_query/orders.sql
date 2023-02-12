-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 07:55 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Tracking_No` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `Total_Price` float NOT NULL,
  `Payment_Mode` varchar(255) NOT NULL,
  `Payment_ID` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Comments` varchar(500) DEFAULT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `Tracking_No`, `User_ID`, `Name`, `Email`, `Phone`, `Address`, `Pincode`, `Total_Price`, `Payment_Mode`, `Payment_ID`, `Status`, `Comments`, `Created_At`, `Updated_At`) VALUES
(1, 'TrackNo2926123123123', 1, 'Admin Name', 'admin@gmail.com', '09123123123', '(Metro Manila), Building # 132, Daisy Street, Caloocan City, Barangay 123', 1211, 2799.99, 'COD', '', 0, NULL, '2023-02-04 19:10:20', '2023-02-04 19:30:24'),
(2, 'TrackNo9165123123123', 1, 'Admin Name', 'admin@gmail.com', '09123123123', '(Metro Manila), Building # 132, Daisy Street, Caloocan City, Barangay 123', 1211, 4826.94, 'COD', '', 0, NULL, '2023-02-06 14:30:14', '2023-02-06 14:30:14'),
(3, 'TrackNo2554123123123', 1, 'Admin Name', 'admin@gmail.com', '09123123123', '(Metro Manila), Building # 132, Daisy Street, Caloocan City, Barangay 123', 1211, 22.68, 'COD', '', 1, NULL, '2023-02-12 18:18:02', '2023-02-12 18:19:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
