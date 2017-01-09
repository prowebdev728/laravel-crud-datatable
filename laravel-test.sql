-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 04:50 PM
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
CREATE DATABASE IF NOT EXISTS `laravel-test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `laravel-test`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `disporder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `age`, `email`, `disporder`) VALUES
(1, 'anton', 'male', '28', 'anton@outlook.com', 7),
(2, 'johnson', 'male', '0', 'b@b.com', 8),
(6, 'david', 'male', '26', 'david@hotmail.com', 3),
(7, 'anna', 'femail', '20', 'a@a.com', 1),
(8, 'tom', 'male', '22', 'c@c.com', 4),
(9, 'joana', 'female', '21', 'abc@a.com', 11),
(10, 'john', 'male', '25', 'as@as.com', 5),
(20, 'thomas', '', '', '', 6),
(23, 'joana', 'female', '22', 'joana@outlook.com', 2),
(27, 'a', 'female', '20', '', 10),
(29, 'c', 'male', '20', 'c@mail.com', 12),
(30, 'd', 'male', '20', 'd@mail.com', 9),
(33, 'aaa', '', '', '', 14),
(35, 'bbb', 'dfas', '324', 'fasdf', 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
