<?php
session_start();


require_once '../PHP_data/config.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];

// Use prepared statements to prevent SQL injection
$sql = "DELETE FROM matches WHERE matchID = ?";

$statement = $conn->prepare("
SELECT *,
       team1.teamID as team_home_id,
       team2.teamID as team_away_id
FROM matches
INNER JOIN teams team1 ON matches.HomeTeamID = team1.teamID
INNER JOIN teams team2 ON matches.AwayTeamID = team2.teamID
WHERE matchID = ?;
");

$statement->bind_param("i", $id);
$statement->execute();
$response = $statement->get_result();
$teams = $response->fetch_assoc();

$home_score = $teams['HomeScore'];
$away_score = $teams['AwayScore'];

$home_team = $teams['team_home_id'];
$away_team = $teams['team_away_id'];


$query = "";
$query2 = "";

if ($home_score > $away_score) {
    $query = "UPDATE teams SET MatchesPlayedHome = GREATEST(MatchesPlayedHome - 1, 0), HomeWins = GREATEST(HomeWins - 1, 0), HomePoints = 3 * HomeWins + HomeDraws, HomeGoals = GREATEST(HomeGoals - $home_score, 0), Wins = HomeWins + AwayWins, Points = HomePoints + AwayPoints, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway, Goals = HomeGoals + AwayGoals WHERE teamID = ?";
    $query2 = "UPDATE teams SET MatchesPlayedAway = GREATEST(MatchesPlayedAway - 1, 0), AwayLosses = GREATEST(AwayLosses - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws, AwayGoals = GREATEST(AwayGoals - $away_score, 0), Losses = HomeLosses + AwayLosses, Points = HomePoints + AwayPoints, Goals = HomeGoals + AwayGoals, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway WHERE teamID = ?";
} else if ($home_score < $away_score) {
    $query = "UPDATE teams SET MatchesPlayedHome = GREATEST(MatchesPlayedHome - 1, 0), HomeLosses = GREATEST(HomeLosses - 1, 0), HomePoints = 3 * HomeWins + HomeDraws, HomeGoals = GREATEST(HomeGoals - $home_score, 0), Losses = HomeLosses + AwayLosses, Points = HomePoints + AwayWins, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway, Goals = HomeGoals + AwayGoals WHERE teamID = ?";
    $query2 = "UPDATE teams SET MatchesPlayedAway = GREATEST(MatchesPlayedAway - 1, 0), AwayWins = GREATEST(AwayWins - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws, AwayGoals = GREATEST(AwayGoals - $away_score, 0), Wins = HomeWins + AwayWins, Points = HomePoints + AwayPoints, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway, Goals = HomeGoals + AwayGoals WHERE teamID = ?";
} else {
    $query = "UPDATE teams SET MatchesPlayedHome = GREATEST(MatchesPlayedHome - 1, 0), HomeDraws = GREATEST(HomeDraws - 1, 0), HomePoints = 3 * HomeWins + HomeDraws, HomeGoals = GREATEST(HomeGoals - $home_score, 0), Draws = HomeDraws + AwayDraws, Points = HomePoints + AwayPoints, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway, Goals = HomeGoals + AwayGoals WHERE teamID = ?";
    $query2 = "UPDATE teams SET MatchesPlayedAway = GREATEST(MatchesPlayedAway - 1, 0), AwayDraws = GREATEST(AwayDraws - 1, 0), AwayPoints = 3 * AwayWins + AwayDraws, AwayGoals = GREATEST(AwayGoals - $away_score, 0), Draws = HomeDraws + AwayDraws, Points = HomePoints + AwayPoints, MatchesPlayed = MatchesPlayedHome + MatchesPlayedAway, Goals = HomeGoals + AwayGoals WHERE teamID = ?";
}

$stmt1 = $conn->prepare($query);
$stmt1->bind_param("i", $home_team);
$stmt1->execute();

$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $away_team);
$stmt2->execute();

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {

    $insert = "INSERT INTO changes(changeText,UserName) VALUE('Match deleted','$_SESSION[User]')";
    $conn->query($insert);
    header("Location: ../home.php");  
    exit;
    
} else {
    echo "Invalid query";
}



$conn->close();
?>
