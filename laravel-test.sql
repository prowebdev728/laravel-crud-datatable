-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2017 at 01:08 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` char(2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `disporder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `age`, `email`, `disporder`) VALUES
(1, 'anton', 'male', '0', 'abc@abc.com', 4),
(2, 'johnson', 'male', '0', 'b@b.com', 5),
(6, 'david', 'male', '26', 'david@hotmail.com', 1),
(7, 'anna', 'femail', '20', 'a@a.com', 2),
(8, 'tom', 'male', '22', 'c@c.com', 6),
(9, 'joana', 'female', '21', 'abc@a.com', 8),
(10, 'john', 'male', '25', 'as@as.com', 7),
(12, 'a', 'a', 'a', 'a', 9),
(14, 'b', '', '', '', 10),
(15, 'c', '', '', '', 11),
(16, 'd', 'male', '26', '', 12),
(17, 'e', '', '', '', 13),
(18, 'f', '', '', '', 14),
(19, 'g', '', '', '', 15),
(20, 'thomas', '', '', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
