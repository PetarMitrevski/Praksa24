<?php
session_start();

require_once '../PHP_data/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $id = htmlspecialchars($_POST['identifier']);
    $homeTeam = htmlspecialchars($_POST['Home']);
    $awayTeam = htmlspecialchars($_POST['Away']);
    $homeScore_new = htmlspecialchars($_POST['Home_score']);
    $awayScore_new = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);
    

    $stmt = $conn->prepare("SELECT * FROM matches WHERE matchID = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $oldMatch = $stmt->get_result()->fetch_assoc();

    $sql = "UPDATE matches
    SET HomeScore = $homeScore_new, AwayScore = $awayScore_new, matchDate = '$matchDate', matchTime = '$matchTime'
    WHERE matchID = $id  
    ";

    $change = "";

    


    if($homeScore_new > $awayScore_new){

        if($oldMatch['HomeScore'] > $oldMatch['AwayScore']){

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals WHERE teamID = $homeTeam;";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam;";
  
        }

        else if($oldMatch['HomeScore'] < $oldMatch['AwayScore']){

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeLosses = GREATEST(HomeLosses - 1, 0), HomeWins = HomeWins + 1, Losses = HomeLosses + AwayLosses, Wins = HomeWins + AwayWins, Goals = HomeGoals + AwayGoals, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints WHERE teamID = $homeTeam";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayWins = GREATEST(AwayWins - 1, 0), AwayLosses = AwayLosses + 1, Losses = HomeLosses + AwayLosses, Wins = HomeWins + AwayWins, Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam";

        }

        else{

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeDraws = GREATEST(HomeDraws - 1, 0), HomeWins = HomeWins + 1, Draws = HomeDraws + AwayDraws, Wins = HomeWins + AwayWins, Goals = HomeGoals + AwayGoals, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints WHERE teamID = $homeTeam";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayDraws = GREATEST(AwayDraws - 1, 0), AwayLosses = AwayLosses + 1, Losses = HomeLosses + AwayLosses, Draws = HomeDraws + AwayDraws, Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam";

        }
    }





    else if($homeScore_new < $awayScore_new){

        if($oldMatch['HomeScore'] > $oldMatch['AwayScore']){

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeWins = GREATEST(HomeWins - 1, 0), HomeLosses = HomeLosses + 1, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints, Wins = HomeWins + AwayWins, Losses = HomeLosses + HomeWins, Goals = HomeGoals + AwayGoals WHERE teamID = $homeTeam;";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayWins = AwayWins + 1, AwayLosses = GREATEST(AwayLosses - 1, 0), Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints, Wins = HomeWins + AwayWins, Losses = HomeLosses + AwayLosses WHERE teamID = $awayTeam;";

        }

        else if($oldMatch['HomeScore'] < $oldMatch['AwayScore']){

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals WHERE teamID = $homeTeam;";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam;";
        
        }

        else{

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeDraws = GREATEST(HomeDraws - 1, 0), HomeLosses = HomeLosses + 1, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Losses = HomeLosses + AwayLosses WHERE teamID = $homeTeam";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayDraws = GREATEST(AwayDraws - 1, 0), AwayWins = AwayWins + 1, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Wins = HomeWins + AwayWins WHERE teamID = $awayTeam";

        }
    }



    else{
       
        if($oldMatch['HomeScore'] > $oldMatch['AwayScore']){

           $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeDraws = HomeDraws + 1, HomeWins = GREATEST(HomeWins - 1, 0), HomePoints = 3 * HomeWins + HomeDraws, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Wins = HomeWins + AwayWins, Points = HomePoints + AwayPoints WHERE teamID = $homeTeam";
           $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayDraws = AwayDraws + 1, AwayLosses = GREATEST(AwayLosses - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Losses = HomeLosses + AwayLosses, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam";

        }

        else if($oldMatch['HomeScore'] < $oldMatch['AwayScore']){

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomeDraws = HomeDraws + 1, HomeLosses = GREATEST(HomeLosses - 1, 0), HomePoints = 3 * HomeWins + HomeDraws, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Losses = HomeLosses + AwayLosses, Points = HomePoints + AwayPoints WHERE teamID = $homeTeam";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, AwayDraws = AwayDraws + 1, AwayWins = GREATEST(Awaywins - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws, Wins = HomeWins + AwayWins, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam ";
        
        }

        else{

            $query = "UPDATE teams SET HomeGoals = HomeGoals - $oldMatch[HomeScore] + $homeScore_new, HomePoints = 3 * HomeWins + HomeDraws, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals WHERE teamID = $homeTeam;";
            $query2 = "UPDATE teams SET AwayGoals = AwayGoals - $oldMatch[AwayScore] + $awayScore_new, Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints WHERE teamID = $awayTeam;";

        }
    }




    if((int)$oldMatch['HomeScore'] !== (int)$homeScore_new){
            
        $change = "Home Score changed from " . $oldMatch['HomeScore'] . " to $homeScore_new" . " in week " . $oldMatch['week'];
        
        $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change' ,'$_SESSION[User]', 'Matches')";
        $conn->query($insert);
    
    }

    if((int)$oldMatch['AwayScore'] !== (int)$awayScore_new){
    
        $change =  "Away Score changed from " . $oldMatch['AwayScore'] . " to $awayScore_new" . " in week " . $oldMatch['week'];
            
        $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change' ,'$_SESSION[User]', 'Matches')";
        $conn->query($insert);
        
    }

    if($oldMatch['matchDate'] !== $matchDate){
    
        $change =  "Match Date changed from " . $oldMatch['matchDate'] . " to $matchDate" . " in week " . $oldMatch['week'];
            
        $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change' ,'$_SESSION[User]', 'Matches')";
        $conn->query($insert);
        
    }

    if($oldMatch['matchTime'] !== $matchTime){
    
        $change =  "Match Time changed from " . $oldMatch['matchTime'] . " to $matchTime" . " in week " . $oldMatch['week'];
            
        $insert = "INSERT INTO changes(changeText,UserName,changeType) VALUE('$change' ,'$_SESSION[User]', 'Matches')";
        $conn->query($insert);
        
    }

    $conn->query($query);
    $conn->query($query2);
    $conn->query($sql);

    $conn->close();
    header("Location: ../home.php");
    exit; 
}

?>