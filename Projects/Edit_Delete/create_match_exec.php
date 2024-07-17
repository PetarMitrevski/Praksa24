<?php

require_once '../PHP_data/config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $week = htmlspecialchars($_POST['Week']);
    $home = htmlspecialchars($_POST['Home']);
    $away = htmlspecialchars($_POST['Away']);
    $homeScore = htmlspecialchars($_POST['Home_score']);
    $awayScore = htmlspecialchars($_POST['Away_score']);
    $matchDate = htmlspecialchars($_POST['Match_date']);
    $matchTime = htmlspecialchars($_POST['Match_time']);
 
    // Check if either team has already played a match in the same week
    $checkHomeQuery = "SELECT * FROM matches 
                       WHERE week = $week 
                       AND (HomeTeamID = $home OR AwayTeamID = $home)";
    
    $checkAwayQuery = "SELECT * FROM matches 
                       WHERE week = $week 
                       AND (HomeTeamID = $away OR AwayTeamID = $away)";
    
    $resultHome = $conn->query($checkHomeQuery);
    $resultAway = $conn->query($checkAwayQuery);

    if ($resultHome->num_rows > 0 || $resultAway->num_rows > 0) {
        // Redirect or handle duplicate match scenario (if necessary)
        header("Location: ../index.php?error=duplicate_match");
        exit;
    }

    if ($home !== $away) {
        // Insert the match details
        $statement = "INSERT INTO matches(HomeTeamID, AwayTeamID, week, matchDate, matchTime, HomeScore, AwayScore)
                      VALUES ($home, $away, $week, '$matchDate', '$matchTime', $homeScore, $awayScore)";

        if ($homeScore > $awayScore) {
            // Update for home team win
            $query = "UPDATE teams
                      SET  MatchesPlayed = MatchesPlayed + 1, HomeGoals = HomeGoals + $homeScore, HomeWins = HomeWins + 1, HomePoints = 3 * HomeWins + HomeDraws, Wins = HomeWins + AwayWins, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals 
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET  MatchesPlayed = MatchesPlayed + 1, AwayLosses = AwayLosses + 1, AwayGoals = AwayGoals + $awayScore, Losses = HomeLosses + AwayLosses, Goals = HomeGoals + AwayGoals, Points = HomePoints + AwayPoints
                       WHERE teamID = $away";

            $conn->query($query);
            $conn->query($query2);
        } else if ($homeScore < $awayScore) {
            // Update for away team win
            $query = "UPDATE teams
                      SET MatchesPlayed = MatchesPlayed + 1, HomeLosses = HomeLosses + 1, HomeGoals = HomeGoals + $homeScore, Losses = HomeLosses + AwayLosses, Goals = HomeGoals + AwayGoals, Points = HomePoints + AwayPoints
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET MatchesPlayed = MatchesPlayed + 1, AwayGoals = AwayGoals + $awayScore, AwayWins = AwayWins + 1, Wins = HomeWins + AwayWins,  Goals = HomeGoals + AwayGoals, AwayPoints = 3 * AwayWins + AwayDraws, Points = HomePoints + AwayPoints
                       WHERE teamID = $away";
            
            $conn->query($query);
            $conn->query($query2);
        } else {
            // Update for draw
            $query = "UPDATE teams
                      SET MatchesPlayed = MatchesPlayed + 1, HomeDraws = HomeDraws + 1, HomePoints = 3 * HomeWins + HomeDraws, HomeGoals = HomeGoals + $homeScore, Draws = AwayDraws + HomeDraws, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET  MatchesPlayed = MatchesPlayed + 1, AwayDraws = AwayDraws + 1, AwayPoints = 3 * AwayWins + AwayDraws, AwayGoals = AwayGoals + $awayScore, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals, Draws = HomeDraws + AwayDraws
                       WHERE teamID = $away";
            
            $conn->query($query);
            $conn->query($query2);
        }

        // Execute the match insertion statement
        $conn->query($statement);
        header("Location: ../index.php");
        exit;
    } else {
        // Handle if home and away team are the same
        header("Location: ../index.php?error=same_teams");
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}

$conn->close();
?>