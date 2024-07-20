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
 <th>TN</th>
 <th>MP</th>
 <th>W</th>
 <th>D</th>
 <th>L</th>
 <th>P</th>
 <th>G</th>
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
 $row[MatchesPlayedHome]
</td>
<td>
 $row[HomeWins]
</td>
<td>
 $row[HomeDraws]
</td>
<td>
 $row[HomeLosses]
</td>
<td>
 $row[HomePoints]
</td>
<td>
$row[HomeGoals]
</td>

</tr>
  ";
  $number++;
}