<?php
require_once "../classes/teamClasses/TeamContr.php";

$view = new TeamContr;
$view->addTeamForm();
unset($view);