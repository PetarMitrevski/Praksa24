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
    $wins = htmlspecialchars($_POST["Wins"]);
    $draws = htmlspecialchars($_POST["Draws"]);
    $losses = htmlspecialchars($_POST["Losses"]);

    $sql = "UPDATE teams 
    SET TeamName = '$team', Wins = '$wins', Draws = '$draws', Losses = '$losses', Points = Wins * 3 + Draws
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