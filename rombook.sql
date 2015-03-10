-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10. Mar, 2015 11:20 
-- Server-versjon: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rombook`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bookinger`
--

CREATE TABLE IF NOT EXISTS `bookinger` (
`id` int(99) NOT NULL,
  `studentnr` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `slutt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rom`
--

CREATE TABLE IF NOT EXISTS `rom` (
  `id` int(99) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `plass` int(4) NOT NULL,
  `status` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `rom`
--

INSERT INTO `rom` (`id`, `name`, `plass`, `status`) VALUES
(1, 'fint rom', 2, 'ledig'),
(2, 'stort rom', 4, 'ledig'),
(3, 'presentasjonsrom', 4, 'opptatt');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentnr` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `navn` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `passord` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `student`
--

INSERT INTO `student` (`studentnr`, `navn`, `passord`) VALUES
('abc12', 'Jens', 'abc12'),
('root', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinger`
--
ALTER TABLE `bookinger`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rom`
--
ALTER TABLE `rom`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`studentnr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinger`
--
ALTER TABLE `bookinger`
MODIFY `id` int(99) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
