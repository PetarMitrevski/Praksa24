<?php

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $team = htmlspecialchars($_POST["Team"]);
    $wins = htmlspecialchars($_POST["Wins"]);
    $draws = htmlspecialchars($_POST["Draws"]);
    $losses = htmlspecialchars($_POST["Losses"]);
    
    $points = $wins * 3 + $draws;
    
    $sql = "INSERT INTO teams(TeamName,Points,Wins,Draws,Losses)
    VALUE ('$team', $points, $wins, $draws, $losses);";
   
    
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