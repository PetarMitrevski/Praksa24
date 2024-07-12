<?php


function getMatchById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM matches WHERE matchID = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


function updateTotalHomeGoals($conn, $teamID, $newGoals, $oldGoals) {
    if($newGoals > $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET HomeGoals = HomeGoals + $newGoals - $oldGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    }

    else if($newGoals <= $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET HomeGoals = HomeGoals + $oldGoals - $newGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();    
    }
    
}


/*
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


function updateAwayWinLoss($conn, $winningTeam, $losingTeam, $winningRow, $losingRow, $oldMatch, $isAwayTeamWinning) {
    if ($oldMatch['HomeScore'] === $oldMatch['AwayScore']) {
        adjustAwayDrawToAwayWin($conn, $winningTeam);
        adjustHomeDrawToHomeLoss($conn, $losingTeam);
    } else {
        if (($oldMatch['HomeScore'] > $oldMatch['AwayScore'] && $isAwayTeamWinning) || ($oldMatch['HomeScore'] < $oldMatch['AwayScore'] && !$isAwayTeamWinning)) {
            return;
        }
        adjustAwayLossToAwayWin($conn, $winningTeam);
        adjustHomeWinToHomeLoss($conn, $losingTeam);
    }
}

function updateHomeWinLoss($conn, $winningTeam, $losingTeam, $winningRow, $losingRow, $oldMatch, $isHomeTeamWinning) {
    if ($oldMatch['HomeScore'] === $oldMatch['AwayScore']) {
        adjustHomeDrawToHomeWin($conn, $winningTeam);
        adjustAwayDrawToAwayLoss($conn, $losingTeam);
    } else {
        if (($oldMatch['HomeScore'] > $oldMatch['AwayScore'] && $isHomeTeamWinning) || ($oldMatch['HomeScore'] < $oldMatch['AwayScore'] && !$isHomeTeamWinning)) {
            return;
        }
        adjustHomeLossToHomeWin($conn, $winningTeam);
        adjustAwayWinToAwayLoss($conn, $losingTeam);
    }
}

function updateDraw($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch) {
    if ($oldMatch['HomeScore'] > $oldMatch['AwayScore']) {
        adjustWinToDraw($conn, $homeTeam);
        adjustLossToDraw($conn, $awayTeam);
        adjustHomeWinToHomeDraw($conn, $homeTeam);
        adjustAwayLossToAwayDraw($conn, $awayTeam);
    } elseif ($oldMatch['HomeScore'] < $oldMatch['AwayScore']) {
        adjustWinToDraw($conn, $awayTeam);
        adjustLossToDraw($conn, $homeTeam);
        adjustAwayWinToAwayDraw($conn, $awayTeam);
        adjustHomeLossToHomeDraw($conn, $homeTeam);
    }
}


function adjustAwayLossToAwayDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET AwayDraws = AwayDraws + 1, AwayLosses = GREATEST(AwayLosses - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustAwayWinToAwayDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET AwayWins = GREATEST(AwayWins - 1, 0), AwayDraws = AwayDraws + 1, AwayPoints = 3 * AwayWins + AwayDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}


function adjustAwayWinToAwayLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET AwayLosses = AwayLosses + 1, AwayWins =  GREATEST(AwayWins - 1, 0), Points = 3 * AwayWins + AwayDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustAwayLossToAwayWin($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET AwayWins = AwayWins + 1, Points = 3 * AwayWins + AwayDraws, AwayLosses =  GREATEST(AwayLosses - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustAwayDrawToAwayLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET AwayLosses = AwayLosses + 1, AwayDraws = GREATEST(AwayDraws - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustAwayDrawToAwayWin($conn, $teamID){
    $stmt = $conn->prepare("UPDATE teams SET AwayWins = AwayWins + 1, AwayPoints = 3 * AwayWins + AwayDraws - 1, AwayDraws =  GREATEST(AwayDraws - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}
//stops here
function adjustHomeLossToHomeDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET HomeDraws = HomeDraws + 1, HomeLosses = GREATEST(HomeLosses - 1, 0), HomePoints = 3 * HomeWins + HomeDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustHomeWinToHomeDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET HomeWins = GREATEST(HomeWins - 1, 0), HomeDraws = HomeDraws + 1, HomePoints = 3 * HomeWins + HomeDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}


function adjustHomeWinToHomeLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET HomeLosses = HomeLosses + 1, HomeWins =  GREATEST(HomeWins - 1, 0), Points = 3 * HomeWins + HomeDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustHomeLossToHomeWin($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET HomeWins = HomeWins + 1, Points = 3 * HomeWins + HomeDraws, HomeLosses =  GREATEST(HomeLosses - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustHomeDrawToHomeLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET HomeLosses = HomeLosses + 1, HomeDraws = GREATEST(HomeDraws - 1, 0), HomePoints = 3 * HomeWins + HomeDraws  WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustHomeDrawToHomeWin($conn, $teamID){
    $stmt = $conn->prepare("UPDATE teams SET HomeWins = HomeWins + 1, HomePoints = 3 * HomeWins + HomeDraws - 1, HomeDraws =  GREATEST(HomeDraws - 1, 0) WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
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

function updateTotalGoals($conn, $teamID, $newGoals, $oldGoals) {
    if($newGoals > $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET Goals = Goals + $newGoals - $oldGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    }

    else if($newGoals <= $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET Goals = Goals + $oldGoals - $newGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();    
    }
    
}

function updateTotalHomeGoals($conn, $teamID, $newGoals, $oldGoals) {
    if($newGoals > $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET HomeGoals = HomeGoals + $newGoals - $oldGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    }

    else if($newGoals <= $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET HomeGoals = HomeGoals + $oldGoals - $newGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();    
    }
    
}

function updateTotalAwayGoals($conn, $teamID, $newGoals, $oldGoals) {
    if($newGoals > $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET AwayGoals = AwayGoals + $newGoals - $oldGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    }

    else if($newGoals <= $oldGoals){
    $stmt = $conn->prepare("UPDATE teams SET AwayGoals = AwayGoals + $oldGoals - $newGoals WHERE teamID = ?;");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();    
    }
    
}

*/