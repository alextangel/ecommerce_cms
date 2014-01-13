-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2013 at 04:49 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erd`
--

-- --------------------------------------------------------

--
-- Table structure for table `ltrole`
--

CREATE TABLE IF NOT EXISTS `ltrole` (
  `RoleID` char(1) NOT NULL,
  `RoleName` varchar(20) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ltrole`
--

INSERT INTO `ltrole` (`RoleID`, `RoleName`) VALUES
('0', 'admin'),
('1', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `msmenu`
--

CREATE TABLE IF NOT EXISTS `msmenu` (
  `MenuID` varchar(10) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `Sort` int(11) NOT NULL,
  PRIMARY KEY (`MenuID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msmenu`
--

INSERT INTO `msmenu` (`MenuID`, `Link`, `Sort`) VALUES
('1', 'product.php', 0),
('2', 'member.php', 0),
('3', 'transaction.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `msmenurole`
--

CREATE TABLE IF NOT EXISTS `msmenurole` (
  `MenuID` varchar(10) NOT NULL,
  `RoleID` char(1) NOT NULL,
  PRIMARY KEY (`MenuID`,`RoleID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msmenurole`
--

INSERT INTO `msmenurole` (`MenuID`, `RoleID`) VALUES
('1', '0'),
('2', '0'),
('3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `msproduct`
--

CREATE TABLE IF NOT EXISTS `msproduct` (
  `ProductID` int(10) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(20) NOT NULL,
  `ImageSrc` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(20) NOT NULL,
  `IsNew` tinyint(1) NOT NULL,
  `ProductTypeID` int(10) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `ProductTypeID` (`ProductTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `msproduct`
--

INSERT INTO `msproduct` (`ProductID`, `ProductName`, `ImageSrc`, `Description`, `Price`, `IsNew`, `ProductTypeID`) VALUES
(1, 'Love', 'images/1', 'Cocok buat yang lagi jatuh cinta', 23000, 1, 1),
(2, 'Laugh', 'images/2', 'Wanna Laugh?', 23000, 1, 1),
(3, 'bagus', 'images/3', 'pasti bagus', 3322, 1, 1),
(4, 'capek', 'images/4', 'capek ah', 1111, 1, 1),
(5, 'swt', 'images/5', 'sswwtt', 12341, 1, 1),
(6, 'goog', 'images/6', 'adsf', 1111, 1, 1),
(8, 'Ayamm', 'images/8', 'ayam goreng enak', 3455, 1, 0),
(9, 'Sabun', 'images/9', 'no comment', 332211, 0, 0),
(10, 'Sushi', 'images/10', 'qwrty', 1200, 0, 0),
(11, 'Pastel', 'images/11', 'sad', 1111, 1, 0),
(12, 'Kue Nikah', 'images/12', 'qwwe', 2333, 1, 0),
(13, 'Kecoak', 'images/13', 'ds', 2222, 1, 0),
(14, 'Nasi Bungkus', 'images/14', 'safd', 3400, 1, 0),
(15, 'Bihun Effata', 'images/15', 'bosen', 16000, 0, 1),
(16, 'Tidur', 'images/16', 'adfs', 2222, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msproducttype`
--

CREATE TABLE IF NOT EXISTS `msproducttype` (
  `ProductTypeID` int(10) NOT NULL,
  `ProductTypeName` varchar(10) NOT NULL,
  PRIMARY KEY (`ProductTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msproducttype`
--

INSERT INTO `msproducttype` (`ProductTypeID`, `ProductTypeName`) VALUES
(0, 'Cake'),
(1, 'Macaroon');

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE IF NOT EXISTS `msuser` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `RoleID` char(1) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `UserID` (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`UserID`, `UserName`, `Pass`, `RoleID`, `FullName`, `Address`, `Telephone`, `Email`) VALUES
(13, 'alextangel', '123456', '1', 'Alex Tangel', 'Street Jatinegara', '123123123', 'weisse.taube93@gmail.com'),
(14, 'cacing', 'cacingtanah', '1', 'cacing tanah', 'street jaksdf', '213423234', 'asfd@fadfs.com'),
(17, 'admin', 'makannasi', '0', 'Admin Makan Nasi', 'street Nasi', '8193322', 'makannasi@gmail.com'),
(18, 'makanbubur', 'abangabang', '1', 'Abang Makan Bubur', 'Street Kebuburan', '321123', 'buburenak@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `trdetailpurchase`
--

CREATE TABLE IF NOT EXISTS `trdetailpurchase` (
  `TransactionID` int(10) NOT NULL,
  `ProductID` int(10) NOT NULL,
  `Qty` int(10) NOT NULL,
  KEY `ProductID` (`ProductID`),
  KEY `TransactionID` (`TransactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trdetailpurchase`
--

INSERT INTO `trdetailpurchase` (`TransactionID`, `ProductID`, `Qty`) VALUES
(15, 1, 1),
(16, 9, 1),
(16, 2, 10),
(16, 10, 12),
(17, 1, 122),
(17, 16, 110),
(18, 11, 16);

-- --------------------------------------------------------

--
-- Table structure for table `trheaderpurchase`
--

CREATE TABLE IF NOT EXISTS `trheaderpurchase` (
  `TransactionID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `TransactionDate` datetime NOT NULL,
  `IsPaid` varchar(10) NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `UserID_2` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `trheaderpurchase`
--

INSERT INTO `trheaderpurchase` (`TransactionID`, `UserID`, `TransactionDate`, `IsPaid`) VALUES
(16, 14, '2013-10-31 09:16:03', 'unpaid'),
(17, 14, '2013-10-31 09:19:35', 'paid'),
(18, 18, '2013-10-31 10:03:46', 'paid');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msmenurole`
--
ALTER TABLE `msmenurole`
  ADD CONSTRAINT `msmenurole_ibfk_2` FOREIGN KEY (`MenuID`) REFERENCES `msmenu` (`MenuID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `msmenurole_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `ltrole` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `msproduct`
--
ALTER TABLE `msproduct`
  ADD CONSTRAINT `msproduct_ibfk_1` FOREIGN KEY (`ProductTypeID`) REFERENCES `msproducttype` (`ProductTypeID`);

--
-- Constraints for table `msuser`
--
ALTER TABLE `msuser`
  ADD CONSTRAINT `msuser_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `ltrole` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trheaderpurchase`
--
ALTER TABLE `trheaderpurchase`
  ADD CONSTRAINT `trheaderpurchase_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `msuser` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
