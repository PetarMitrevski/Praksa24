<?php

require_once "LoginModal.php";

class LoginContr extends LoginModal{

    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    private function isFieldEmpty() {
        if(empty($this->username) || empty($this->password))
        return True;

        return False;
    }

    public function logTheUser() {
        if($this->isFieldEmpty() || !$this->checkUser($this->username, $this->password)) {
            echo "User doesnt exits";
        }

        else 
        echo "user found";
    }

}