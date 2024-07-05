<?php

require_once '../PHP_data/config.php';
require_once '../PHP_data/functions.php';

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

            updateTotalGoals($conn, $homeTeam, $homeScore_new, $oldMatch["HomeScore"]);
            updateTotalGoals($conn, $awayTeam, $awayScore_new, $oldMatch["AwayScore"]);

            if ($homeScore_new > $awayScore_new) {
                updateWinLoss($conn, $homeTeam, $awayTeam, $homeRow, $awayRow, $oldMatch, true);
            } else if ($homeScore_new < $awayScore_new) {
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

?>
