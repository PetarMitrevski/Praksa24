<?php

require_once 'config.php';


$sql = "SELECT * FROM teams ORDER BY Points DESC";
$result = $conn->query($sql);
$number = 1;

if(!$result)
die("Invalid query");


 
echo "
  <tr>
 <th>#</th>
 <th>TEAM</th>
 <th>MATCHES PLAYED</th>
 <th>WINS</th>
 <th>DRAWS</th>
 <th>LOSES</th>
 <th>POINTS</th>
 <th>GOALS</th>
 </tr>
";

while($row = $result->fetch_assoc()){
 
 echo "
  <tr>
<td>
 $number.
</td>
<td>
  $row[TeamName]
</td>
<td>
$row[MatchesPlayed]
</td>
<td>
 $row[AwayWins]
</td>
<td>
 $row[AwayDraws]
</td>
<td>
 $row[AwayLosses]
</td>
<td>
 $row[AwayPoints]
</td>
<td>
$row[AwayGoals]
</td>

</tr>
  ";
  $number++;
}