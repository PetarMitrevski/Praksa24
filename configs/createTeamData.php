<?php
function myAutoloader($class) {

    $file = '../classes/teamClasses/' . $class . '.php';
    if (file_exists($file))
        require_once $file;
}


spl_autoload_register('myAutoloader');

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $teamName = htmlspecialchars($_POST["Team"]);
    $homeWins = htmlspecialchars($_POST["Home_Wins"]);
    $awayWins = htmlspecialchars($_POST["Away_Wins"]);
    $homeDraws = htmlspecialchars($_POST["Home_Draws"]);
    $awayDraws = htmlspecialchars($_POST["Away_Draws"]);
    $homeLosses = htmlspecialchars($_POST["Home_Losses"]);
    $awayLosses = htmlspecialchars($_POST["Away_Losses"]);

    $insert = new TeamContr;

    $insert->addTeam($teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses);



    
}