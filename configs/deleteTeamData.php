<?php

$id = htmlspecialchars($_GET["id"]);
function myAutoloader($class) {

$file = '../classes/teamClasses/' . $class . '.php';
if (file_exists($file))
    require_once $file;
}


spl_autoload_register('myAutoloader');

$delete = new TeamContr;
$delete->deleteTeam($id);
unset($delete);

header("Location: ../pages/homepage.php");
