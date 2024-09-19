<?php
require_once "TeamModal.php";

class TeamContr extends TeamModal{

    private function teamExists($teamName) {
        $query = "SELECT COUNT(*) as Team_number FROM teams WHERE TeamName = ?";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $teamName);
        $stmt->execute();

        $count = $stmt->get_result()->fetch_assoc();
        return $count["Team_number"] > 0;

    }

    public function listTeams() {

        $teams = $this->getTeams();
        
        require_once "../views/home.php";
    }

    public function addTeam($teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses) {
        if($this->teamExists($teamName))
        echo "Cannot add team";

        else 
        $this->insertTeam($teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses);
    }

}