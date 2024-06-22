<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "premier league";



$conn = new mysqli($servername, $username, $password, $database);

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
      
    $id = $_POST['id'];
    $team = $_POST["Team"];
    $wins = $_POST["Wins"] ;
    $draws = $_POST["Draws"];
    $losses = $_POST["Losses"];

    $sql = "UPDATE teams 
    SET TeamName = '$team', Wins = '$wins', Draws = '$draws', Losses = '$losses', Points = Wins * 3 + Draws
    WHERE teamID = '$id'  
    ";

    $result = $conn->query($sql);
 
    if(!$result){
        echo "Invalid query";
    }

    else
    echo "Record changed sucessfully";

    $conn->close();
     exit;
    

}