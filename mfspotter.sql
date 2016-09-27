-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 03:11 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`calendarID`, `title`, `startDate`, `endDate`, `allDay`, `userID`, `facilityID`) VALUES
(6, 'Cleaning', '2016-09-22', '2016-09-22', 'false', 23, 41);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `facilityID`, `comment`, `dateRated`) VALUES
(1, 18, 41, '1', '2016-09-21 13:06:57'),
(2, 27, 41, '12', '2016-09-21 17:01:42'),
(3, 27, 41, '2', '2016-09-21 17:02:52'),
(4, 27, 42, '3', '2016-09-21 17:03:14'),
(5, 35, 42, 'ryd', '2016-09-22 13:23:57'),
(6, 19, 42, 'hello pig :)', '2016-09-22 13:31:05'),
(7, 44, 44, 'Ang Pangit', '2016-09-22 17:12:08'),
(8, 23, 44, 'wow ganda!', '2016-09-22 17:37:23'),
(9, 18, 44, 'fdf', '2016-09-22 17:44:26'),
(10, 47, 44, 'tating', '2016-09-22 18:13:15'),
(11, 40, 45, 'wag kayo dito', '2016-09-22 18:19:06'),
(12, 49, 45, 'best dental clinic.', '2016-09-22 19:00:36'),
(13, 18, 45, 'sadsa', '2016-09-26 15:14:00'),
(14, 18, 46, 'lallaaaa', '2016-09-27 00:12:01'),
(15, 18, 46, 'lalalla', '2016-09-27 00:12:09'),
(16, 18, 52, 'oh noooo', '2016-09-27 00:15:51'),
(17, 18, 52, 'ds', '2016-09-27 00:29:49');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityID`, `facilityName`, `telephoneNumber`, `longhitude`, `latitude`, `address`, `facilityPicture`) VALUES
(41, 'ELIZA YU FAMILY DENTISTRY', '(082) 224-5924', 125.61206728219986, 7.0722099805379095, 'Davao City', 'default'),
(42, 'Molar World Dental Clinic', '(082) 284-4557', 125.61146914958954, 7.071555176743535, 'unit 3 cva bldg cm recto st.davao city', 'default'),
(44, 'marie kristine f del rosario', '(093) 095-1442', 125.60671895742416, 7.0638811265204895, 'art center del rosario building', 'default'),
(45, 'maligad dental clinic', '(091) 823-1445', 125.60671761631966, 7.063910406871016, 'art center del rosario building', 'default'),
(46, 'Magallanes DOCTORS & Laboratory Inc.', '(082) 221-2599', 125.60673236846924, 7.063947672768994, 'Del Rosario Building, Magallanes Street', 'default'),
(52, 'Dr. Genafe Gumban-Veneracion', '(082) 221-0668', 125.612633228302, 7.071155905681602, 'Aldevinco Shopping Center', 'default'),
(53, 'Hernaez Mansukhani Dental Clinic', '(082) 222-2244', 125.61275124549866, 7.071017491632897, '2nd Floor, Door #4, Aldevinco Shopping C', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `facilityhasstaff`
--

CREATE TABLE IF NOT EXISTS `facilityhasstaff` (
  `facilityHasStaffID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  PRIMARY KEY (`facilityHasStaffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `facilityhasstaff`
--

INSERT INTO `facilityhasstaff` (`facilityHasStaffID`, `facilityID`, `userID`) VALUES
(26, 41, 38),
(27, 42, 39),
(29, 44, 41),
(30, 45, 42),
(31, 46, 43),
(37, 52, 55),
(38, 53, 56);

-- --------------------------------------------------------

--
-- Table structure for table `hasspecialization`
--

CREATE TABLE IF NOT EXISTS `hasspecialization` (
  `hasSpecializationID` int(4) NOT NULL AUTO_INCREMENT,
  `specializationID` int(4) NOT NULL,
  `facilityID` int(4) NOT NULL,
  PRIMARY KEY (`hasSpecializationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `hasspecialization`
--

INSERT INTO `hasspecialization` (`hasSpecializationID`, `specializationID`, `facilityID`) VALUES
(29, 1, 41),
(30, 105, 42),
(32, 71, 44),
(33, 1, 45),
(34, 105, 45),
(35, 1, 46),
(36, 2, 46),
(37, 23, 46),
(38, 37, 46),
(39, 50, 46),
(40, 71, 46),
(50, 1, 52),
(51, 105, 52),
(52, 1, 53),
(53, 98, 53),
(54, 105, 53);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE IF NOT EXISTS `insurances` (
  `insurancesID` int(4) NOT NULL AUTO_INCREMENT,
  `insuranceName` varchar(20) NOT NULL,
  PRIMARY KEY (`insurancesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`insurancesID`, `insuranceName`) VALUES
(1, 'MediCard'),
(2, 'IntelliCare'),
(3, 'MediCare'),
(4, 'Winnie the Pooh'),
(5, 'Getwell'),
(6, 'Malayan Insurance');

-- --------------------------------------------------------

--
-- Table structure for table `insurancescovered`
--

CREATE TABLE IF NOT EXISTS `insurancescovered` (
  `insurancesCoveredID` int(4) NOT NULL AUTO_INCREMENT,
  `facilityID` int(4) NOT NULL,
  `insuranceID` int(4) NOT NULL,
  PRIMARY KEY (`insurancesCoveredID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `insurancescovered`
--

INSERT INTO `insurancescovered` (`insurancesCoveredID`, `facilityID`, `insuranceID`) VALUES
(41, 45, 5),
(42, 53, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `operatingperiod`
--

INSERT INTO `operatingperiod` (`operatingperiodID`, `facilityID`, `dayofweek`, `timeOpened`, `timeClosed`) VALUES
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
(93, 52, 1, '09:00:00', '18:00:00'),
(94, 52, 2, '09:00:00', '18:00:00'),
(95, 52, 3, '09:00:00', '18:00:00'),
(96, 52, 4, '09:00:00', '18:00:00'),
(97, 52, 5, '09:00:00', '18:00:00'),
(98, 52, 6, '09:00:00', '18:00:00'),
(99, 53, 1, '09:00:00', '17:00:00'),
(100, 53, 2, '09:00:00', '17:00:00'),
(101, 53, 3, '09:00:00', '17:00:00'),
(102, 53, 4, '09:00:00', '17:00:00'),
(103, 53, 5, '09:00:00', '17:00:00'),
(104, 53, 6, '13:00:00', '17:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`ratingID`, `userID`, `facilityID`, `categoryID`, `rating`, `dateRated`) VALUES
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
(128, 18, 45, 1, 4, '2016-09-22 08:46:46'),
(129, 18, 45, 2, 4, '2016-09-22 08:46:46'),
(130, 18, 45, 3, 4, '2016-09-22 08:46:46'),
(131, 18, 45, 4, 4, '2016-09-22 08:46:46'),
(132, 25, 44, 1, 1, '2016-09-27 14:55:43'),
(133, 25, 44, 2, 5, '2016-09-27 14:55:52'),
(134, 25, 44, 3, 5, '2016-09-27 14:56:40'),
(135, 25, 44, 4, 5, '2016-09-27 14:56:49'),
(136, 23, 41, 1, 2, '2016-09-22 09:31:54'),
(137, 23, 41, 2, 3, '2016-09-22 09:31:54'),
(138, 23, 41, 3, 1, '2016-09-22 09:31:54'),
(139, 23, 41, 4, 2, '2016-09-22 09:31:54'),
(152, 50, 28, 1, 4, '2016-09-22 15:06:57'),
(153, 50, 28, 2, 4, '2016-09-22 15:06:57'),
(154, 50, 28, 3, 3, '2016-09-22 15:06:57'),
(155, 50, 28, 4, 3, '2016-09-22 15:06:57'),
(156, 51, 46, 1, 3, '2016-09-22 15:20:15'),
(157, 51, 46, 2, 3, '2016-09-22 15:20:15'),
(158, 51, 46, 3, 4, '2016-09-22 15:20:15'),
(159, 51, 46, 4, 5, '2016-09-22 15:20:15'),
(176, 55, 52, 1, 3, '2016-09-27 06:40:29'),
(177, 55, 52, 2, 5, '2016-09-27 06:40:29'),
(178, 55, 52, 3, 4, '2016-09-27 06:40:29'),
(179, 55, 52, 4, 5, '2016-09-27 06:40:29'),
(180, 18, 53, 1, 4, '2016-09-27 07:00:12'),
(181, 18, 53, 2, 2, '2016-09-27 07:00:12'),
(182, 18, 53, 3, 1, '2016-09-27 07:00:12'),
(183, 18, 53, 4, 5, '2016-09-27 07:00:12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
(9, 49, 12, 'Like'),
(10, 18, 16, 'Dislike');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userType`, `username`, `password`, `firstName`, `middleName`, `lastName`, `picture`) VALUES
(18, 'User', 'joan', 'joan', 'Joahnne', 'Perez', 'Filosopo', 'joan'),
(19, 'User', 'gems', 'gems', 'Gerald ', 'Conanan', 'Madarang', 'gems'),
(20, 'User', 'buta', 'buta', 'Dan', 'Buta', 'Vicente', 'buta'),
(21, 'User', 'tats', 'tats', 'Miguelito', 'Magat', 'Tating', 'tats'),
(22, 'User', 'bae', 'bae', 'Damrey', 'Terec', 'Rizon', 'dam'),
(23, 'User', 'dan', 'dan', 'Dan Angelo', 'Buta', 'Vicente', 'dan'),
(27, 'User', 'tags', 'tags', 'John Neil', 'Balboa', 'Tagudin', 'default'),
(28, 'User', 'gmmadz', 'gmmadz', 'Martin', 'Conanan', 'Madz', 'default'),
(35, 'User', 'samoy', 'samoy', 'Samoy', 'Balang', 'Macacua', 'default'),
(37, 'User', 'YU Dental Center', '1234', 'ELIZA ', 'QUIROG', 'YU', 'default'),
(38, 'staff', 'nathalie29', 'natnat29', 'Nathalie', 'Amora', 'Quicoy', 'default'),
(39, 'staff', 'molarworld', '2844557', 'Genibie', 'Rellon', 'Genibie', 'default'),
(41, 'staff', 'jiana', 'jiana', 'jessa ', 'delos santos', 'baylosis', 'default'),
(42, 'staff', 'sweetrose', 'sweetie', 'Sweet Rose', 'Albaran', 'Rillo', 'default'),
(43, 'staff', 'nimfa', '0330', 'Nimfa', 'Mayol', 'Tech', 'default'),
(44, 'User', 'SynerGenix', 'migspogi', 'Migz', 'Magat', 'Tating', 'default'),
(46, 'User', 'Niko', 'nazaire', 'Taylor', 'Batungbacal', 'Lautner', 'default'),
(47, 'User', 'levi123', 'one123', 'Levi', 'Dela', 'Mata', 'default'),
(48, 'User', 'anjo', 'anjo', 'anjo', 'joan', 'anjo', 'default'),
(50, 'User', 'jfilosopo', 'rabbit', 'Julian ', 'Perez', 'Filosopo', 'default'),
(51, 'User', 'dyico2016', 'olson2016', 'sophie', 'herrera', 'dy ico', 'default'),
(55, 'staff', 'ggveneracion', 'ggveneracion', 'Genafe', 'Gumban', 'Veneracion', 'default'),
(56, 'staff', 'macariño', 'macariño', 'Mercy', 'Ambat', 'Cariño', 'default'),
(57, 'User', 'joel', 'joel', 'Joel', 'Logatiman', 'Filosopo', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `viewID` int(11) NOT NULL AUTO_INCREMENT,
  `facilityID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`viewID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
