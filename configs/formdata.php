<?php

require_once "../classes/LoginContr.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $controler = new LoginContr($username, $password);

    $controler->logTheUser($username, $password);



}