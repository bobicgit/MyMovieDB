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
-- Struktura tabeli dla tabeli `actors`
--

CREATE TABLE IF NOT EXISTS `actors` (
  `idactors` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `surname` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idactors`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `actors`
--

INSERT INTO `actors` (`idactors`, `name`, `surname`) VALUES
(1, 'Kurt', 'Russel'),
(2, 'Al', 'Pacino'),
(3, 'Marlon', 'Brando'),
(4, 'Leonardo', 'DiCaprio'),
(5, 'Jack', 'Nicholson'),
(6, 'Tom', 'Hanks'),
(7, 'Steve', 'Carell'),
(8, 'Matthew ', 'McConaughey'),
(9, 'Robert', 'DeNiro'),
(10, 'Joaquin', 'Phoenix'),
(11, 'Sean', 'Connery');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
