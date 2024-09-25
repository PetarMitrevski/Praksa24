<?php
require_once "MatchModal.php";


class MatchContr extends MatchModal {
    
    public function listMatches() {
        $maxWeek = $this->getMaxWeek();
        $conn = $this->connect();

        require_once "../views/matchesTable.php";
    }

    public function showEditMatch($id) {
        $result = $this->getMatchWithTeams($id);
        require_once "../views/editMatches.php";
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

            header("Location: ../pages/homepage.php");
            exit;
        }
    }

    public function updateMatch($id, $homeScore, $awayScore) {
        $updateSql = "UPDATE matches SET HomeScore = ?, AwayScore = ? WHERE matchID = ?";

        $conn = $this->connect();
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("iii", $homeScore, $awayScore, $id);
        $stmt->execute();

        header("Location: ../pages/homepage.php");
        exit;
    }

    public function deleteMatch($id) {
        
        $deleteSql = "DELETE FROM matches WHERE matchID = ?;";

        $conn = $this->connect();

        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../pages/homepage.php");
        exit;

    }


    private function ifTeamsAreSame($homeTeam, $awayTeam) {
        return $homeTeam === $awayTeam;
    }

    
}