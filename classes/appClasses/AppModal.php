<?php

require_once __DIR__ . '/../Database.php';

class AppModal extends Database {

    protected function getTeams() {
        $sql = "SELECT * FROM teams ORDER BY Points DESC";

        $conn = $this->connect();
        $results = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

        $conn->close();
        return $results;

    }

    protected function getMatches() {
        $conn = $this->connect();
        $queryMaxWeek = "SELECT MAX(week) as 'maxWeek' FROM matches";

        $maxWeek = $conn->query($queryMaxWeek)->fetch_assoc()['maxWeek'];
        $week = 1;

        

        
            while ($week <= $maxWeek) {
                $query = "SELECT * ,
                team1.TeamName as team_home,
                team2.TeamName as team_away,
                SUBSTRING(matchTime, 1, 5) AS matchStart
                FROM matches
                INNER join teams team1
                on matches.HomeTeamID = team1.teamID
                INNER join teams team2
                on matches.AwayTeamID = team2.teamID
                WHERE week = ?
                ORDER BY week ASC ,matchDate ASC, matchTime ASC;";

       
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $week);
                $stmt->execute();
                $result = $stmt->get_result();

                echo "
                <tr>
                <th class='matches-weeks' colspan='7'>Week $week</th>
                </tr>
                ";

                while($row = $result->fetch_assoc()) {
                    echo "

                    <tr>
                    <td>$row[team_home]</td>
                    <td>$row[team_away]</td>
                    <td>$row[matchDate]</td>
                    <td>$row[matchStart]</td>
                    <td>$row[HomeScore]:$row[AwayScore]</td>
                    <td><button><a href='edit_match.php?id=$row[matchID]'>Edit</a></button></td>
                    <td><button><a href='Edit_Delete/delete_match_exec.php?id=$row[matchID]'>Delete</a></button> </td>
                    </tr>";


                }

                $week++;
                    
            }
            $conn->close();
            $stmt->close();       
    }

    protected function getLogs($type) {
        $query = "SELECT * FROM changes 
        JOIN users ON changes.UserName = users.UserName
        WHERE changes.changeType = ? 
        ORDER BY dateChanged DESC, timeChanged DESC";

        $conn = $this->connect();

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $type);
        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            echo $row['changeText'] . " by " . $row['UserName'] . " on " . $row['dateChanged'] . " " . $row['timeChanged'] . "<br>";
        }


    }
}