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
 <th>WINS</th>
 <th>DRAWS</th>
 <th>LOSES</th>
 <th>POINTS</th>
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
<button><a href='edit.php?id=$row[teamID]'>Edit</a></button>
</td>

<td>
<button><a href='Edit_Delete/delete_exec.php?id=$row[teamID]'>Delete</a></button>
</td>

</tr>
  ";
  $number++;
}
