-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Lis 2015, 13:16
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
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id_movie` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `id_genres` int(11) NOT NULL,
  `rating` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_movie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `description`, `year`, `id_genres`, `rating`) VALUES
(1, 'Heat', '<p>Two great actors fighting against each other. <span style="font-weight: bold;">Thrilling action movie!</span></p>', 1995, 6, '9'),
(2, 'The Thing', '<p>The <span style="font-style: italic;">models </span>will suprise you!</p>', 1982, 1, '10'),
(3, 'Her', 'A lonely wrtier is buying new OS. It happens to be a real something. He is getting a <span style="font-weight: bold;">close </span>realtionship with new OS.', 2013, 5, '9'),
(4, 'The Bucket List', 'The story of two dying men, who do crazy stuff. Light and ok. <span style="font-size: 24px;">JUST</span> ok.', 2007, 2, '5'),
(5, 'Scarface', '<p>Cuban guy <span style="font-style: italic;">Tony Montana</span>, is leaving his country and go to Miami. Soon he will be working for drugs mafia.</p>', 1980, 6, '9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
