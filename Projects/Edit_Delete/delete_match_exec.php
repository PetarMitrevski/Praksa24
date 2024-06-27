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

$id = $_GET["id"];

$sql = "
DELETE FROM matches WHERE matchID = '$id';";

$conn->query($sql);

if($conn->query($sql)){
    header("Location: ../index.php");
    exit;
}

else
echo "Invalid query";

$conn->close();
