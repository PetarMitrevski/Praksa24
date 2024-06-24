<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "premier league";
//insert into...


$conn = new mysqli($servername, $username, $password, $database);

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

 
 $query = "SELECT * ,
 team1.TeamName as team_home,
 team2.TeamName as team_away
 FROM matches
 INNER join teams team1
 on matches.HomeTeamID = team1.teamID
 INNER join teams team2
 on matches.AwayTeamID = team2.teamID;
 INSERT INTO matches(week,team_home,team_away,HomeScore,AwayScore,matchDate,matchTime)
 value($week,$home,$away,$homeScore, $awayScore, '$matchDate', '$matchTime');";

echo $query;
if($conn->query($query)){
    $conn->query($query);
    echo "Match added sucessfully";
}


$conn->close();
 
}


