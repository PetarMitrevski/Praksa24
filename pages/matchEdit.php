<?php
require_once "../classes/matchClasses/MatchContr.php";
$id = htmlspecialchars($_GET["id"]);

$view = new MatchContr;

$view->showEditMatch($id);

