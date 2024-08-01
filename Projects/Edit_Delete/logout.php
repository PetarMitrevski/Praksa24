<?php

require_once "../PHP_data/functions.php";

session_start();

destroySession();

header("Location: ../index.php");
exit;