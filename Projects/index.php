<?php
include 'views/navigation.php';

?>

  
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "premier league";


$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}

  
 
  $query = "SELECT * ,
    team1.TeamName as team_home,
    team2.TeamName as team_away
    FROM matches
    INNER join teams team1
    on matches.HomeTeamID = team1.teamID
    INNER join teams team2
    on matches.AwayTeamID = team2.teamID
    WHERE week = 1;";
  
  $result = $conn->query($query);

  
   while($match = $result->fetch_assoc()){
         
     echo "
     <h5>$match[matchDate] $match[matchTime] | $match[team_home] - $match[team_away] $match[HomeScore]:$match[AwayScore]  </h5> ";

     
     if(($match['HomeScore'] > $match['AwayScore'])){
      
        $order ="
      UPDATE teams
      SET Points = Points + 3,Wins = Wins + 1
      WHERE TeamName = '$match[team_home]';
      ";
      
      $conn->query($order);
     }

   }

   ?>


<section class="clubs">
  
<table id="table_overall" class="clubs__table-overall">
       
        <?php
           
         include "PHP_data/teams.php";
          
        ?>
        </table>
        </section>
        
        <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>

        </body>
        </html>


