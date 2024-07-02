<?php


require_once '../PHP_data/config.php';


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

function updateTeamStats($conn, $winningTeam, $losingTeam, $winningRow, $losingRow, $oldMatch, $isHomeTeamWinning) {
  if ($oldMatch['HomeScore'] === $oldMatch['AwayScore']) {
      updateDrawToWin($conn, $winningTeam, $winningRow, $isHomeTeamWinning);
      updateDrawToLoss($conn, $losingTeam, $losingRow, !$isHomeTeamWinning);
  } else {
      if ($oldMatch['HomeScore'] > $oldMatch['AwayScore'] && $isHomeTeamWinning || $oldMatch['HomeScore'] < $oldMatch['AwayScore'] && !$isHomeTeamWinning) {
          return; // No need to update if the result is the same
      }

      updateLossToWin($conn, $winningTeam, $winningRow);
      updateWinToLoss($conn, $losingTeam, $losingRow);
  }
}

function updateDrawStats($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch) {
  if ($oldMatch['HomeScore'] > $oldMatch['AwayScore']) {
      updateWinToDraw($conn, $homeTeam, $homeRow);
      updateLossToDraw($conn, $awayTeam, $awayRow);
  } elseif ($oldMatch['HomeScore'] < $oldMatch['AwayScore']) {
      updateWinToDraw($conn, $awayTeam, $awayRow);
      updateLossToDraw($conn, $homeTeam, $homeRow);
  } else {
      return; // No need to update if the result is the same
  }
}

function updateDrawToWin($conn, $teamID, $teamRow, $isHomeTeam) {
  $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws, Draws = Draws - 1 WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}

function updateDrawToLoss($conn, $teamID, $teamRow, $isHomeTeam) {
  $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Draws = Draws - 1 WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}

function updateLossToWin($conn, $teamID, $teamRow) {
  $stmt = $conn->prepare("UPDATE teams SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = Losses - 1 WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}

function updateWinToLoss($conn, $teamID, $teamRow) {
  $stmt = $conn->prepare("UPDATE teams SET Losses = Losses + 1, Wins = Wins - 1, Points = 3 * Wins + Draws WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}

function updateWinToDraw($conn, $teamID, $teamRow) {
  $stmt = $conn->prepare("UPDATE teams SET Wins = Wins - 1, Draws = Draws + 1, Points = 3 * Wins + Draws WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}

function updateLossToDraw($conn, $teamID, $teamRow) {
  $stmt = $conn->prepare("UPDATE teams SET Draws = Draws + 1, Losses = Losses - 1, Points = 3 * Wins + Draws WHERE teamID = ?");
  $stmt->bind_param("i", $teamID);
  $stmt->execute();
}






if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = htmlspecialchars($_POST['identifier']);
    $week = htmlspecialchars($_POST['Week']);
    $homeTeam = htmlspecialchars($_POST['Home']);
    $awayTeam = htmlspecialchars($_POST['Away']);
    $homeScore_new = $homeScore = htmlspecialchars($_POST['Home_score']);
    $awayScore_new = $awayScore = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);

    if ($homeTeam !== $awayTeam) {
        $conn->begin_transaction();

        try {
            $oldMatch = getMatchById($conn, $id);
            $homeRow = getTeamById($conn, $homeTeam);
            $awayRow = getTeamById($conn, $awayTeam);

            updateMatch($conn, $id, $week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime);

            if ($homeScore_new > $awayScore_new) {
                updateTeamStats($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch, true);
            } else if ($homeScore_new < $awayScore_new) {
                updateTeamStats($conn, $awayTeam, $homeTeam, $awayRow, $homeRow, $oldMatch, false);
            } else {
                updateDrawStats($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch);
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
