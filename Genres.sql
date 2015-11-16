
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2015 at 09:55 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a7698939_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `Genres`
--

CREATE TABLE `Genres` (
  `idgenres` int(11) NOT NULL AUTO_INCREMENT,
  `genre` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idgenres`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Genres`
--

INSERT INTO `Genres` VALUES(1, 'Horror');
INSERT INTO `Genres` VALUES(2, 'Comedy');
INSERT INTO `Genres` VALUES(3, 'Drama');
INSERT INTO `Genres` VALUES(4, 'Adventure');
INSERT INTO `Genres` VALUES(5, 'Sci-Fi');
