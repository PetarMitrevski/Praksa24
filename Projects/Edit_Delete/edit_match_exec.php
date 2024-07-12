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
    $oldMatch = getMatchById($conn, $id);

    if ($homeTeam !== $awayTeam) {

          
    } 


    
    else {
        header("Location: ../index.php?error=2");
        exit;
    }
}

$conn->close();
exit;

?>