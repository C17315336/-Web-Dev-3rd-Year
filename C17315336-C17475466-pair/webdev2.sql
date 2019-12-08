-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2019 at 12:55 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `BookTitle` varchar(200) NOT NULL,
  `Author` varchar(150) NOT NULL,
  `Category` varchar(200) NOT NULL,
  `Year` varchar(20) NOT NULL,
  `Edition` varchar(30) NOT NULL,
  `Reserved` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `ISBN`, `BookTitle`, `Author`, `Category`, `Year`, `Edition`, `Reserved`) VALUES
(1, '1231231X', 'Harry Potter and the Source', 'JK', 'Fiction', '2009', '1', 'N'),
(3, '1231231Y', 'Harry Potter 2', 'JK', '', '', '', ''),
(4, '1231231Z', 'Harry Potter 3', 'JK', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `isbn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `per_id`, `isbn`) VALUES
(10, 1, '1231231X'),
(24, 1, '1231231Y'),
(29, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `access` varchar(1) NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL DEFAULT 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `access`, `url`, `created_at`) VALUES
(1, 'ebdragon2127@hotmail.com', '$2y$10$kVYJlueAPG32FBjvDKQM6uXLUuLx6/0ds6y8BafKsMxqxMKKu2/1.', 'Eoghan', 'Byrne', '1', 'uploads/116Circle-01.png', '2019-11-23 16:00:53'),
(11, 'c@b.com', '$2y$10$PpkQWqQeSq07Lmgh9AoycORt2RiZxFKjt7NfsSLgPFTkipbDX7HoK', 'Jane', 'Smith', '0', 'uploads/frank.jpg', '2019-11-24 17:45:04'),
(12, 'd@b.com', '$2y$10$drSUUMyrzoFIeVx2AJFxoePyIEpUos6q.fu3tlxnWhpm2aVg.HvZm', 'Jane', 'Smith', '0', 'uploads/playground-07-desktop.png', '2019-11-24 20:05:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `per_id` (`per_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
