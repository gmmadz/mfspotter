-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2016 at 08:43 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `facilityID`, `comment`, `dateRated`) VALUES
(1, 18, 25, '1', '2016-09-21 13:06:57'),
(2, 27, 25, '12', '2016-09-21 17:01:42'),
(3, 27, 25, '2', '2016-09-21 17:02:52'),
(4, 27, 25, '3', '2016-09-21 17:03:14');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
(32, 'opopo', '(678) 567-8546', 125.61063766479492, 7.054726933338916, 'popopo', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `facilityhasstaff`
--

CREATE TABLE IF NOT EXISTS `facilityhasstaff` (
  `facilityHasStaffID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  PRIMARY KEY (`facilityHasStaffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
(17, 32, 17);

-- --------------------------------------------------------

--
-- Table structure for table `hasspecialization`
--

CREATE TABLE IF NOT EXISTS `hasspecialization` (
  `hasSpecializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specializationID` int(4) NOT NULL,
  `facilityID` int(4) NOT NULL,
  PRIMARY KEY (`hasSpecializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
(10, 1, 32);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
(24, 32, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
(19, 32, 3, '11:00:00', '11:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

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
(88, 18, 25, 1, 5, '2016-09-21 05:02:20'),
(89, 18, 25, 2, 5, '2016-09-21 05:02:20'),
(90, 18, 25, 3, 5, '2016-09-21 05:02:20'),
(91, 18, 25, 4, 1, '2016-09-21 05:02:20'),
(92, 27, 25, 1, 0, '2016-09-21 09:01:42'),
(93, 27, 25, 2, 0, '2016-09-21 09:01:42'),
(94, 27, 25, 3, 0, '2016-09-21 09:01:42'),
(95, 27, 25, 4, 0, '2016-09-21 09:01:42');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`remarkID`, `userID`, `commentID`, `remarks`) VALUES
(1, 18, 1, 'Dislike');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `specializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specialization` varchar(70) NOT NULL,
  PRIMARY KEY (`specializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

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
(108, 'Prosthodontics');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

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
(27, 'User', 'tags', 'tags', 'John Neil', 'Balboa', 'Tagudin', 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
