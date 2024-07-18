<?php

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $team = htmlspecialchars($_POST["Team"]);
    $homeWins = htmlspecialchars($_POST["Home_Wins"]);
    $awayWins = htmlspecialchars($_POST["Away_Wins"]);
    $homeDraws = htmlspecialchars($_POST["Home_Draws"]);
    $awayDraws = htmlspecialchars($_POST["Away_Draws"]);
    $homeLosses = htmlspecialchars($_POST["Home_Losses"]);
    $awayLosses = htmlspecialchars($_POST["Away_Losses"]);
    
    $homePoints = 3 * $homeWins + $homeDraws;
    $awayPoints = 3 * $awayWins + $awayDraws;
    $points = $homePoints + $awayPoints; 

    $wins = $homeWins + $awayWins;
    $draws = $homeDraws + $awayDraws;
    $losses = $homeLosses + $awayLosses;
    
    $sql = "INSERT INTO teams(TeamName, Points, Wins, Draws, Losses, HomePoints, AwayPoints, HomeWins, AwayWins, HomeDraws, AwayDraws, HomeLosses, AwayLosses)
    VALUE ('$team', $points, $wins, $draws, $losses, $homePoints, $awayPoints, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses);";
   
    
   if ($conn->query($sql)) {
   header("Location: ../index.php");
   exit;
} else {
    
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
    
exit;

    
}



?>