<?php
require_once __DIR__ . '/../Database.php';

class MatchModal extends Database{

   

    public function getMatch($id) {

    }

    protected function getMaxWeek() {
      $sql = "SELECT MAX(week) as max_week FROM matches";
      
      $conn = $this->connect();
      $result = $conn->query($sql)->fetch_assoc();

      return $result["max_week"];
    }
    


}