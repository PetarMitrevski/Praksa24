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


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = htmlspecialchars($_POST['identifier']);
    $week = htmlspecialchars($_POST['Week']);
    $homeTeam = htmlspecialchars($_POST['Home']);
    $awayTeam = htmlspecialchars($_POST['Away']);
    $homeScore = htmlspecialchars($_POST['Home_score']);
    $awayScore = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);



    $sql = "UPDATE matches
    SET week = $week, HomeTeamID = $homeTeam, AwayTeamID = $awayTeam, HomeScore = $homeScore, AwayScore = $awayScore, matchDate = '$matchDate', matchTime = '$matchTime'
    WHERE matchID = $id  
    ";

    if($homeTeam != $awayTeam){
        $conn->query($sql);
        header("Location: ../index.php");
        exit;
    }

    else{
        header("Location: ../index.php");
        exit;
    }
    
    $conn->close();
     exit;
}