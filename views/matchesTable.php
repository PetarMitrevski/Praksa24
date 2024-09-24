<table class="clubs clubs__table-matches">

<tr>
<th> Home </th>
<th> Away </th>
<th> Date </th>
<th> Time </th>
<th> Result </th>

 </tr>

 <?php
 $week = 1;
 while($week <= $maxWeek) {
   
   $query = "
   SELECT matchID, team1.TeamName as team_home, team2.TeamName as team_away, matchDate, SUBSTRING(matchTime, 1, 5) AS matchStart, HomeScore, AwayScore FROM matches
      INNER JOIN teams as team1 ON matches.HomeTeamID = team1.teamID  
      INNER JOIN teams as team2 ON matches.AwayTeamID = team2.teamID
      WHERE week = $week
      ORDER BY week ASC, matchDate ASC, matchTime ASC
   ";

   $result = $conn->query($query);

    echo "
    <tr>
     <th class='matches-weeks' colspan='7'>Week $week</th>
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
        <td><button><a href='edit_match.php?id=$match[matchID]'>Edit</a></button></td>
        <td><button><a href='Edit_Delete/delete_match_exec.php?id=$match[matchID]'>Delete</a></button> </td>
        </tr>
        ";
        
      }

    $week++;
 }
?>

 </table>