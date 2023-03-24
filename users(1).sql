-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 03:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `familyname` varchar(40) NOT NULL,
  `street` varchar(255) NOT NULL,
  `housenr` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(225) NOT NULL,
  `additionalinfo` varchar(225) NOT NULL,
  `discount` tinyint(1) NOT NULL,
  `cityid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `familyname`, `street`, `housenr`, `email`, `password`, `additionalinfo`, `discount`, `cityid`) VALUES
(71, 'Antony', 'Starkinson', 'Vosstraat', 48, '1@ex.be', '$2y$10$wKA8rgotLfUmJADn5r8V.eYm.93TqeLWeViB59//.jKQAxyuLA3Ba', 'nice person', 1, 1),
(82, 'John', 'Doe', 'Dreef', 46, '0@ex.be', '$2y$10$rhJ/iGORFQnEDY09mIycM.reswzJZDzKHTPVDFTwNXZyQR0MlRcJ2', 'want discount', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
