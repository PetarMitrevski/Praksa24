<?php

require_once '../PHP_data/config.php';

if($conn->connect_error){
 die("Connection failed" . $conn->connect_error);
}

$id = $_GET["id"];

$sql = "
DELETE FROM matches WHERE matchID = '$id';";


$statement = "SELECT
             team1.teamID as team_home_id,
             team2.teamID as team_away_id,
             team1.Wins as points_home_wins,
             team2.Wins as points_away_wins,
             team1.Draws as points_home_draws,
             team2.Draws as points_away_draws,
             team1.Losses as points_home_losses,
             team2.Losses as points_away_losses
             FROM matches
             INNER join teams team1
             on matches.HomeTeamID = team1.teamID
             INNER join teams team2
             on matches.AwayTeamID = team2.teamID
             where matchID = $id;";


$response = $conn->query($statement);

$teams = $response->fetch_assoc();

$home_team = $teams['team_home_id'];
$away_team = $teams['team_away_id'];

$home_wins = $teams['points_home_wins'];
$away_wins = $teams['points_away_wins'];

$home_draws = $teams['points_home_draws'];
$away_draws = $teams['points_home_draws'];

$home_losses = $teams['points_home_losses'];
$away_losses = $teams['points_home_losses'];


if(($home_wins > 0))
$query = "UPDATE teams
SET Wins = Wins - 1, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

else
$query = "UPDATE teams
SET Wins = 0, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

$conn->query($query);


if(($home_draws > 0))
$query = "UPDATE teams
SET Draws = Draws - 1, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

else
$query = "UPDATE teams
SET Draws = 0, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

$conn->query($query);

if(($home_losses > 0))
$query = "UPDATE teams
SET Losses = Losses - 1, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

else
$query = "UPDATE teams
SET Losses = 0, Points = 3 * Wins + Draws
Where teamID = $home_team;
";

$conn->query($query);


if(($away_wins > 0))
$query = "UPDATE teams
SET Wins = Wins - 1, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

else
$query = "UPDATE teams
SET Wins = 0, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

$conn->query($query);


if(($away_draws > 0))
$query = "UPDATE teams
SET Draws = Draws - 1, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

else
$query = "UPDATE teams
SET Draws = 0, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

$conn->query($query);

if(($away_losses > 0))
$query = "UPDATE teams
SET Losses = Losses - 1, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

else
$query = "UPDATE teams
SET Losses = 0, Points = 3 * Wins + Draws
Where teamID = $away_team;
";

$conn->query($query);





if($conn->query($sql)){
    header("Location: ../index.php");
    exit;
}

else
echo "Invalid query";

$conn->close();
