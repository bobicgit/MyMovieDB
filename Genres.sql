-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Lis 2015, 13:15
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `idgenres` int(11) NOT NULL AUTO_INCREMENT,
  `genre` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idgenres`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `genres`
--

INSERT INTO `genres` (`idgenres`, `genre`) VALUES
(1, 'Horror'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Adventure'),
(5, 'Sci-Fi'),
(6, 'Action'),
(7, 'Thriller');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
