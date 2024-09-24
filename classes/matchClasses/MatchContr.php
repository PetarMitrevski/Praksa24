<?php
require_once "MatchModal.php";


class MatchContr extends MatchModal {
    
    public function listMatches() {
        $maxWeek = $this->getMaxWeek();
        $conn = $this->connect();

        require_once "../views/matchesTable.php";
    }

    public function addMatches() {
        require_once "../classes/teamClasses/TeamContr.php";

        $teams = new TeamContr;
        $results = $teams->getTeams();

        require_once "../views/addMatches.php";

    }

    public function insertMatch($week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime) {
        
        if ($this->ifTeamsAreSame($homeTeam, $awayTeam)) {
            header("Location: ../pages/matchAdd.php");
            exit;
        }

        else { 
            $sql = "INSERT INTO matches(week, HomeTeamID, AwayTeamID, HomeScore, AwayScore, MatchDate, MatchTime) 
            VALUE(?, ?, ?, ?, ?, ?, ?)";

            $conn = $this->connect();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("iiiiiss", $week, $homeTeam, $awayTeam, $homeScore, $awayScore, $matchDate, $matchTime);
            $stmt->execute();

            $conn->close();
            $stmt->close();
        }
    }

    private function ifTeamsAreSame($homeTeam, $awayTeam) {
        return $homeTeam === $awayTeam;
    }

    
}