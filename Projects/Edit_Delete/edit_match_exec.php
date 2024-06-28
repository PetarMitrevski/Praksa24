<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "premier league";
//insert into...


$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = htmlspecialchars($_POST['identifier']);
    $week = htmlspecialchars($_POST['Week']);
    $homeTeam = htmlspecialchars($_POST['Home']);
    $awayTeam = htmlspecialchars($_POST['Away']);
    $homeScore = htmlspecialchars($_POST['Home_score']);
    $awayScore = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);



    $sql = "UPDATE matches
    SET week = $week, HomeTeamID = $homeTeam, AwayTeamID = $awayTeam, HomeScore = $homeScore, AwayScore = $awayScore, matchDate = '$matchDate', matchTime = '$matchTime'
    WHERE matchID = $id  
    ";

     $homeQuery = "SELECT * from teams WHERE teamID =  $homeTeam;";
     $awayQuery = "SELECT * from teams WHERE teamID = $awayTeam;";
     
     $homeQueryResult = $conn->query($homeQuery);
     $awayQueryResult = $conn->query($awayQuery);

     $homeRow = $homeQueryResult->fetch_assoc();
     $awayRow = $awayQueryResult->fetch_assoc(); 

    
    if($homeTeam !== $awayTeam){
       
       
       if( ($homeScore > $awayScore) ){
         //proveri od baza vrednosta if($homeRow['Losses'] >0)
         
         if($homeRow['Losses'] > 0){
            
            $query = "UPDATE teams
            SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = Losses - 1  
            WHERE teamID = $homeTeam; 
           ";
           $conn->query($query);
         }

         else{

            $query = "UPDATE teams
            SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = 0 
            WHERE teamID = $homeTeam; 
           ";
           $conn->query($query);

         }
           $query2 = "UPDATE teams
           SET Losses = Losses + 1
           WHERE teamID = $awayTeam;
           ";
   
           
           $conn->query($query2);


         }

         

       else if( ($homeScore < $awayScore) ){

        if($awayRow['Losses'] > 0){
            
            $query = "UPDATE teams
            SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = Losses - 1  
            WHERE teamID = $awayTeam; 
           ";
           $conn->query($query);
         }

         else{

            $query = "UPDATE teams
            SET Wins = Wins + 1, Points = 3 * Wins + Draws, Losses = 0 
            WHERE teamID = $awayTeam; 
           ";
           $conn->query($query);

         }
           $query2 = "UPDATE teams
           SET Losses = Losses + 1
           WHERE teamID = $homeTeam;
           ";
   
           
           $conn->query($query2);

       }

       else{

        $query = "UPDATE teams
        SET Draws = Draws + 1, Points = 3 * Wins + Draws 
        WHERE teamID = $awayTeam; 
       ";
       
       $query2 = "UPDATE teams
       SET Draws = Draws + 1, Points = 3 * Wins + Draws  
       WHERE teamID = $homeTeam;
       ";

       $conn->query($query);
       $conn->query($query2);

       }


        $conn->query($sql);
        header("Location: ../index.php");
        exit;
    }


    else{
        header("Location: ../index.php");
        exit;
    }
    
    $conn->close();
     exit;
}