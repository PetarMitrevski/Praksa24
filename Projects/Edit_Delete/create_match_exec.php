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


 
 if(!($home === $away)){
 $statement = "INSERT INTO matches(HomeTeamID,AwayTeamID,week,matchDate,matchTime,HomeScore,AwayScore)
 VALUE($home,$away,$week,'$matchDate','$matchTime',$homeScore,$awayScore);";
 
 $conn->query($statement);
 echo "Match added sucessfully";

 }

else
echo "Cannot add match";



$conn->close();
 
}


