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
 <th>Team</th>
 <th>Matches Played</th>
 <th>W</th>
 <th>D</th>
 <th>L</th>
 <th>Pts</th>
 <th>Goals</th>
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

<td>
<button><a href='edit.php?id=$row[teamID]'>Edit</a></button>
</td>

<td>
<button><a href='Edit_Delete/delete_exec.php?id=$row[teamID]'>Delete</a></button>
</td>

</tr>
  ";
  $number++;
}
