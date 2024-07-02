<?php

require_once '../PHP_data/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = htmlspecialchars($_POST['identifier']);
    $week = htmlspecialchars($_POST['Week']);
    $homeTeam = htmlspecialchars($_POST['Home']);
    $awayTeam = htmlspecialchars($_POST['Away']);
    $homeScore_new = htmlspecialchars($_POST['Home_score']);
    $awayScore_new = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);

    if ($homeTeam !== $awayTeam) {
        $conn->begin_transaction();

        try {
            $oldMatch = getMatchById($conn, $id);
            $homeRow = getTeamById($conn, $homeTeam);
            $awayRow = getTeamById($conn, $awayTeam);

            updateMatch($conn, $id, $week, $homeTeam, $awayTeam, $homeScore_new, $awayScore_new, $matchDate, $matchTime);

            if ($homeScore_new > $awayScore_new) {
                updateWinLoss($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch, true);
            } elseif ($homeScore_new < $awayScore_new) {
                updateWinLoss($conn, $awayTeam, $homeTeam, $awayRow, $homeRow, $oldMatch, false);
            } else {
                updateDraw($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch);
            }

            $conn->commit();
            header("Location: ../index.php");
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            header("Location: ../index.php?error=1");
            exit;
        }
    } else {
        header("Location: ../index.php?error=2");
        exit;
    }
}

$conn->close();
exit;

function getMatchById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM matches WHERE matchID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getTeamById($conn, $teamID) {
    $stmt = $conn->prepare("SELECT * FROM teams WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateMatch($conn, $id, $week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime) {
    $stmt = $conn->prepare("UPDATE matches SET week = ?, HomeTeamID = ?, AwayTeamID = ?, HomeScore = ?, AwayScore = ?, matchDate = ?, matchTime = ? WHERE matchID = ?");
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
    $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws - 1, Draws = Draws - 1 WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustDrawToLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Draws = Draws - 1, Points = 3 * Wins + Draws WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustLossToWin($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = Losses - 1 WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustWinToLoss($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Wins = Wins - 1, Points = 3 * Wins + Draws  WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustWinToDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Wins = Wins - 1, Draws = Draws + 1, Points = 3 * Wins + Draws  WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}

function adjustLossToDraw($conn, $teamID) {
    $stmt = $conn->prepare("UPDATE teams SET Draws = Draws + 1, Losses = Losses - 1, Points = 3 * Wins + Draws  WHERE teamID = ?");
    $stmt->bind_param("i", $teamID);
    $stmt->execute();
}
?>
