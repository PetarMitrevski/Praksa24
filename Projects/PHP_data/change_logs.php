<?php

require_once 'config.php';

if($_SESSION['editType'] === "Teams" || $_SESSION['editType'] === "Matches")
$query = "SELECT * FROM changes 
JOIN users ON changes.UserName = users.UserName
WHERE users.editType = '$_SESSION[editType]' 
ORDER BY dateChanged DESC, timeChanged DESC";

else 
$query = "SELECT * FROM changes 
JOIN users ON changes.UserName = users.UserName
ORDER BY dateChanged DESC, timeChanged DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
                
        echo $row['changeText'] . " by " . $row['UserName'] . " on " . $row['dateChanged'] . " " . $row['timeChanged'] . "<br>";
    }

}





