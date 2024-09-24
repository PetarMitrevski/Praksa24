<?php
require_once "../classes/teamClasses/TeamContr.php";
require_once "../classes/matchClasses/MatchContr.php";
require_once "../classes/matchClasses/MatchModal.php";

$teams = new TeamContr;
$teams->listTeams();

$matches = new MatchContr; 
$matches->listMatches();   
unset($matches);
?>

<footer>
    <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
</footer>

<script src="../JS/tables.js"></script>

</body>
</html>