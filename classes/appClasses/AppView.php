<?php
require_once "AppModal.php";

class AppView extends AppModal{

    public function showNavbar() {
        echo '
<nav class="navbar navigation">
        <div>
            <img src="../Images/download.png" alt="Premier_league_logo" >
        </div>

        <div>
            <ul>

            <li>
               <a href="home.php">
              Home
              </a>
            </li>
             

            <li>
               <a href="create_team.php">
                Add team
                </a>
            </li>

            <li>
              <a href="create_match.php">
               Add match
              </a>
           </li>

            
            <li>
                <a href="Edit_Delete/logout.php">
                Log out
                </a>
            </li>

        </ul>
        </div>
      </nav>
        ';
    }

    public function showButtons() {
      echo '<div class="btn-group clubs__buttons_stats">
      <button class="btn">Overall</button>
      <button class="btn">Home</button>
      <button class="btn">Away</button>
    </div>';
    }

    public function showTableOverall() {
        $number = 1;
        echo "
        <table id='table_overall' class='clubs__table-overall'>
        <tr>
        <th>#</th>
        <th>Team</th>
        <th>Matches Played</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>Pts</th>
        <th>Goals</th>
        </tr>
        ";

        $rows = $this->getTeams();

        foreach ($rows as $row) {
            echo "
            <tr>
          <td>
           $number.
          </td>
          <td>
            $row[TeamName]
          </td>
          <td>
          $row[MatchesPlayed]
          </td>
          <td>
           $row[Wins]
          </td>
          <td>
           $row[Draws]
          </td>
          <td>
           $row[Losses]
          </td>
          <td>
           $row[Points]
          </td>
          <td>
          $row[Goals]
          </td>
          <td>
            <button><a href='edit.php?id=$row[teamID]'>Edit</a></button>
            </td>

        <td>
        <button><a href='Edit_Delete/delete_exec.php?id=$row[teamID]'>Delete</a></button>
        </td>

        </tr>
          ";

          $number++;
            
        }
        
        echo "</table>";
    }

    public function showTableHome() {
    
      $number = 1;

      echo "
      <table id=table_home class=clubs__table-home >
      <tr>
      <th>#</th>
      <th>Team</th>
      <th>Matches Played</th>
      <th>W</th>
      <th>D</th>
      <th>L</th>
      <th>Pts</th>
      <th>Goals</th>
      </tr>
      ";

      $rows = $this->getTeams();

      foreach ($rows as $row) {
        echo "
        <tr>
        <td>
        $number.
        </td>
        <td>
        $row[TeamName]
        </td>
        <td>
        $row[MatchesPlayedHome]
        </td>
        <td>
        $row[HomeWins]
        </td>
        <td>
        $row[HomeDraws]
        </td>
        <td>
        $row[HomeLosses]
        </td>
        <td>
        $row[HomePoints]
        </td>
        <td>
        $row[HomeGoals]
        </td>

        </tr>
          ";
          $number++;

      }

      echo "</table>";

    }

    public function showTableAway() {
      $number = 1;

      echo "
      <table id=table_away class=clubs__table-away clubs>
      <tr>
      <th>#</th>
      <th>Team</th>
      <th>Matches Played</th>
      <th>W</th>
      <th>D</th>
      <th>L</th>
      <th>Pts</th>
      <th>Goals</th>
      </tr>
      ";

      $rows = $this->getTeams();

      foreach ($rows as $row) {
        echo "
        <tr>
        <td>
        $number.
        </td>
        <td>
        $row[TeamName]
        </td>
        <td>
        $row[MatchesPlayedAway]
        </td>
        <td>
        $row[AwayWins]
        </td>
        <td>
        $row[AwayDraws]
        </td>
        <td>
        $row[AwayLosses]
        </td>
        <td>
        $row[AwayPoints]
        </td>
        <td>
        $row[AwayGoals]
        </td>

        </tr>
          ";
          $number++;

      }

      echo "</table>";
    }

    public function showMatches() {
      
      echo "
      <table class=clubs__table-matches>
      <tr>
      <th> Home </th>
      <th> Away </th>
      <th> Date </th>
      <th> Time </th>
      <th> Result </th>
      </tr>
      ";

      $this->getMatches();

      echo "</table>";
    }

    public function showLogs($type) {
      $this->getLogs($type);
    }

    public function showFooter() {
        echo "
        <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>
        ";
    }



}
