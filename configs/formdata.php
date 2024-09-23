<?php

require_once "../classes/LoginContr.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $controler = new LoginContr($username, $password);

    $controler->logTheUser($username, $password);
    unset($controler);


}