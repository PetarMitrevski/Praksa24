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
        header("Location: ../pages/homepage.php");

        else {
        $this->insertTeam($teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses);
        header("Location: ../pages/homepage.php");
    }
    }

    public function updateTeam($id, $teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses) {
        $sql = "UPDATE teams SET TeamName = ?, HomeWins = ?, AwayWins = ?, HomeDraws = ?, AwayDraws = ?, HomeLosses = ?, AwayLosses = ? WHERE teamID = ?";

        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiiiiii", $teamName, $homeWins, $awayWins, $homeDraws, $awayDraws, $homeLosses, $awayLosses, $id);
        $stmt->execute();

        header("Location: ../pages/homepage.php");
    }

    public function deleteTeam($id) {
        $sql = "DELETE FROM teams WHERE teamID = ?";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

    }

    public function addTeamForm() {
        require_once "../views/addTeams.php";
    }

    public function editTeamForm($id) {
        $team = $this->getTeam($id);
        require_once "../views/editTeams.php";
    }



}