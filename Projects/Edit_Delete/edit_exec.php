<?php
require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}


if($_SERVER["REQUEST_METHOD"] == "GET"){
          
    if(!isset($_GET['id'])){
        exit;
    }

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM teams WHERE teamID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        exit;
    }

    echo "Team: $row[TeamName] Points: $row[Points] Wins: $row[Wins] Draws: $row[Draws] Losses: $row[Losses]"; 

    
}

else{
      
    $id = htmlspecialchars($_POST['id']);
    $team = htmlspecialchars($_POST["Team"]);
    $homeWins = htmlspecialchars($_POST["Home_Wins"]);
    $awayWins = htmlspecialchars($_POST["Away_Wins"]);
    $homeDraws = htmlspecialchars($_POST["Home_Draws"]);
    $awayDraws = htmlspecialchars($_POST["Away_Draws"]);
    $homeLosses = htmlspecialchars($_POST["Home_Losses"]);
    $awayLosses = htmlspecialchars($_POST["Away_Losses"]);

    $sql = "UPDATE teams 
    SET TeamName = '$team', HomeWins = $homeWins, AwayWins = $awayWins, HomeDraws = $homeDraws, AwayDraws = $awayDraws, HomeLosses = $homeLosses, AwayLosses = $awayLosses, Wins = $homeWins + $awayWins, Draws = $homeDraws + $awayDraws, Losses = $homeLosses + $awayLosses, HomePoints = 3 * HomeWins + HomeDraws, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints 
    WHERE teamID = '$id'  
    ";

    $result = $conn->query($sql);
 
    if(!$result){
        echo "Invalid query";
    }

    else{
    header("Location: ../index.php");
    exit;    
}
    $conn->close();
     exit;
    

}