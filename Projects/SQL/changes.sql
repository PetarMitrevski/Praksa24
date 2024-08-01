-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 03:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `premier league`
--

-- --------------------------------------------------------

--
-- Table structure for table `changes`
--

CREATE TABLE `changes` (
  `changeID` int(11) NOT NULL,
  `dateChanged` date DEFAULT curdate(),
  `timeChanged` time DEFAULT curtime(),
  `UserName` varchar(40) DEFAULT NULL,
  `changeText` varchar(350) DEFAULT NULL,
  `changeType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `changes`
--

INSERT INTO `changes` (`changeID`, `dateChanged`, `timeChanged`, `UserName`, `changeText`, `changeType`) VALUES
(78, '2024-08-01', '15:44:56', 'Donny', 'Home Score changed from 4 to 5 in week 1', 'Matches'),
(79, '2024-08-01', '15:45:28', 'Shadow', 'Home Score changed from 5 to 6 in week 1', 'Matches'),
(80, '2024-08-01', '15:48:14', 'Johnny', 'Oxed home wins changed from 1 to 2 ', 'Teams'),
(81, '2024-08-01', '15:49:03', 'Shadow', 'Oxed home wins changed from 2 to 4 ', 'Teams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`changeID`),
  ADD KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `changes`
--
ALTER TABLE `changes`
  MODIFY `changeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `changes`
--
ALTER TABLE `changes`
  ADD CONSTRAINT `changes_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
