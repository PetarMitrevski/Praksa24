<?php

require_once '../PHP_data/config.php';
require_once '../PHP_data/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = htmlspecialchars($_POST['identifier']);
    $week = htmlspecialchars($_POST['Week']);
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
    SET week = $week, HomeTeamID = $homeTeam, AwayTeamID = $awayTeam, HomeScore = $homeScore_new, AwayScore = $awayScore_new, matchDate = '$matchDate', matchTime = '$matchTime'
    WHERE matchID = $id  
    ";

    if ($homeTeam !== $awayTeam) {

        if($homeTeam != $oldMatch['HomeTeamID']){

            if($homeScore_new > $awayScore_new){

                if($oldMatch['HomeScore'] > $oldMatch['AwayScore']){

                    $query = "UPDATE teams
                    SET 
                    MatchesPlayed = MatchesPlayed + 1,
                    HomeWins = HomeWins + 1,
                    HomeGoals = $homeScore_new,
                    Wins = HomeWins + AwayWins,
                    Draws = HomeDraws + AwayDraws,
                    Losses = HomeLosses + AwayLosses,
                    Goals = HomeGoals + AwayGoals,
                    HomePoints = 3 * HomeWins + HomeDraws,
                    Points = HomePoints + AwayPoints
                    WHERE teamID = $homeTeam;";

                    $query2 = "UPDATE teams SET 
                    MatchesPlayed = GREATEST(MatchesPlayed - 1, 0),
                    HomeWins = GREATEST(HomeWins - 1, 0),
                    HomeGoals = HomeGoals - $oldMatch[HomeScore],
                    Wins = HomeWins + AwayWins,
                    Draws = HomeDraws + AwayDraws,
                    Losses = HomeLosses + AwayLosses,
                    Goals = HomeGoals + AwayGoals,
                    HomePoints = 3 * HomeWins + HomeDraws,
                    Points = HomePoints + AwayPoints
                    WHERE teamID = $oldMatch[HomeTeamID];
                    ";
                    
                    $conn->query($query);
                    $conn->query($query2);
                }
               

                else if($oldMatch['HomeScore'] < $oldMatch['AwayScore']){

                    $query = "UPDATE teams
                    SET 
                    MatchesPlayed = MatchesPlayed + 1,
                    HomeWins = HomeWins + 1,
                    HomeLosses = GREATEST(HomeLosses - 1, 0),
                    HomeGoals = $homeScore_new,
                    Wins = HomeWins + AwayWins,
                    Draws = HomeDraws + AwayDraws,
                    Losses = HomeLosses + AwayLosses,
                    Goals = HomeGoals + AwayGoals,
                    HomePoints = 3 * HomeWins + HomeDraws,
                    Points = HomePoints + AwayPoints
                    WHERE teamID = $homeTeam;";

                    $query2 = "UPDATE teams SET 
                    MatchesPlayed = GREATEST(MatchesPlayed - 1, 0),
                    HomeWins = GREATEST(HomeWins - 1, 0),
                    HomeLosses = GREATEST(HomeLosses - 1, 0),
                    HomeGoals = GREATEST(HomeGoals - $oldMatch[HomeScore], 0),
                    Wins = HomeWins + AwayWins,
                    Draws = HomeDraws + AwayDraws,
                    Losses = HomeLosses + AwayLosses,
                    Goals = HomeGoals + AwayGoals,
                    HomePoints = 3 * HomeWins + HomeDraws,
                    Points = HomePoints + AwayPoints
                    WHERE teamID = $oldMatch[HomeTeamID];
                    ";

                    $query3 = "UPDATE teams SET
                     AwayWins = GREATEST(AwayWins - 1, 0),
                     AwayLosses = AwayLosses + 1,
                     AwayPoints = 3 * Awayins + AwayDraws,
                     Points = HomePoints + AwayPoints
                     WHERE teamID = $awayTeam;
                    ";
                    
                    $conn->query($query);
                    $conn->query($query2);
                    $conn->query($query3);
                }
                
            }
        }
        $conn->query($sql); 
    } 

  
    
    else {
        header("Location: ../index.php?error=2");
        exit;
    }
}

$conn->close();
exit;

?>