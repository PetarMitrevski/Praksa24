<?php
require_once __DIR__ . '/../Database.php';

class MatchModal extends Database{

   

    public function getMatch($id) {
      $sql = "SELECT * FROM matches WHERE matchID = ?";

      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      $match = $stmt->get_result()->fetch_assoc();
      return $match;

    }

    protected function getMaxWeek() {
      $sql = "SELECT MAX(week) as max_week FROM matches";
      
      $conn = $this->connect();
      $result = $conn->query($sql)->fetch_assoc();

      return $result["max_week"];
    }

    protected function getMatchWithTeams($id) {
      require_once "../classes/teamClasses/TeamContr.php";
      
      $sql = "SELECT matchID, matchDate, SUBSTRING(matchTime,1,5) as matchStart, week, HomeScore, AwayScore, homeTeam.TeamName as teamHome, awayTeam.TeamName as teamAway 
      FROM matches
      INNER JOIN teams as homeTeam ON matches.HomeTeamID = homeTeam.teamID
      INNER JOIN teams as awayTeam ON matches.AwayTeamID = awayTeam.teamID
      WHERE matchID = ?";

      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      $result = $stmt->get_result()->fetch_assoc();
      return $result;
    }


    


}