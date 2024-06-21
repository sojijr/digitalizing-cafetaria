-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2024 at 12:23 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteriamanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

DROP TABLE IF EXISTS `allergies`;
CREATE TABLE IF NOT EXISTS `allergies` (
  `AllergieID` int NOT NULL,
  `AllergieName` varchar(255) NOT NULL,
  PRIMARY KEY (`AllergieID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`AllergieID`, `AllergieName`) VALUES
(11, 'Milk'),
(12, 'Egg'),
(13, 'Peanut'),
(14, 'Wheat'),
(21, 'Rice and Gbadun'),
(22, 'Potato and Eggsauce'),
(23, 'Moi Moi'),
(24, 'Egusi Soup');

-- --------------------------------------------------------

--
-- Table structure for table `studentallergies`
--

DROP TABLE IF EXISTS `studentallergies`;
CREATE TABLE IF NOT EXISTS `studentallergies` (
  `StudentID` int NOT NULL,
  `AllergieID` int NOT NULL,
  KEY `AllergieID` (`AllergieID`),
  KEY `StudentID` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

DROP TABLE IF EXISTS `studentdetails`;
CREATE TABLE IF NOT EXISTS `studentdetails` (
  `StudentID` int NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(255) DEFAULT NULL,
  `StudentMatricNo` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `DigitalTicketNo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`StudentID`, `StudentName`, `StudentMatricNo`, `Password`, `DigitalTicketNo`) VALUES
(1, 'John Doe', '22/0000', 'e99a18c428cb38d5f260853678922e03', '22/0000'),
(2, 'Jane Smith', '22/0123', 'd8578edf8458ce06fbc5bb76a58c5ca4', '22/0123'),
(3, 'Mike Johnson', '22/9999', 'ea182ec42b98ccabcc3e097a5d7047d1', '22/9999'),
(4, 'Sarah Brown', '22/1111', '32cdf88be26a21da8fe748527e79bf02', '22/1111'),
(5, 'David Williams', '22/2222', '05b6053c41a2130afd6fc3b158bda4e6', '22/2222');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentallergies`
--
ALTER TABLE `studentallergies`
  ADD CONSTRAINT `studentallergies_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `studentdetails` (`StudentID`),
  ADD CONSTRAINT `studentallergies_ibfk_2` FOREIGN KEY (`AllergieID`) REFERENCES `allergies` (`AllergieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
