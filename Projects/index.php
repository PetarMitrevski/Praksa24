<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="icon" href="data:image/jpeg;base64,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RAREQEREBERBBONlT4HD+Vt95JIWD9oHn8GFa5K7v7QtUWYTSRWOl0r3l1jYFjNIBPK51usPQqkV08X4unin/IiItGoiIgIszlvK1ZmabTTQOc29jIdmN9rzt7hc+ilmeeGwynlOOo8UyzeKGykCzQ17TbS3nYOAFzudXIclW5TelblJdK6WeyVliXNmOtgZcMHmlkH0I+p+0eQHf0BXnyxl2ozPiYggZc7Fzj81jfrOPQenM9Fsrk/K8GVMIEEQuTvJIRu9/c9h2HQe8queeleTPqy1BRx4fRMhjaGxsaGtaOjWiwXeiLmcoiIgIiICIiAiIgIiICIiAiIgIiICIiDqqadlXAWSMa9jhYtcAQR6g7FQLHOEGG4i4ui8Smcf8s3b+o+9h6NIVhIpls8TLZ4o6r4HVDD8lWwv+2xzP/EuXjbwTxEu3npAPtS/w8NX6iv/AC5L/wAuSlqHga8uHjV7QOojiJPuc5wt8CphgnCjC8LIc6J1Q8dZjqH7MAMPvBU5RVueVRc8r/b4iibDGGtaGtAsAAAAPQDksdmbA48x4HJSyEhkgbcttcFrg4EX2vcBZRFVRjMv4DTZdw8Q08QYwbnu531nO5ud6lZNEQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERB//9k="/>
    <link rel="stylesheet" href="CSS/main.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Premier League</title>
</head>
<body>

<?php
include 'views/navigation.html';

?>

<section class="Weeks">

<article>
  <h3>Week 1</h3>
  
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

</article>

</section>

<section class="clubs">
  
<table id="table_overall" class="clubs__table-overall">
       
        <?php
           

           $servername = "localhost";
           $username = "root";
           $password = "";
           $database = "premier league";


           

        


          $sql = "SELECT * FROM teams";
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
        ?>
        </table>
        </section>
        
        <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>

        </body>
        </html>


