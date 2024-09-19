<?php
require_once __DIR__ . '/../Database.php';

class TeamModal extends Database{
    protected function getTeams() {
        $sql = "SELECT * FROM teams ORDER BY Points DESC";

        $conn = $this->connect();
        $results = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

        $conn->close();
        return $results;
    }

    protected function insertTeam($teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses) {
        $query = "INSERT INTO teams(TeamName, HomeWins, AwayWins, HomeDraws, AwayDraws, HomeLosses, AwayLosses) VALUE(?, ?, ?, ?, ?, ?, ?)";
        $conn = $this->connect();

        $stmt = $conn->prepare($query);
        $stmt->bindParam("siiiiii", $teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses);
        $conn->close();
        return $stmt->execute;

    }

    

}