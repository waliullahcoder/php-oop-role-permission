-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 08:14 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop_php_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `assignTo` int(11) DEFAULT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `uemail` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `role_id`, `dep_id`, `assignTo`, `uname`, `upass`, `fullname`, `uemail`) VALUES
(1, 2, 5, 1, 'wali', 'e10adc3949ba59abbe56e057f20f883e', 'wali', 'wali@gmail.com'),
(2, 3, 2, 1, 'wasi', 'e10adc3949ba59abbe56e057f20f883e', 'Wasi Shaikh', 'wasi@gmail.com'),
(3, 1, 5, 1, 'asad', 'e10adc3949ba59abbe56e057f20f883e', 'Asad', 'asad@gmail.com'),
(4, 1, 1, 2, 'rumi', 'e10adc3949ba59abbe56e057f20f883e', 'Rumi', 'rumi@gmail.com'),
(7, 2, 4, NULL, 'sumi', 'e10adc3949ba59abbe56e057f20f883e', 'Sumi', 'sumi@gmail.com'),
(8, 2, 4, NULL, 'sahi', 'e10adc3949ba59abbe56e057f20f883e', 'Sahi', 'sahi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
