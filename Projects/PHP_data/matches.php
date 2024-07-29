
<?php

require_once 'config.php';

$queryMaxWeek = "SELECT MAX(week) as 'maxWeek' FROM matches";

$maxWeek = $conn->query($queryMaxWeek)->fetch_assoc()['maxWeek'];
$week = 1;


  
  
  echo "

 <tr>
<th> Home </th>
<th> Away </th>
<th> Date </th>
<th> Time </th>
<th> Result </th>

 </tr>

  ";

   while($week <= $maxWeek){
    
    $query = "SELECT * ,
    team1.TeamName as team_home,
    team2.TeamName as team_away,
    SUBSTRING(matchTime, 1, 5) AS matchStart
    FROM matches
    INNER join teams team1
    on matches.HomeTeamID = team1.teamID
    INNER join teams team2
    on matches.AwayTeamID = team2.teamID
    WHERE week = $week
    ORDER BY week ASC ,matchDate ASC, matchTime ASC;";
     
     $result = $conn->query($query);

     echo "
     <tr>
     <th class='matches-weeks' colspan='5'>Week $week</th>
     </tr>
     ";

   while($match = $result->fetch_assoc()){
         
    
     
     echo "

     <tr>
     <td>$match[team_home]</td>
     <td>$match[team_away]</td>
     <td>$match[matchDate]</td>
     <td>$match[matchStart]</td>
     <td>$match[HomeScore]:$match[AwayScore]</td>
     </tr>


     ";
     
   }
   $week++;
  }
?>
