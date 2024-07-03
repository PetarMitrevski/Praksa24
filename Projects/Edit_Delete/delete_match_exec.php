<?php

require_once '../PHP_data/config.php';
require_once '../PHP_data/functions.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];

// Use prepared statements to prevent SQL injection
$sql = "DELETE FROM matches WHERE matchID = ?";

$statement = $conn->prepare("
SELECT *,
       team1.teamID as team_home_id,
       team2.teamID as team_away_id,
       team1.Wins as points_home_wins,
       team2.Wins as points_away_wins,
       team1.Draws as points_home_draws,
       team2.Draws as points_away_draws,
       team1.Losses as points_home_losses,
       team2.Losses as points_away_losses
FROM matches
INNER JOIN teams team1 ON matches.HomeTeamID = team1.teamID
INNER JOIN teams team2 ON matches.AwayTeamID = team2.teamID
WHERE matchID = ?
");

$statement->bind_param("i", $id);
$statement->execute();
$response = $statement->get_result();
$teams = $response->fetch_assoc();

$home_score = $teams['HomeScore'];
$away_score = $teams['AwayScore'];

$home_team = $teams['team_home_id'];
$away_team = $teams['team_away_id'];

$home_wins = $teams['points_home_wins'];
$away_wins = $teams['points_away_wins'];

$home_draws = $teams['points_home_draws'];
$away_draws = $teams['points_away_draws'];

$home_losses = $teams['points_home_losses'];
$away_losses = $teams['points_away_losses'];

$query = "";
$query2 = "";

if ($home_score > $away_score) {
    $query = "UPDATE teams SET Wins = GREATEST(Wins - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
    $query2 = "UPDATE teams SET Losses = GREATEST(Losses - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
} elseif ($home_score < $away_score) {
    $query = "UPDATE teams SET Wins = GREATEST(Wins - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
    $query2 = "UPDATE teams SET Losses = GREATEST(Losses - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
} else {
    $query = "UPDATE teams SET Draws = GREATEST(Draws - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
    $query2 = "UPDATE teams SET Draws = GREATEST(Draws - 1, 0), Points = 3 * Wins + Draws WHERE teamID = ?";
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
    header("Location: ../index.php");
    exit;
} else {
    echo "Invalid query";
}

$conn->close();
?>
