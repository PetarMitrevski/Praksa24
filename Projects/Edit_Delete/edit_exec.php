<?php
session_start();

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}


if($_SERVER["REQUEST_METHOD"] == "GET"){
          
    if(!isset($_GET['id'])){
        exit;
    }

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM teams WHERE teamID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        exit;
    }

    echo "Team: $row[TeamName] Points: $row[Points] Wins: $row[Wins] Draws: $row[Draws] Losses: $row[Losses]"; 

    
}

else{
      
    $id = htmlspecialchars($_POST['id']);
    $team = htmlspecialchars($_POST["Team"]);
    $homeWins = htmlspecialchars($_POST["Home_Wins"]);
    $awayWins = htmlspecialchars($_POST["Away_Wins"]);
    $homeDraws = htmlspecialchars($_POST["Home_Draws"]);
    $awayDraws = htmlspecialchars($_POST["Away_Draws"]);
    $homeLosses = htmlspecialchars($_POST["Home_Losses"]);
    $awayLosses = htmlspecialchars($_POST["Away_Losses"]);

    $sql = "UPDATE teams 
    SET TeamName = '$team', HomeWins = $homeWins, AwayWins = $awayWins, HomeDraws = $homeDraws, AwayDraws = $awayDraws, HomeLosses = $homeLosses, AwayLosses = $awayLosses, Wins = $homeWins + $awayWins, Draws = $homeDraws + $awayDraws, Losses = $homeLosses + $awayLosses, HomePoints = 3 * HomeWins + HomeDraws, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints 
    WHERE teamID = '$id'  
    ";

    $oldTeamQuery = "SELECT * FROM teams WHERE teamID = $id";

    $oldTeam = $conn->query($oldTeamQuery)->fetch_assoc();

    $result = $conn->query($sql);
    
 
    if(!$result){
        echo "Invalid query";
    }

    else{
        


        $change = "";

        
        if($oldTeam['HomeWins'] !== $homeWins){
        
            $change = $oldTeam["TeamName"] . " home wins changed from " .  $oldTeam['HomeWins'] . " to $homeWins ";

            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);

        }
       
    
        if($oldTeam['AwayWins'] !== $awayWins){
    
            $change =  $oldTeam["TeamName"] . " away wins changed from " .  $oldTeam['AwayWins'] . " to $awayWins"; 

            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);
        
    }


        if($oldTeam['HomeDraws'] !== $homeDraws){
        
            $change = $oldTeam["TeamName"] . " home draws changed from " .  $oldTeam['HomeDraws'] . " to $homeDraws";
        
            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);

        }
        

        if($oldTeam['AwayDraws'] !== $awayDraws){
        
            $change = $oldTeam["TeamName"] . " away draws changed from " .  $oldTeam['AwayDraws'] . " to $awayDraws";

            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);

        }
       

        if($oldTeam['HomeLosses'] !== $homeLosses){

            $change = $oldTeam["TeamName"] . " home losses changed from " .  $oldTeam['HomeLosses'] . " to $homeLosses";
        
            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);


        }
       

        if($oldTeam['AwayLosses'] !== $awayLosses){

            $change = $oldTeam["TeamName"] . " away losses changed from " .  $oldTeam['Away Losses'] . " to $homeLosses";

            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);
        }


        if($oldTeam['TeamName'] !== $team){

            $change = "Team name changed from " .  $oldTeam['TeamName'] . " to $team";

            $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change', '$_SESSION[User]', 'Teams')";
            $conn->query($insert);

    }    
        

        $conn->close();
        header("Location: ../home.php");
        exit;    
}
    
}