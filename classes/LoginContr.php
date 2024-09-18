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
        return empty($this->username) || empty($this->password);
    }

    private function setError($error) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); 
        }
        $_SESSION['error'] = $error;
    }

    public static function getError() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Ensure session is started before accessing
        }

        // Check if an error exists in the session
        if (isset($_SESSION['error'])) {

            switch ($_SESSION['error']) {
                case "empty_fields":
                    $_SESSION['error'] = "Please fill out the fields";
                    $error = $_SESSION['error'];
                    unset($_SESSION['error']);
                    return $error;
                
                case "invalid_username_or_pass":
                    $_SESSION['error'] = "Invalid username or password";
                    $error = $_SESSION['error'];
                    unset($_SESSION['error']);
                    return $error;

                
                default:
                    return "";
            }
            
        }
    }


    public function logTheUser() {
        if ($this->isFieldEmpty()) {
            $this->setError("empty_fields");
            header("Location: ../index.php");
            exit;
        }

        else if (!$this->checkUser($this->username, $this->password)) {
            $this->setError("invalid_username_or_pass");
            header("Location: ../index.php");
            exit;
        }

        else {
           header("Location: ../routes/home.php");
        }
    }

}