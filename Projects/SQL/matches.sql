-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 02:11 PM
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
  `HomeScore` int(11) NOT NULL,
  `AwayScore` int(11) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`matchID`, `HomeTeamID`, `AwayTeamID`, `week`, `matchDate`, `matchTime`, `HomeScore`, `AwayScore`) VALUES
(254, 2, 7, 1, '2024-07-16', '18:12:00', 2, 1),
(255, 2, 7, 2, '2024-07-16', '19:13:00', 2, 1),
(256, 2, 10, 3, '2024-07-30', '16:16:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

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
