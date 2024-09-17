<?php

require_once "Database.php";

class LoginModal extends Database{

    protected function checkUser($username, $password) {
        $conn = $this->connect();
        $sql = "SELECT UserName, Pass FROM users WHERE UserName = ? AND Pass = ? LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if(!$stmt->execute())
        return false;

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;  // User exists
        } 
        
        else {
            return false; // User does not exist
        }
    }

    public function getUser($username, $password) {
        $sql = "SELECT UserName, Pass FROM users WHERE UserName = ? AND Pass = ?";

        $conn = $this->connect();
        
       
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }

}