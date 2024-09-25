<?php
require_once "../classes/matchClasses/MatchContr.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = htmlspecialchars($_POST["identifier"]);
    $homeScore = htmlspecialchars($_POST["Home_score"]);
    $awayScore = htmlspecialchars($_POST["Away_score"]);

    $editMatch = new MatchContr;
    $editMatch->updateMatch($id, $homeScore, $awayScore);
}