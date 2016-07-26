-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2016 at 03:36 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mfspotter`
--
CREATE DATABASE IF NOT EXISTS `mfspotter` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mfspotter`;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `facilityID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityName` varchar(50) NOT NULL,
  `telephoneNumber` text NOT NULL,
  `longhitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `address` varchar(40) NOT NULL,
  PRIMARY KEY (`facilityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityID`, `facilityName`, `telephoneNumber`, `longhitude`, `latitude`, `address`) VALUES
(1, 'Sample1', '(123) 456-7890', 125.68084716796875, 7.0702295954887475, 'Davao'),
(2, 'Sample1', '(456) 789-8765', 125.59879302978516, 7.062904226490174, 'asdad'),
(5, 'wawa', '(123) 456-7665', 125.61630249023438, 7.0651188851749716, 'Davao'),
(13, 'autoco', '(234) 576-5432', 125.58815002441406, 7.057282352971582, 'auto'),
(14, 'bonnga', '(123) 245-6543', 125.61922073364258, 7.067163176082755, 'Davao'),
(15, 'warwar', '(123) 456-7543', 125.62591552734375, 7.072444219068159, 'dav'),
(16, 'rerere', '(222) 222-2222', 125.62248229980469, 7.068355674936543, 'rererere'),
(22, 'asdsad', '(213) 424-3423', 125.61226844787598, 7.058730417833918, 'ada'),
(25, 'wawaw', '(234) 567-8987', 125.61887741088867, 7.068355674936543, 'wawawa'),
(26, 'POPO', '(000) 000-0000', 125.62162399291992, 7.067333533250265, 'POPOPOPO'),
(27, 'UYUYUY', '(000) 000-0000', 125.62076568603516, 7.060008118360919, 'UYUYUY'),
(28, 'TRTR', '(444) 444-4444', 125.63089370727539, 7.0496160517644455, 'TRTRTRTR'),
(29, 'QWQW', '(222) 222-2222', 125.6205940246582, 7.0697185270010126, 'QWQW'),
(30, 'wawawawa', '(243) 456-7867', 125.29220581054688, 6.98776992815563, 'wawawa');

-- --------------------------------------------------------

--
-- Table structure for table `facilityhasstaff`
--

CREATE TABLE IF NOT EXISTS `facilityhasstaff` (
  `facilityHasStaffID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  PRIMARY KEY (`facilityHasStaffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `facilityhasstaff`
--

INSERT INTO `facilityhasstaff` (`facilityHasStaffID`, `facilityID`, `userID`) VALUES
(1, 16, 1),
(2, 17, 2),
(3, 18, 3),
(4, 19, 4),
(5, 20, 5),
(6, 21, 6),
(7, 22, 7),
(8, 23, 8),
(9, 24, 9),
(10, 25, 10),
(11, 26, 11),
(12, 27, 12),
(13, 28, 13),
(14, 29, 14),
(15, 30, 15);

-- --------------------------------------------------------

--
-- Table structure for table `hasspecialization`
--

CREATE TABLE IF NOT EXISTS `hasspecialization` (
  `hasSpecializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specializationID` int(4) NOT NULL,
  `facilityID` int(4) NOT NULL,
  PRIMARY KEY (`hasSpecializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `hasspecialization`
--

INSERT INTO `hasspecialization` (`hasSpecializationID`, `specializationID`, `facilityID`) VALUES
(1, 0, 3),
(2, 0, 3),
(3, 0, 1),
(4, 0, 2),
(5, 29, 1),
(6, 29, 2),
(7, 1, 30),
(8, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE IF NOT EXISTS `insurances` (
  `insurancesID` int(4) NOT NULL AUTO_INCREMENT,
  `insuranceName` varchar(20) NOT NULL,
  PRIMARY KEY (`insurancesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`insurancesID`, `insuranceName`) VALUES
(1, 'MediCard'),
(2, 'IntelliCare'),
(3, 'MediCare');

-- --------------------------------------------------------

--
-- Table structure for table `insurancescovered`
--

CREATE TABLE IF NOT EXISTS `insurancescovered` (
  `insurancesCoveredID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `insuranceID` int(4) NOT NULL,
  PRIMARY KEY (`insurancesCoveredID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `insurancescovered`
--

INSERT INTO `insurancescovered` (`insurancesCoveredID`, `facilityID`, `insuranceID`) VALUES
(3, 13, 1),
(4, 14, 1),
(5, 14, 2),
(6, 14, 3),
(7, 16, 1),
(8, 16, 3),
(9, 25, 1),
(10, 25, 2),
(11, 26, 1),
(12, 26, 2),
(13, 27, 1),
(14, 27, 3),
(15, 28, 1),
(16, 28, 2),
(17, 29, 1),
(18, 29, 3),
(19, 30, 1),
(20, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `operatingperiod`
--

CREATE TABLE IF NOT EXISTS `operatingperiod` (
  `operatingperiodID` int(5) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `dayofweek` int(1) NOT NULL,
  `timeOpened` time NOT NULL,
  `timeClosed` time NOT NULL,
  PRIMARY KEY (`operatingperiodID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `operatingperiod`
--

INSERT INTO `operatingperiod` (`operatingperiodID`, `facilityID`, `dayofweek`, `timeOpened`, `timeClosed`) VALUES
(1, 25, 0, '12:45:00', '12:45:00'),
(2, 25, 1, '12:45:00', '12:45:00'),
(3, 25, 2, '12:45:00', '12:45:00'),
(4, 26, 0, '02:30:00', '14:45:00'),
(5, 26, 1, '02:30:00', '09:45:00'),
(6, 26, 2, '02:30:00', '09:45:00'),
(7, 26, 3, '02:30:00', '09:45:00'),
(8, 26, 4, '02:30:00', '09:45:00'),
(9, 26, 5, '02:30:00', '09:45:00'),
(10, 26, 6, '02:30:00', '09:45:00'),
(11, 27, 5, '12:45:00', '12:45:00'),
(12, 27, 6, '12:45:00', '12:45:00'),
(13, 28, 6, '01:00:00', '01:00:00'),
(14, 29, 0, '01:00:00', '01:00:00'),
(15, 29, 6, '01:00:00', '01:00:00'),
(16, 30, 0, '06:45:00', '06:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `specializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specialization` varchar(70) NOT NULL,
  PRIMARY KEY (`specializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specializationID`, `specialization`) VALUES
(1, 'Dentistry'),
(2, 'EENT');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(4) NOT NULL AUTO_INCREMENT,
  `userType` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `middleName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userType`, `username`, `password`, `firstName`, `middleName`, `lastName`) VALUES
(1, 'staff', 'rere', 'rere', 'rerere', 'rererer', 'rerere'),
(7, 'staff', 'dasdsad', 'usbw', 'asdsad', 'asdsad', 'asdsad'),
(8, 'staff', 'dsfsdf', 'fdsfsf', 'fsdfsdf', 'sdfsd', 'fsdfsdf'),
(9, 'staff', 'fsdfsd', 'fsdfsdf', 'dfsf', 'sfsdfsd', 'fsdfsdfsd'),
(10, 'staff', 'wawwaw', 'awwawa', 'wawaw', 'awawwa', 'wawaw'),
(11, 'staff', 'OPOPO', 'POPO', 'POPO', 'POPOPO', 'POPOPOP'),
(12, 'staff', 'YUYU', 'YUYUY', 'UYUYUY', 'UYUY', 'UYUYU'),
(13, 'staff', 'TRT', 'RTRTR', 'TRTR', 'RTR', 'TRTR'),
(14, 'staff', 'WQWQ', 'WQWQWQ', 'QWQW', 'QWQ', 'WQWQWQ'),
(15, 'staff', 'aawaw', 'wawwawawaw', 'wawawawa', 'waawawaw', 'waawawa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
