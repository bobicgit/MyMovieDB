
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2015 at 09:50 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7698939_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `Actors`
--

CREATE TABLE `Actors` (
  `idactors` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `surname` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idactors`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Actors`
--

INSERT INTO `Actors` VALUES(1, 'Kurt', 'Russel');
INSERT INTO `Actors` VALUES(2, 'Al', 'Pacino');
INSERT INTO `Actors` VALUES(3, 'Robert', 'DeNiro');
INSERT INTO `Actors` VALUES(4, 'Nicholas', 'Cage');
INSERT INTO `Actors` VALUES(5, 'John', 'Carpenter');
