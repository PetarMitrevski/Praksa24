<?php


function getMatchById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM matches WHERE matchID = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getTeamById($conn, $teamID) {
    $stmt = $conn->prepare("SELECT * FROM teams WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateMatch($conn, $id, $week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime) {
    $stmt = $conn->prepare("UPDATE matches SET week = ?, HomeTeamID = ?, AwayTeamID = ?, HomeScore = ?, AwayScore = ?, matchDate = ?, matchTime = ? WHERE matchID = ?;");
    $stmt->bind_param("iiiiissi", $week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime, $id);
    $stmt->execute();
}

function updateWinLoss($conn, $winningTeam, $losingTeam, $winningRow, $losingRow, $oldMatch, $isHomeTeamWinning) {
    if ($oldMatch['HomeScore'] === $oldMatch['AwayScore']) {
        adjustDrawToWin($conn, $winningTeam);
        adjustDrawToLoss($conn, $losingTeam);
    } else {
        if (($oldMatch['HomeScore'] > $oldMatch['AwayScore'] && $isHomeTeamWinning) || ($oldMatch['HomeScore'] < $oldMatch['AwayScore'] && !$isHomeTeamWinning)) {
            return;
        }
        adjustLossToWin($conn, $winningTeam);
        adjustWinToLoss($conn, $losingTeam);
    }
}

function updateDraw($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch) {
    if ($oldMatch['HomeScore'] > $oldMatch['AwayScore']) {
        adjustWinToDraw($conn, $homeTeam);
        adjustLossToDraw($conn, $awayTeam);
    } elseif ($oldMatch['HomeScore'] < $oldMatch['AwayScore']) {
        adjustWinToDraw($conn, $awayTeam);
        adjustLossToDraw($conn, $homeTeam);
    }
}

function adjustDrawToWin($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws - 1, Draws =  GREATEST(Draws - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustDrawToLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Draws = GREATEST(Draws - 1, 0), Points = 3 * Wins + Draws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustLossToWin($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses =  GREATEST(Losses - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustWinToLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Wins =  GREATEST(Wins - 1, 0), Points = 3 * Wins + Draws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustWinToDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Wins = GREATEST(Wins - 1, 0), Draws = Draws + 1, Points = 3 * Wins + Draws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustLossToDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Draws = Draws + 1, Losses = GREATEST(Losses - 1, 0), Points = 3 * Wins + Draws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}