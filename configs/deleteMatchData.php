<?php
require_once "../classes/matchClasses/MatchContr.php";
$id = htmlspecialchars($_GET["id"]);

$delete = new MatchContr;
$delete->deleteMatch($id);