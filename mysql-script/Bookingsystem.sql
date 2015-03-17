-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 12. Mar, 2015 17:08 PM
-- Server-versjon: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Bookingsystem`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Booking`
--

CREATE TABLE IF NOT EXISTS `Booking` (
`book_id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `stop_time` int(11) NOT NULL,
  `room_size` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `weekday` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `projector` tinyint(1) NOT NULL,
  `whiteboard` tinyint(1) NOT NULL,
  `room_size` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `room`
--

INSERT INTO `room` (`id`, `room_number`, `projector`, `whiteboard`, `room_size`) VALUES
(1, 101, 1, 1, 2),
(2, 201, 0, 1, 4),
(3, 301, 1, 0, 4),
(4, 401, 0, 0, 2),
(5, 102, 1, 0, 4),
(6, 202, 1, 1, 4),
(7, 302, 0, 0, 4),
(8, 402, 1, 1, 3),
(9, 103, 0, 1, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `salt` char(16) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`) VALUES
(1, 'dummy2', '450db4757a32a5e05d01f1e25d779e68c7138c09d662a11673b72bee2b32cd53', '20916a4060517068', 'dan@banan.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
