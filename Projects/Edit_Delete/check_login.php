<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    require_once "../PHP_data/config.php";

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $repeated_password = htmlspecialchars($_POST['password_repeat']);


    $sql = "SELECT * FROM users WHERE UserName = ? AND Pass = ?";

    if($password !== $repeated_password){
    header("Location: ../index.php?error=passwords_dont_match");
    exit;
     
}
    

else{
        

        $statement = $conn->prepare($sql);
        $statement->bind_param("ss", $username, $password);
        $statement->execute();
        $response = $statement->get_result();
        $result = $response->fetch_assoc();

        
        if($result){
        $_SESSION['status'] = "Active";
        header("Location: ../home.php?User=$username");
        exit;    
        }
        
        else{
        header("Location: ../index.php?error=invalid_username_or_password");
        exit;    
    }

    }
}









