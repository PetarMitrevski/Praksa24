-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 08:47 AM
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
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchID` int(11) NOT NULL,
  `HomeTeamID` int(11) NOT NULL,
  `AwayTeamID` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `matchDate` date NOT NULL,
  `matchTime` time NOT NULL,
  `HomeScore` int(11) DEFAULT NULL,
  `AwayScore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`matchID`, `HomeTeamID`, `AwayTeamID`, `week`, `matchDate`, `matchTime`, `HomeScore`, `AwayScore`) VALUES
(29, 20, 19, 1, '2024-06-28', '20:57:00', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchID`),
  ADD KEY `fk_HomeTeamID` (`HomeTeamID`),
  ADD KEY `fk_AwayTeamID` (`AwayTeamID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_AwayTeamID` FOREIGN KEY (`AwayTeamID`) REFERENCES `teams` (`teamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_HomeTeamID` FOREIGN KEY (`HomeTeamID`) REFERENCES `teams` (`teamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`HomeTeamID`) REFERENCES `teams` (`teamID`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`AwayTeamID`) REFERENCES `teams` (`teamID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
