-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 09:34 AM
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
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teamID` int(11) NOT NULL,
  `TeamName` varchar(45) NOT NULL,
  `Points` int(11) NOT NULL,
  `Wins` int(11) NOT NULL,
  `Draws` int(11) NOT NULL,
  `Losses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teamID`, `TeamName`, `Points`, `Wins`, `Draws`, `Losses`) VALUES
(1, 'Manchester City', 0, 0, 0, 0),
(2, 'Arsenal', 0, 0, 0, 0),
(5, 'Chelsea', 0, 0, 0, 0),
(6, 'Newcastle', 0, 0, 0, 0),
(7, 'Aston Villa', 0, 0, 0, 0),
(8, 'Bournemouth', 0, 0, 0, 0),
(9, 'Brentford', 0, 0, 0, 0),
(10, 'Brighton', 0, 0, 0, 0),
(11, 'Everton', 0, 0, 0, 0),
(12, 'Fulham', 0, 0, 0, 0),
(13, 'Leicester City', 0, 0, 0, 0),
(14, 'Nottingham Forest', 0, 0, 0, 0),
(15, 'Southampton', 0, 0, 0, 0),
(16, 'Tottenham', 0, 0, 0, 0),
(17, 'West Ham', 0, 0, 0, 0),
(18, 'Wolverhampton', 0, 0, 0, 0),
(19, 'Ipswich Town', 0, 0, 0, 0),
(20, 'Sheffield', 0, 0, 0, 0),
(24, 'Manchester United', 0, 0, 0, 0),
(27, 'Liverpool', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamID`),
  ADD UNIQUE KEY `Team` (`TeamName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
