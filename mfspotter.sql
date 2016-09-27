-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 05:30 AM
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
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `calendarID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `startDate` varchar(50) NOT NULL,
  `endDate` varchar(50) NOT NULL,
  `allDay` varchar(5) NOT NULL,
  `userID` int(11) NOT NULL,
  `facilityID` int(11) NOT NULL,
  PRIMARY KEY (`calendarID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`calendarID`, `title`, `startDate`, `endDate`, `allDay`, `userID`, `facilityID`) VALUES
(1, 'Check up', '2016-09-22T09:00:00', '2016-09-22T10:00:00', 'false', 19, 40),
(2, 'Sex', '2016-09-15T00:00:00+05:30', '2016-09-15T00:00:00+05:30', 'false', 44, 25),
(4, 'New Event', '2016-08-31T00:00:00+05:30', '2016-08-31T00:00:00+05:30', 'false', 46, 3),
(5, 'New Event', '2016-08-30T00:00:00+05:30', '2016-08-30T00:00:00+05:30', 'false', 46, 3),
(6, 'Shet memeng', '2016-09-22', '2016-09-22', 'false', 23, 41),
(9, 'Derma', '2016-09-08T10:00:00', '2016-09-08T10:00:00', 'false', 47, 47),
(10, 'Palinis ng Paa', '2016-09-30T12:00:00', '2016-09-30T15:30:00', 'false', 27, 47);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(4) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(40) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Process'),
(2, 'Outcomes'),
(3, 'Structure'),
(4, 'Experience');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `facilityID` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `dateRated` datetime NOT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `facilityID`, `comment`, `dateRated`) VALUES
(1, 18, 25, '1', '2016-09-21 13:06:57'),
(2, 27, 25, '12', '2016-09-21 17:01:42'),
(3, 27, 25, '2', '2016-09-21 17:02:52'),
(4, 27, 25, '3', '2016-09-21 17:03:14'),
(5, 35, 13, 'ryd', '2016-09-22 13:23:57'),
(6, 19, 40, 'hello pig :)', '2016-09-22 13:31:05'),
(7, 44, 25, 'Ang Pangit', '2016-09-22 17:12:08'),
(8, 23, 39, 'wow ganda!', '2016-09-22 17:37:23'),
(9, 18, 28, 'fdf', '2016-09-22 17:44:26'),
(10, 47, 47, 'tating bading', '2016-09-22 18:13:15'),
(11, 40, 43, 'wag kayo dito', '2016-09-22 18:19:06'),
(12, 49, 48, 'best dental clinic.', '2016-09-22 19:00:36');

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
  `facilityPicture` varchar(30) NOT NULL,
  PRIMARY KEY (`facilityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityID`, `facilityName`, `telephoneNumber`, `longhitude`, `latitude`, `address`, `facilityPicture`) VALUES
