<?php

require_once "../classes/teamClasses/TeamContr.php";
$id = htmlspecialchars($_GET["id"]);

$view = new TeamContr;
$view->editTeamForm($id);
unset($view);