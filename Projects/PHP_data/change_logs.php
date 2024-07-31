<?php

require_once 'config.php';


$query = "SELECT * FROM changes 
JOIN users ON changes.UserName = users.UserName
WHERE users.editType = '$_SESSION[editType]' 
ORDER BY dateChanged DESC, timeChanged DESC";

$result = $conn->query($query)->fetch_all(MYSQLI_ASSOC);

echo $result;









