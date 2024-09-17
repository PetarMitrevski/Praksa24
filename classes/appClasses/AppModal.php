<?php

require_once __DIR__ . '/../Database.php';

class AppModal extends Database {

    protected function getTeams() {
        $sql = "SELECT * FROM teams ORDER BY Points DESC";

        $conn = $this->connect();
        $results = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

        return $results;

    }
}