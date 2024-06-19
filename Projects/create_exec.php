<?php
//
//db connection
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
    
    $team = $_POST["Team"];
    $wins = $_POST["Wins"];
    $draws = $_POST["Draws"];
    $losses = $_POST["Losses"];
    
    $points = $wins * 3 + $draws;
    
    $sql = "INSERT INTO teams(TeamName,Points,Wins,Draws,Losses)
    VALUE ('$team', $points, $wins, $draws, $losses);";
   
    
   if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
    
    

    
}



?>