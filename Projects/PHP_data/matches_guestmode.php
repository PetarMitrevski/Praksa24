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
 <h5>Week $i</h5>
  ";
   while($match = $result->fetch_assoc()){
         
     echo "
     
     <div>
     <p>$match[matchDate] | $match[matchStart] | $match[team_home] - $match[team_away] $match[HomeScore]:$match[AwayScore] </p>
     </div>

     ";
     
   }

  echo "</article>";
  $i++;
 }

  
?>

</section>