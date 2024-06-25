<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "premier league";


$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}

 $sql = "SELECT MAX(week) AS weeks
 FROM matches";
 
  echo $sql['weeks'];
  
  $query = "SELECT * ,
    team1.TeamName as team_home,
    team2.TeamName as team_away
    FROM matches
    INNER join teams team1
    on matches.HomeTeamID = team1.teamID
    INNER join teams team2
    on matches.AwayTeamID = team2.teamID
    WHERE week = 1;";
  
  $result = $conn->query($query);

  
   while($match = $result->fetch_assoc()){
         
     echo "
     <h5>$match[matchDate] $match[matchTime] | $match[team_home] - $match[team_away] $match[HomeScore]:$match[AwayScore]  </h5> ";

   }