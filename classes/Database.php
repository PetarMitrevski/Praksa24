<?php

class Database {

    protected function connect() {

        $conn = new mysqli("localhost", "root", "", "premier league");

        if($conn->connect_error)
        die("Connection failed" . $conn->connect_error);

        return $conn;
    }
}