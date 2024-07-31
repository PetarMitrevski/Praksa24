<?php

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}

$id = $_GET["id"];

$sql = "
DELETE FROM teams WHERE teamID = '$id';";

$sql2 = "SELECT * FROM teams WHERE teamID = $id";

$team = $conn->query($sql2)->fetch_assoc()['TeamName'];

if($conn->query($sql)){
    
    $insert = "INSERT INTO changes(changeText,UserName) VALUE('The team $team was deleted','$_SESSION[User]')";
    $conn->query($insert);

    header("Location: ../home.php");
    exit;
}

else
echo "Invalid query";

$conn->close();
