<?php

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}



if($_SERVER["REQUEST_METHOD"] == "POST"){


 $week = htmlspecialchars($_POST['Week']);
 $home = htmlspecialchars($_POST['Home']);
 $away = htmlspecialchars($_POST['Away']);
 $homeScore = htmlspecialchars($_POST['Home_score']);
 $awayScore = htmlspecialchars($_POST['Away_score']);
 $matchDate = htmlspecialchars($_POST['Match_date']);
 $matchTime = htmlspecialchars($_POST['Match_time']);


 $check = "SELECT COUNT(*) as entry
  FROM matches
  WHERE HomeTeamID = $home AND AwayTeamID = $away;";

   $checking = $conn->query($check);
   $canInsert = $checking->fetch_assoc();

 if(!($canInsert['entry'] > 0)){
 if($home !== $away){

 $statement = "INSERT INTO matches(HomeTeamID,AwayTeamID,week,matchDate,matchTime,HomeScore,AwayScore)
 VALUE($home,$away,$week,'$matchDate','$matchTime',$homeScore,$awayScore)
 ORDER BY matchDate ASC, matchTime ASC;";

 

 if($homeScore > $awayScore){
    
    $query = "UPDATE teams
    SET Wins = Wins + 1, Points = 3 * Wins + Draws
    WHERE teamID = $home;";

    $query2 = "UPDATE teams 
    Set Losses = Losses + 1
    Where teamID = $away
    ORDER BY Points DESC;";

   $conn->query($query);
   $conn->query($query2);
 }

 else if($homeScore < $awayScore){

    $query = "UPDATE teams
    SET Losses = Losses + 1
    WHERE teamID = $home;";

    $query2 = "UPDATE teams 
    Set Wins = Wins + 1, Points = 3 * Wins + Draws
    Where teamID = $away
    ORDER BY Points DESC;";

   $conn->query($query);
   $conn->query($query2);
    
    
 }

 else{
    
    $query = "UPDATE teams
    SET Draws = Draws + 1, Points = 3 * Wins + Draws
    WHERE teamID = $home;";

    $query2 = "UPDATE teams 
    Set Draws = Draws + 1, Points = 3 * Wins + Draws
    Where teamID = $away
    ORDER BY Points DESC;";

   $conn->query($query);
   $conn->query($query2);
    
 }

 
 $conn->query($statement);
 header("Location: ../index.php");
 exit;

}
 
}


else{
header("Location: ../index.php");
exit;
}

}


$conn->close();
 




