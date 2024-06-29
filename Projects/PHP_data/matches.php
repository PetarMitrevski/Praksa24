<section class="matches">

<?php

require_once 'config.php';

 $sql = "SELECT MAX(week) AS weeks
 FROM matches";
 
 $row = $conn->query($sql);

 $maxWeek = $row->fetch_assoc();
 $i = 1;



 while($maxWeek['weeks']>= $i){

    $query = "SELECT * ,
    team1.TeamName as team_home,
    team2.TeamName as team_away,
    SUBSTRING(matchTime, 1, 5) AS matchStart
    FROM matches
    INNER join teams team1
    on matches.HomeTeamID = team1.teamID
    INNER join teams team2
    on matches.AwayTeamID = team2.teamID
    WHERE week = $i
    ORDER BY matchDate ASC, matchTime ASC;";
  
  $result = $conn->query($query);
 
  echo "
 <article>
 <h4>Week $i</h4>
  ";
   while($match = $result->fetch_assoc()){
         
     echo "
     
     <div style='display:flex; column-gap:1rem; margin:0.5rem;'>
     <h5>$match[matchDate] | $match[matchStart] | $match[team_home] - $match[team_away] $match[HomeScore]:$match[AwayScore]  </h5>
     <button><a href='edit_match.php?id=$match[matchID]'>Edit</a></button>
     <button><a href='Edit_Delete/delete_match_exec.php?id=$match[matchID]'>Delete</a></button> 
     </div>

     ";
     
   }

  echo "</article>";
  $i++;
 }

  
?>

</section>