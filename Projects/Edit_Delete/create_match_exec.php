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
                      SET Wins = Wins + 1, Points = 3 * Wins + Draws, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $homeScore
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET Losses = Losses + 1, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $awayScore
                       WHERE teamID = $away";

            $conn->query($query);
            $conn->query($query2);
        } else if ($homeScore < $awayScore) {
            // Update for away team win
            $query = "UPDATE teams
                      SET Losses = Losses + 1, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $homeScore
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET Wins = Wins + 1, Points = 3 * Wins + Draws, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $awayScore
                       WHERE teamID = $away";
            
            $conn->query($query);
            $conn->query($query2);
        } else {
            // Update for draw
            $query = "UPDATE teams
                      SET Draws = Draws + 1, Points = 3 * Wins + Draws, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $homeScore
                      WHERE teamID = $home";
            
            $query2 = "UPDATE teams 
                       SET Draws = Draws + 1, Points = 3 * Wins + Draws, MatchesPlayed = MatchesPlayed + 1, Goals = Goals + $awayScore
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
