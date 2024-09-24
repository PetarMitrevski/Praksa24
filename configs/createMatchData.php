<?php
require_once "../classes/matchClasses/MatchContr.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $week = htmlspecialchars($_POST["Week"]);
    $homeTeam = htmlspecialchars($_POST["Home"]);
    $awayTeam = htmlspecialchars($_POST["Away"]);
    $homeScore = htmlspecialchars($_POST["Home_score"]);
    $awayScore = htmlspecialchars($_POST["Away_score"]);
    $matchDate = htmlspecialchars($_POST["Match_date"]);
    $matchTime = htmlspecialchars($_POST["Match_time"]);


    $insert = new MatchContr;
    $insert->insertMatch($week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime);
    unset($insert);

}