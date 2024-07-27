
<?php

require_once 'config.php';


    $query = "SELECT * ,
    team1.TeamName as team_home,
    team2.TeamName as team_away,
    SUBSTRING(matchTime, 1, 5) AS matchStart
    FROM matches
    INNER join teams team1
    on matches.HomeTeamID = team1.teamID
    INNER join teams team2
    on matches.AwayTeamID = team2.teamID
    ORDER BY week ASC ,matchDate ASC, matchTime ASC;";
  
  $result = $conn->query($query);
 
  echo "

 <tr>
<th> H </th>
<th> A </th>
<th> W </th>
<th> D </th>
<th> T </th>
<th> HS </th>
<th> AS </th>

 </tr>

  ";
   while($match = $result->fetch_assoc()){
         
     echo "
      
     <tr>
     <td>$match[team_home]</td>
     <td>$match[team_away]</td>
     <td>$match[week]</td>
     <td>$match[matchDate]</td>
     <td>$match[matchStart]</td>
     <td>$match[HomeScore]</td>
     <td>$match[AwayScore]</td>
     <td><button><a href='edit_match.php?id=$match[matchID]'>Edit</a></button></td>
     <td><button><a href='Edit_Delete/delete_match_exec.php?id=$match[matchID]'>Delete</a></button> </td>
     
     </tr>


     ";
     
   }

?>
