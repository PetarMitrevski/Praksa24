<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    require_once "../PHP_data/config.php";

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);



    $sql = "SELECT * FROM users WHERE UserName = ? LIMIT 1";


    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $username);
    $statement->execute();
    $response = $statement->get_result();
    $result = $response->fetch_assoc();

        
        if($result && password_verify($password, $result['Pass'])){
        $_SESSION['status'] = "Active";
        header("Location: ../home.php?User=$username");
        exit;    
        }
        
        else{
        header("Location: ../index.php?error=invalid_username_or_password");
        exit;    

    }
}









