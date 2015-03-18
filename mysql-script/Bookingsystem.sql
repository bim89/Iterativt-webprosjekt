-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 18. Mar, 2015 12:39 PM
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
  `username` varchar(255) NOT NULL,
  `week` int(11) NOT NULL,
  `weekday` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `Booking`
--

INSERT INTO `Booking` (`book_id`, `start_time`, `stop_time`, `room_size`, `room_id`, `username`, `week`, `weekday`) VALUES
(4, 10, 12, 2, 1, 'dummy2', 11, 'wed'),
(5, 10, 12, 2, 1, 'dummy2', 11, 'fri'),
(9, 12, 15, 2, 1, 'morbjo14', 11, 'thu'),
(28, 9, 12, 2, 1, 'morbjo14', 11, 'mon'),
(29, 9, 14, 2, 1, 'morbjo14', 11, 'tue'),
(30, 9, 11, 2, 1, 'morbjo14', 11, 'mon'),
(31, 9, 12, 2, 1, 'morbjo14', 11, 'tue'),
(32, 9, 11, 2, 4, 'morbjo14', 11, 'tue'),
(33, 9, 12, 2, 5, 'morbjo14', 11, 'wed'),
(34, 10, 12, 2, 5, 'morbjo14', 11, 'wed'),
(35, 10, 12, 2, 5, 'morbjo14', 11, 'mon'),
(36, 9, 12, 2, 5, 'morbjo14', 11, 'tue'),
(37, 8, 12, 2, 7, 'morbjo14', 11, 'tue'),
(38, 8, 12, 2, 7, 'morbjo14', 11, 'wed'),
(39, 8, 12, 2, 7, 'morbjo14', 11, 'fri'),
(40, 9, 11, 2, 2, 'morbjo14', 11, 'fri'),
(41, 9, 11, 2, 2, 'morbjo14', 11, 'tue'),
(42, 9, 11, 2, 8, 'morbjo14', 11, 'thu'),
(43, 8, 14, 2, 8, 'morbjo14', 11, 'thu'),
(44, 8, 14, 2, 8, 'morbjo14', 11, 'tue'),
(45, 8, 10, 2, 8, 'morbjo14', 11, 'fri'),
(46, 8, 11, 2, 1, 'morbjo14', 11, 'thu'),
(47, 8, 10, 2, 1, 'morbjo14', 11, 'wed'),
(48, 8, 12, 2, 4, 'morbjo14', 11, 'wed'),
(49, 8, 12, 2, 5, 'morbjo14', 11, 'thu'),
(50, 8, 12, 2, 2, 'morbjo14', 11, 'thu'),
(51, 8, 12, 2, 2, 'morbjo14', 11, 'wed'),
(52, 8, 12, 2, 6, 'morbjo14', 11, 'wed'),
(59, 8, 10, 2, 6, 'morbjo14', 11, 'fri'),
(60, 8, 11, 2, 4, 'morbjo14', 11, 'mon'),
(61, 8, 11, 2, 5, 'morbjo14', 11, 'fri');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `projector` tinyint(1) NOT NULL,
  `whiteboard` tinyint(1) NOT NULL,
  `room_size` int(11) NOT NULL,
  `floor_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `room`
--

INSERT INTO `room` (`id`, `room_number`, `projector`, `whiteboard`, `room_size`, `floor_number`) VALUES
(1, 101, 1, 1, 2, 1),
(2, 102, 0, 1, 4, 1),
(3, 201, 1, 0, 2, 2),
(4, 202, 0, 0, 6, 2),
(5, 301, 1, 0, 2, 3),
(6, 302, 1, 1, 5, 3),
(7, 401, 1, 0, 6, 4),
(8, 402, 1, 1, 3, 4),
(9, 403, 1, 1, 2, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `salt` char(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `firstname`, `lastname`) VALUES
(1, 'dummy2', '450db4757a32a5e05d01f1e25d779e68c7138c09d662a11673b72bee2b32cd53', '20916a4060517068', 'dan@banan.com', '', ''),
(3, 'morbjo14', '8b1cac96b41a5a269b3286f3e3758121b8303ceb2354dd891056ef0724c2f634', '4669964c15ab8a', 'morbjo14@student.westerdals.no', 'Bjørn-Inge', 'Morstad'),
(4, 'meidan14', 'b45aa4742104e178273d3f9dc8bfd05167ac713899c8038147e34a87b2d3e3a2', '7894d08144fad02', 'meidan14@student.westerdals.no', 'Daniel', 'Meinecke');

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
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
