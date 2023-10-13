-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2023 at 01:39 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `about` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `photoPath` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `upass`, `name`, `about`, `contact`, `photoPath`) VALUES
(1, 'kvmangukiya@gmail.com', '123', 'Kalpesh Mangukiya', 'Flutter Developers', '9979900105', 'user_profile_photos/1-6524d8d062ab94175657006.jpg'),
(3, 'harikrushnainfotech@gmail.com', 'abc', 'Harikrushna Infotech', 'IT Company', '9979900105', ''),
(13, 'kavya45@gmail.com', '$2y$10$VpRy081MMiEwezNo.aUXlO2qa.LBNhJ0ftb4sEurzxmoJzjYu.yvm', 'Kavya', 'Flutter Developer', '9874561230', ''),
(16, 'abc@gmail.com', 'abc', 'abc', 'aaa', '9979900105', 'user_profile_photos/User-65289d11c5b801978119006.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