(1, 'Sample1', '(123) 456-7890', 125.68084716796875, 7.0702295954887475, 'Davao', 'default'),
(2, 'Sample2', '(456) 789-8765', 125.4553409, 7.190708, 'asdad', 'default'),
(3, 'wawa', '(123) 456-7665', 125.61630249023438, 7.0651188851749716, 'Davao', 'default'),
(13, 'autoco', '(234) 576-5432', 125.58815002441406, 7.057282352971582, 'auto', 'default'),
(14, 'bonnga', '(123) 245-6543', 125.61922073364258, 7.067163176082755, 'Davao', 'default'),
(15, 'warwar', '(123) 456-7543', 125.62591552734375, 7.072444219068159, 'dav', 'default'),
(16, 'rerere', '(222) 222-2222', 125.62248229980469, 7.068355674936543, 'rererere', 'default'),
(22, 'asdsad', '(213) 424-3423', 125.61226844787598, 7.058730417833918, 'ada', 'default'),
(25, 'wawaw', '(234) 567-8987', 125.61887741088867, 7.068355674936543, 'wawawa', 'default'),
(26, 'POPO', '(000) 000-0000', 125.62162399291992, 7.067333533250265, 'POPOPOPO', 'default'),
(27, 'UYUYUY', '(000) 000-0000', 125.62076568603516, 7.060008118360919, 'UYUYUY', 'default'),
(28, 'Teeth and Ears', '(444) 444-4444', 125.63089370727539, 7.0496160517644455, 'TRTRTRTR', 'default'),
(29, 'QWQW', '(222) 222-2222', 125.6205940246582, 7.0697185270010126, 'QWQW', 'default'),
(30, 'wawawawa', '(243) 456-7867', 125.29220581054688, 6.98776992815563, 'wawawa', 'default'),
(31, 'wawa', '(435) 345-3453', 125.60274124145508, 7.061370995033533, 'wawawa', 'default'),
(32, 'opopo', '(678) 567-8546', 125.61063766479492, 7.054726933338916, 'popopo', 'default'),
(33, 'Martin', '(082) 300-1236', 125.61216115951538, 7.072188686120165, 'Ateneo Clinic', 'default'),
(39, 'Buta Clinic', '(082) 300-1234', 125.40687561035156, 7.181969589168454, 'Davao City', 'default'),
(40, 'Gmmadz', '(082) 305-6262', 125.44275283813477, 7.17600854128153, 'Davao City', 'default'),
(41, 'ELIZA YU FAMILY DENTISTRY', '(082) 224-5924', 125.61206728219986, 7.0722099805379095, 'Davao City', 'default'),
(42, 'Molar World Dental Clinic', '(082) 284-4557', 125.61146914958954, 7.071555176743535, 'unit 3 cva bldg cm recto st.davao city', 'default'),
(43, 'dasd', '(425) 858-5885', 125.57991027832031, 7.06528924309593, 'Davao City', 'default'),
(44, 'marie kristine f del rosario', '(093) 095-1442', 125.60671895742416, 7.0638811265204895, 'art center del rosario building', 'default'),
(45, 'maligad dental clinic', '(091) 823-1445', 125.60671761631966, 7.063910406871016, 'art center del rosario building', 'default'),
(46, 'Magallanes DOCTORS & Laboratory Inc.', '(082) 221-2599', 125.60673236846924, 7.063947672768994, 'Del Rosario Building, Magallanes Street', 'default'),
(47, 'Tating Reproduction Facility', '(232) 332-3232', 125.61201095581055, 7.071592442025045, 'art center del rosario building', 'default'),
(48, 'Tagskie Dental Clinic', '(082) 298-0446', 125.6191349029541, 7.064437452863348, 'Tagskie Street, Isda Ponciaco Fishery. D', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `facilityhasstaff`
--

CREATE TABLE IF NOT EXISTS `facilityhasstaff` (
  `facilityHasStaffID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  PRIMARY KEY (`facilityHasStaffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

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
(15, 30, 15),
(16, 31, 16),
(17, 32, 17),
(18, 33, 28),
(19, 34, 29),
(20, 35, 30),
(21, 36, 31),
(22, 37, 32),
(23, 38, 33),
(24, 39, 34),
(25, 40, 36),
(26, 41, 38),
(27, 42, 39),
(28, 43, 40),
(29, 44, 41),
(30, 45, 42),
(31, 46, 43),
(32, 47, 45),
(33, 48, 49);

-- --------------------------------------------------------

--
-- Table structure for table `hasspecialization`
--

CREATE TABLE IF NOT EXISTS `hasspecialization` (
  `hasSpecializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specializationID` int(4) NOT NULL,
  `facilityID` int(4) NOT NULL,
  PRIMARY KEY (`hasSpecializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `hasspecialization`
--

INSERT INTO `hasspecialization` (`hasSpecializationID`, `specializationID`, `facilityID`) VALUES
(1, 0, 3),
(2, 0, 3),
(3, 2, 28),
(4, 1, 28),
(5, 29, 1),
(6, 29, 2),
(7, 1, 30),
(8, 2, 30),
(9, 1, 31),
(10, 1, 32),
(11, 3, 33),
(12, 4, 33),
(13, 11, 34),
(14, 56, 34),
(15, 11, 35),
(16, 56, 35),
(17, 2, 36),
(18, 56, 36),
(19, 2, 37),
(20, 56, 37),
(21, 2, 38),
(22, 56, 38),
(23, 2, 39),
(24, 3, 39),
(25, 5, 39),
(26, 5, 40),
(27, 6, 40),
(28, 8, 40),
(29, 1, 41),
(30, 105, 42),
(31, 3, 43),
(32, 71, 44),
(33, 1, 45),
(34, 105, 45),
(35, 1, 46),
(36, 2, 46),
(37, 23, 46),
(38, 37, 46),
(39, 50, 46),
(40, 71, 46),
(41, 5, 47),
(42, 1, 48);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `insurancescovered`
--

INSERT INTO `insurancescovered` (`insurancesCoveredID`, `facilityID`, `insuranceID`) VALUES
(3, 1, 1),
(4, 2, 1),
(5, 3, 2),
(6, 14, 3),
(7, 14, 1),
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
(20, 30, 2),
(21, 31, 1),
(22, 31, 2),
(23, 32, 1),
(24, 32, 2),
(25, 33, 2),
(26, 33, 3),
(27, 34, 1),
(28, 34, 3),
(29, 35, 1),
(30, 35, 3),
(31, 36, 2),
(32, 37, 2),
(33, 38, 2),
(34, 39, 2),
(35, 43, 1),
(36, 47, 2),
(37, 48, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

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
(16, 30, 0, '06:45:00', '06:45:00'),
(17, 31, 1, '11:00:00', '11:00:00'),
(18, 32, 0, '11:00:00', '11:00:00'),
(19, 32, 3, '11:00:00', '11:00:00'),
(20, 33, 0, '12:00:00', '20:00:00'),
(21, 33, 1, '12:00:00', '20:00:00'),
(22, 33, 2, '12:00:00', '20:00:00'),
(23, 34, 1, '12:00:00', '22:00:00'),
(24, 34, 3, '12:00:00', '22:00:00'),
(25, 34, 5, '12:00:00', '22:00:00'),
(26, 34, 6, '12:00:00', '22:00:00'),
(27, 35, 1, '12:00:00', '22:00:00'),
(28, 35, 3, '12:00:00', '22:00:00'),
(29, 35, 5, '12:00:00', '22:00:00'),
(30, 35, 6, '12:00:00', '22:00:00'),
(31, 36, 1, '12:15:00', '20:15:00'),
(32, 36, 2, '12:15:00', '20:15:00'),
(33, 36, 3, '12:15:00', '20:15:00'),
(34, 37, 1, '12:15:00', '20:15:00'),
(35, 37, 2, '12:15:00', '20:15:00'),
(36, 37, 3, '12:15:00', '20:15:00'),
(37, 38, 1, '12:15:00', '20:15:00'),
(38, 38, 2, '12:15:00', '20:15:00'),
(39, 38, 3, '12:15:00', '20:15:00'),
(40, 39, 1, '12:45:00', '19:45:00'),
(41, 39, 3, '12:45:00', '19:45:00'),
(42, 39, 5, '12:45:00', '19:45:00'),
(43, 40, 1, '13:15:00', '18:15:00'),
(44, 40, 3, '13:15:00', '18:15:00'),
(45, 40, 5, '13:15:00', '18:15:00'),
(46, 41, 1, '09:00:00', '19:00:00'),
(47, 41, 2, '09:00:00', '19:00:00'),
(48, 41, 3, '09:00:00', '19:00:00'),
(49, 41, 4, '09:00:00', '19:00:00'),
(50, 41, 5, '09:00:00', '19:00:00'),
(51, 41, 6, '09:00:00', '19:00:00'),
(52, 42, 1, '09:00:00', '18:00:00'),
(53, 42, 2, '09:00:00', '18:00:00'),
(54, 42, 3, '09:00:00', '18:00:00'),
(55, 42, 4, '09:00:00', '18:00:00'),
(56, 42, 5, '09:00:00', '18:00:00'),
(57, 42, 6, '09:00:00', '18:00:00'),
(58, 43, 1, '16:00:00', '16:00:00'),
(59, 44, 1, '09:15:00', '17:00:00'),
(60, 44, 2, '09:15:00', '17:00:00'),
(61, 44, 3, '09:15:00', '17:00:00'),
(62, 44, 4, '09:15:00', '17:00:00'),
(63, 44, 5, '09:15:00', '17:00:00'),
(64, 44, 6, '09:15:00', '17:00:00'),
(65, 45, 1, '09:00:00', '17:00:00'),
(66, 45, 2, '09:00:00', '17:00:00'),
(67, 45, 3, '09:00:00', '17:00:00'),
(68, 45, 4, '09:00:00', '17:00:00'),
(69, 45, 5, '09:00:00', '17:00:00'),
(70, 45, 6, '09:00:00', '17:00:00'),
(71, 46, 1, '09:30:00', '17:00:00'),
(72, 46, 2, '09:30:00', '17:00:00'),
(73, 46, 3, '09:30:00', '17:00:00'),
(74, 46, 4, '09:30:00', '17:00:00'),
(75, 46, 5, '09:30:00', '17:00:00'),
(76, 46, 6, '09:30:00', '17:00:00'),
(77, 47, 0, '17:00:00', '17:00:00'),
(78, 48, 0, '10:45:00', '20:45:00'),
(79, 48, 6, '10:45:00', '20:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `ratingID` int(4) NOT NULL AUTO_INCREMENT,
  `userID` int(4) NOT NULL,
  `facilityID` int(4) NOT NULL,
  `categoryID` int(4) NOT NULL,
  `rating` int(2) NOT NULL,
  `dateRated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ratingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ratingID`, `userID`, `facilityID`, `categoryID`, `rating`, `dateRated`) VALUES
(25, 1, 1, 1, 5, '2016-08-29 16:43:20'),
(26, 1, 1, 2, 5, '2016-08-29 16:43:16'),
(27, 1, 1, 3, 3, '2016-08-25 02:34:28'),
(28, 1, 1, 4, 4, '2016-08-25 02:34:28'),
(29, 1, 2, 1, 1, '2016-08-25 02:36:52'),
(30, 1, 2, 2, 2, '2016-08-25 02:36:56'),
(31, 1, 2, 3, 3, '2016-08-25 02:36:59'),
(32, 1, 2, 4, 4, '2016-08-25 02:37:03'),
(33, 1, 3, 1, 5, '2016-08-25 02:38:13'),
(34, 1, 3, 2, 5, '2016-08-25 02:38:13'),
(35, 1, 3, 3, 5, '2016-08-25 02:38:13'),
(36, 1, 3, 4, 5, '2016-08-25 02:38:13'),
(40, 1, 3, 1, 1, '2016-08-25 04:07:01'),
(41, 1, 3, 2, 1, '2016-08-25 04:07:01'),
(42, 1, 3, 3, 1, '2016-08-25 04:07:01'),
(43, 1, 3, 4, 1, '2016-08-25 04:07:01'),
(44, 1, 3, 1, 1, '2016-08-25 04:29:00'),
(45, 1, 3, 2, 1, '2016-08-25 04:29:00'),
(46, 1, 3, 3, 1, '2016-08-25 04:29:00'),
(47, 1, 3, 4, 1, '2016-08-25 04:29:00'),
(48, 1, 28, 1, 4, '2016-09-04 08:04:29'),
(49, 1, 28, 2, 3, '2016-09-04 08:04:32'),
(50, 1, 28, 3, 5, '2016-09-04 08:04:34'),
(51, 1, 28, 4, 3, '2016-09-04 08:04:36'),
(64, 1, 3, 1, 0, '2016-09-14 16:03:23'),
(65, 1, 3, 2, 0, '2016-09-14 16:03:23'),
(66, 1, 3, 3, 0, '2016-09-14 16:03:23'),
(67, 1, 3, 4, 0, '2016-09-14 16:03:23'),
(68, 1, 0, 1, 0, '2016-09-14 16:04:47'),
(69, 1, 0, 2, 0, '2016-09-14 16:04:47'),
(70, 1, 0, 3, 0, '2016-09-14 16:04:47'),
(71, 1, 0, 4, 0, '2016-09-14 16:04:47'),
(72, 1, 32, 1, 0, '2016-09-14 16:05:24'),
(73, 1, 32, 2, 0, '2016-09-14 16:05:24'),
(74, 1, 32, 3, 0, '2016-09-14 16:05:24'),
(75, 1, 32, 4, 0, '2016-09-14 16:05:24'),
(76, 1, 32, 1, 1, '2016-09-14 16:05:40'),
(77, 1, 32, 2, 1, '2016-09-14 16:05:40'),
(78, 1, 32, 3, 1, '2016-09-14 16:05:40'),
(79, 1, 32, 4, 1, '2016-09-14 16:05:40'),
(80, 1, 32, 1, 5, '2016-09-14 16:06:25'),
(81, 1, 32, 2, 5, '2016-09-14 16:06:25'),
(82, 1, 32, 3, 5, '2016-09-14 16:06:25'),
(83, 1, 32, 4, 5, '2016-09-14 16:06:25'),
(84, 1, 32, 1, 0, '2016-09-14 16:07:12'),
(85, 1, 32, 2, 0, '2016-09-14 16:07:12'),
(86, 1, 32, 3, 0, '2016-09-14 16:07:12'),
(87, 1, 32, 4, 0, '2016-09-14 16:07:12'),
(88, 18, 25, 1, 1, '2016-09-27 04:12:46'),
(89, 18, 25, 2, 1, '2016-09-27 04:12:46'),
(90, 18, 25, 3, 1, '2016-09-27 04:12:46'),
(91, 18, 25, 4, 2, '2016-09-27 04:12:46'),
(92, 27, 25, 1, 0, '2016-09-21 09:01:42'),
(93, 27, 25, 2, 0, '2016-09-21 09:01:42'),
(94, 27, 25, 3, 0, '2016-09-21 09:01:42'),
(95, 27, 25, 4, 0, '2016-09-21 09:01:42'),
(96, 18, 38, 1, 4, '2016-09-22 04:24:46'),
(97, 18, 38, 2, 5, '2016-09-22 04:24:46'),
(98, 18, 38, 3, 4, '2016-09-22 04:24:46'),
(99, 18, 38, 4, 4, '2016-09-22 04:24:46'),
(104, 34, 39, 1, 3, '2016-09-22 05:17:48'),
(105, 34, 39, 2, 5, '2016-09-22 05:17:48'),
(106, 34, 39, 3, 3, '2016-09-22 05:17:48'),
(107, 34, 39, 4, 3, '2016-09-22 05:17:48'),
(108, 35, 13, 1, 5, '2016-09-22 05:23:47'),
(109, 35, 13, 2, 3, '2016-09-22 05:23:47'),
(110, 35, 13, 3, 3, '2016-09-22 05:23:47'),
(111, 35, 13, 4, 3, '2016-09-22 05:23:47'),
(112, 19, 40, 1, 4, '2016-09-22 05:30:17'),
(113, 19, 40, 2, 1, '2016-09-22 05:30:17'),
(114, 19, 40, 3, 1, '2016-09-22 05:30:17'),
(115, 19, 40, 4, 5, '2016-09-22 05:30:17'),
(116, 37, 41, 1, 4, '2016-09-22 06:53:55'),
(117, 37, 41, 2, 4, '2016-09-22 06:53:55'),
(118, 37, 41, 3, 4, '2016-09-22 06:53:55'),
(119, 37, 41, 4, 5, '2016-09-22 06:53:55'),
(120, 39, 42, 1, 3, '2016-09-22 07:18:40'),
(121, 39, 42, 2, 4, '2016-09-22 07:18:40'),
(122, 39, 42, 3, 3, '2016-09-22 07:18:40'),
(123, 39, 42, 4, 4, '2016-09-22 07:18:40'),
(124, 42, 45, 1, 3, '2016-09-22 08:22:00'),
(125, 42, 45, 2, 4, '2016-09-22 08:22:00'),
(126, 42, 45, 3, 4, '2016-09-22 08:22:00'),
(127, 42, 45, 4, 4, '2016-09-22 08:22:00'),
(128, 18, 45, 1, 1, '2016-09-27 04:57:26'),
(129, 18, 45, 2, 5, '2016-09-27 04:57:26'),
(130, 18, 45, 3, 1, '2016-09-27 04:57:26'),
(131, 18, 45, 4, 5, '2016-09-27 04:57:26'),
(132, 44, 25, 1, 1, '2016-09-22 09:12:38'),
(133, 44, 25, 2, 5, '2016-09-22 09:12:38'),
(134, 44, 25, 3, 5, '2016-09-22 09:12:38'),
(135, 44, 25, 4, 5, '2016-09-22 09:12:38'),
(136, 23, 41, 1, 2, '2016-09-22 09:31:54'),
(137, 23, 41, 2, 3, '2016-09-22 09:31:54'),
(138, 23, 41, 3, 1, '2016-09-22 09:31:54'),
(139, 23, 41, 4, 2, '2016-09-22 09:31:54'),
(140, 23, 39, 1, 5, '2016-09-22 09:37:14'),
(141, 23, 39, 2, 5, '2016-09-22 09:37:14'),
(142, 23, 39, 3, 5, '2016-09-22 09:37:14'),
(143, 23, 39, 4, 5, '2016-09-22 09:37:14'),
(144, 18, 28, 1, 4, '2016-09-27 04:56:59'),
(145, 18, 28, 2, 3, '2016-09-27 04:56:59'),
(146, 18, 28, 3, 2, '2016-09-27 04:56:59'),
(147, 18, 28, 4, 3, '2016-09-27 04:56:59'),
(148, 47, 47, 1, 1, '2016-09-22 10:12:48'),
(149, 47, 47, 2, 1, '2016-09-22 10:12:48'),
(150, 47, 47, 3, 1, '2016-09-22 10:12:48'),
(151, 47, 47, 4, 1, '2016-09-22 10:12:48'),
(152, 50, 28, 1, 4, '2016-09-22 15:06:57'),
(153, 50, 28, 2, 4, '2016-09-22 15:06:57'),
(154, 50, 28, 3, 3, '2016-09-22 15:06:57'),
(155, 50, 28, 4, 3, '2016-09-22 15:06:57'),
(156, 51, 46, 1, 3, '2016-09-22 15:20:15'),
(157, 51, 46, 2, 3, '2016-09-22 15:20:15'),
(158, 51, 46, 3, 4, '2016-09-22 15:20:15'),
(159, 51, 46, 4, 5, '2016-09-22 15:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE IF NOT EXISTS `remark` (
  `remarkID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`remarkID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`remarkID`, `userID`, `commentID`, `remarks`) VALUES
(1, 18, 1, 'Dislike'),
(2, 35, 5, 'Dislike'),
(3, 19, 6, 'Dislike'),
(4, 44, 4, 'Like'),
(5, 44, 7, 'Dislike'),
(6, 23, 8, 'Like'),
(7, 18, 9, 'Like'),
(8, 47, 10, 'Dislike'),
(9, 49, 12, 'Like');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `specializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specialization` varchar(70) NOT NULL,
  PRIMARY KEY (`specializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specializationID`, `specialization`) VALUES
(1, 'Dentistry'),
(2, 'EENT'),
(3, 'Allergy and Immunology'),
(4, 'Anesthesiology'),
(5, 'Cardiology'),
(6, 'Cardiovascular Anesthesia'),
(7, 'Cardiovascular Pathology'),
(8, 'Cataract and Refractive Surgery'),
(9, 'Child Neurology'),
(10, 'Colon and Rectal Surgery'),
(11, 'Cornea'),
(12, 'Cosmetic & Reconstructive Surgery'),
(13, 'Cosmetic Surgery'),
(14, 'Dermatology'),
(15, 'Developmental and Behavioral Pediatrics'),
(16, 'Diabetology'),
(17, 'EENT'),
(18, 'Emergency Medicine'),
(19, 'Endocrinology'),
(20, 'Endoscopy and Laparoscopy'),
(21, 'ENT (Otolaryngology)'),
(22, 'Epidemiology'),
(23, 'Family Medicine'),
(24, 'Foot and Ankle Orthopedic'),
(25, 'Gastroenterology'),
(26, 'General Practice'),
(27, 'Geriatrics'),
(28, 'Glaucoma'),
(29, 'Hand Surgery'),
(30, 'Head & Neck Surgery'),
(31, 'Hematology'),
(32, 'Hematology-Oncology'),
(33, 'Hepatology'),
(34, 'Hip & Knee'),
(35, 'Ilizarov Specialist'),
(36, 'Infectious Diseases'),
(37, 'Internal Medicine'),
(38, 'Interventional Radiology'),
(39, 'Laparoscopy'),
(40, 'Medico Legal Medicine'),
(41, 'Muscoskeletal Tumor'),
(42, 'Neonatology'),
(43, 'Nephrology'),
(44, 'Neuro-Ophthalmology'),
(45, 'Neurology'),
(46, 'Neurosurgery'),
(47, 'Nuclear Medicine'),
(48, 'OB Ultrasound'),
(49, 'Obstetric Anesthesia'),
(50, 'Obstetrics & Gynecology'),
(51, 'Occupational Medicine'),
(52, 'Ocular Inflammation'),
(53, 'Oncology'),
(54, 'Oncology & Colposcopy'),
(55, 'Ophthalmic Plastic & Reconstructive Surgery'),
(56, 'Ophthalmology'),
(57, 'Orthopedic Surgery'),
(58, 'Pain Medicine'),
(59, 'Pathology'),
(60, 'Pediatric Cardiology'),
(61, 'Pediatric Endocrinology'),
(62, 'Pediatric Gastroenterology'),
(63, 'Pediatric Infectious Disease'),
(64, 'Pediatric Intensivist'),
(65, 'Pediatric Nephrology'),
(66, 'Pediatric Oncology'),
(67, 'Pediatric Ophthalmology & Strabismus'),
(68, 'Pediatric Orthopedic'),
(69, 'Pediatric Pulmonology'),
(70, 'Pediatric Surgery'),
(71, 'Pediatrics'),
(72, 'Perinatology'),
(73, 'Pharmacology'),
(74, 'Physical Medicine and Rehabilitation'),
(75, 'Plastic and Reconstructive Surgery'),
(76, 'Psychiatry'),
(77, 'Public Health'),
(78, 'Pulmonology'),
(79, 'Radiation Oncology'),
(80, 'Radiology'),
(81, 'Rehabilitation Medicine'),
(82, 'Reproductive Endocrinology and Infertility'),
(83, 'Rheumatology'),
(84, 'Shoulder'),
(85, 'Spine'),
(86, 'Sports Medicine'),
(87, 'Surgery'),
(88, 'Surgical Oncology'),
(89, 'Thoracic Cardiovascular Surgery'),
(90, 'Toxicology'),
(91, 'Transplant Surgery'),
(92, 'Trophoblastic'),
(93, 'Ultrasonography'),
(94, 'Urology'),
(95, 'Vascular Surgery'),
(96, 'Venereology'),
(97, 'Vitreo-Retina'),
(98, 'Cosmetic Dentistry'),
(99, 'Dental Surgery'),
(100, 'Endodontics'),
(101, 'General Dentistry'),
(102, 'Hospital Dentistry'),
(103, 'Implant Dentistry'),
(104, 'Oral Surgery'),
(105, 'Orthodontics'),
(106, 'Pediatric Dentistry'),
(107, 'Periodontics'),
(108, 'Prosthodontics'),
(109, 'Clinical Psychology');

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
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userType`, `username`, `password`, `firstName`, `middleName`, `lastName`, `picture`) VALUES
(1, 'staff', 'rere', 'rere', 'rerere', 'rererer', 'rerere', 'default'),
(7, 'staff', 'dasdsad', 'usbw', 'asdsad', 'asdsad', 'asdsad', 'default'),
(8, 'staff', 'dsfsdf', 'fdsfsf', 'fsdfsdf', 'sdfsd', 'fsdfsdf', 'default'),
(9, 'staff', 'fsdfsd', 'fsdfsdf', 'dfsf', 'sfsdfsd', 'fsdfsdfsd', 'default'),
(10, 'staff', 'wawwaw', 'awwawa', 'wawaw', 'awawwa', 'wawaw', 'default'),
(11, 'staff', 'OPOPO', 'POPO', 'POPO', 'POPOPO', 'POPOPOP', 'default'),
(12, 'staff', 'YUYU', 'YUYUY', 'UYUYUY', 'UYUY', 'UYUYU', 'default'),
(13, 'staff', 'TRT', 'RTRTR', 'TRTR', 'RTR', 'TRTR', 'default'),
(14, 'staff', 'WQWQ', 'WQWQWQ', 'QWQW', 'QWQ', 'WQWQWQ', 'default'),
(15, 'staff', 'aawaw', 'wawwawawaw', 'wawawawa', 'waawawaw', 'waawawa', 'default'),
(16, 'staff', 'awawaw', 'waawaw', 'wawa', 'wawaaw', 'waawaw', 'default'),
(17, 'staff', 'popopop', 'popo', 'opopo', 'popo', 'popop', 'default'),
(18, 'User', 'joan', 'joan', 'Joahnne', 'Perez', 'Filosopo', 'joan'),
(19, 'User', 'gems', 'gems', 'Gerald ', 'Conanan', 'Madarang', 'gems'),
(20, 'User', 'buta', 'buta', 'Dan', 'Buta', 'Vicente', 'buta'),
(21, 'User', 'tats', 'tats', 'Miguelito', 'Magat', 'Tating', 'tats'),
(22, 'User', 'bae', 'bae', 'Damrey', 'Terec', 'Rizon', 'dam'),
(23, 'User', 'dan', 'dan', 'Dan Angelo', 'Buta', 'Vicente', 'dan'),
(27, 'User', 'tags', 'tags', 'John Neil', 'Balboa', 'Tagudin', 'default'),
(28, 'staff', 'gmmadz', 'gmmadz', 'Martin', 'Conanan', 'Madz', 'default'),
(34, 'staff', 'butaclinic', 'pig', 'Angelo', 'Buta', 'Vicente', 'default'),
(35, 'User', 'samoy', 'samoy', 'Samoy', 'Balang', 'Macacua', 'default'),
(36, 'staff', 'gmmadzClinic', 'madz', 'gmmadz', 'Conanan', 'Madarang', 'default'),
(37, 'User', 'YU Dental Center', '1234', 'ELIZA ', 'QUIROG', 'YU', 'default'),
(38, 'staff', 'nathalie29', 'natnat29', 'Nathalie', 'Amora', 'Quicoy', 'default'),
(39, 'staff', 'molarworld', '2844557', 'Genibie', 'Rellon', 'Genibie', 'default'),
(40, 'staff', '11', '11', 'trial1', '1', '2', 'default'),
(41, 'staff', 'jiana', 'jiana', 'jessa ', 'delos santos', 'baylosis', 'default'),
(42, 'staff', 'sweetrose', 'sweetie', 'Sweet Rose', 'Albaran', 'Rillo', 'default'),
(43, 'staff', 'nimfa', '0330', 'Nimfa', 'Mayol', 'Tech', 'default'),
(44, 'User', 'SynerGenix', 'migspogi', 'Migz', 'Magat', 'Tating', 'default'),
(45, 'staff', 'root', 'root', 'Migzz', 'Magat', 'Tating', 'default'),
(46, 'User', 'NikoLakiTITI', 'lakititi', 'Taylor', 'Batungbacal', 'Lautner', 'default'),
(47, 'User', 'levi123', 'one123', 'Levi', 'Dela', 'Mata', 'default'),
(48, 'User', 'anjo', 'anjo', 'anjo', 'joan', 'anjo', 'default'),
(49, 'staff', 'jcbtagudin', 'jcbtagudin', 'Shem', 'Rono', 'Tagudin', 'default'),
(50, 'User', 'jfilosopo', 'rabbit', 'Julian ', 'Perez', 'Filosopo', 'default'),
(51, 'User', 'dyico2016', 'olson2016', 'sophie', 'herrera', 'dy ico', 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
