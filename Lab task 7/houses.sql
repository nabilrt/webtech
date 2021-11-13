-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 03:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houses`
--

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `Owner_ID` varchar(15) NOT NULL,
  `R_ID` varchar(15) NOT NULL,
  `N_ID` varchar(5) NOT NULL,
  `Notice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `NID` varchar(12) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`Name`, `Email`, `NID`, `Password`, `Gender`, `Image`) VALUES
('Abidur Rahman', 'nabilrt51@gmail.com', '1122334455', 'nabil@12345', 'Male', '../files/1184971.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `unapprovedads`
--

CREATE TABLE `unapprovedads` (
  `AD_ID` varchar(15) NOT NULL,
  `H_Owner_ID` varchar(15) NOT NULL,
  `AD_Rent` varchar(6) NOT NULL,
  `AD_Address` varchar(50) NOT NULL,
  `AD_Area` varchar(15) NOT NULL,
  `AD_des` varchar(100) NOT NULL,
  `Picture1` varchar(60) NOT NULL,
  `Picture2` varchar(60) NOT NULL,
  `Picture3` varchar(60) NOT NULL,
  `Displayable` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unapprovedads`
--

INSERT INTO `unapprovedads` (`AD_ID`, `H_Owner_ID`, `AD_Rent`, `AD_Address`, `AD_Area`, `AD_des`, `Picture1`, `Picture2`, `Picture3`, `Displayable`) VALUES
('111', '1122334455', '31000', 'Riyad', 'Arpita', 'Hello', '../files/cartoon-girl-dp-images-5.jpg', '../files/cartoon-girl-dp-images-6.jpg', '../files/cartoon-girl-limages-2.jpg', 'Yes'),
('711', '1122334455', '29000', '693,Begum Rokeya Road,Kharampotty', 'Badda', 'Big House', '../files/4.jpg', '../files/5.jpg', '../files/San-Siro-Stadium-Giuseppe-Meazza-ArchEyes-18.jpg', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`N_ID`(4));

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `unapprovedads`
--
ALTER TABLE `unapprovedads`
  ADD PRIMARY KEY (`AD_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
