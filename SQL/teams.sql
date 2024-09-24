-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 09:01 AM
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
  `Losses` int(11) NOT NULL,
  `MatchesPlayed` int(11) DEFAULT 0,
  `Goals` int(11) DEFAULT 0,
  `HomePoints` int(11) DEFAULT 0,
  `AwayPoints` int(11) DEFAULT 0,
  `HomeWins` int(11) DEFAULT 0,
  `AwayWins` int(11) DEFAULT 0,
  `HomeDraws` int(11) DEFAULT 0,
  `AwayDraws` int(11) DEFAULT 0,
  `HomeLosses` int(11) DEFAULT 0,
  `AwayLosses` int(11) DEFAULT 0,
  `HomeGoals` int(11) DEFAULT 0,
  `AwayGoals` int(11) DEFAULT 0,
  `MatchesPlayedHome` int(11) DEFAULT 0,
  `MatchesPlayedAway` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teamID`, `TeamName`, `Points`, `Wins`, `Draws`, `Losses`, `MatchesPlayed`, `Goals`, `HomePoints`, `AwayPoints`, `HomeWins`, `AwayWins`, `HomeDraws`, `AwayDraws`, `HomeLosses`, `AwayLosses`, `HomeGoals`, `AwayGoals`, `MatchesPlayedHome`, `MatchesPlayedAway`) VALUES
(1, 'Arsenal', 3, 1, 0, 0, 1, 6, 3, 0, 1, 0, 0, 0, 0, 0, 6, 0, 1, 0),
(5, 'Chelsea', 0, 0, 0, 1, 1, 5, 0, 0, 0, 0, 0, 0, 0, 1, 0, 5, 0, 1),
(6, 'Newcastle', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Aston Villa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Bournemouth', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Brentford', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'Brighton', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'Everton', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'Fulham', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'Leicester City', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'Nottingham Forest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'Southampton', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'Tottenham', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'West Ham', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'Wolverhampton', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'Ipswich Town', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'Manchester United', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'Liverpool', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 'Oxed', 17, 5, 2, 2, 0, 0, 13, 4, 4, 1, 1, 1, 1, 1, 0, 0, 0, 0);

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
  MODIFY `teamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
