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
$row[MatchesPlayed]
</td>
<td>
 $row[Wins]
</td>
<td>
 $row[Draws]
</td>
<td>
 $row[Losses]
</td>
<td>
 $row[Points]
</td>
<td>
$row[Goals]
</td>

</tr>
  ";
  $number++;
}