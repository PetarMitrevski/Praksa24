<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){

    require_once "../PHP_data/config.php";

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $repeated_password = htmlspecialchars($_POST['password_repeat']);
    
    $query = "SELECT COUNT(*) AS num FROM users WHERE username = '$username';";

    $record = $conn->query($query)->fetch_assoc();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    // check if username exists
    if($record['num'] > 0){
    header("Location: ../signup.php?error=username_exists");
    exit;
    }

    else if(strlen($username) <= 4){
    header("Location: ../signup.php?error=username_too_short");
    exit;
    }

    else {
        
        if($password !== $repeated_password){
        header("Location: ../signup.php?error=passwords_dont_match");
        exit;
        }

        else if(!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)){
        header("Location: ../signup.php?error=must_contain_uppercase_or_lowercase");
        exit;
        }

        else if(strlen($password) < 8){
        header("Location: ../signup.php?error=password_too_short");
        exit;
        }

        else {

          $username = preg_replace('/\s+/','',$username);

          $query = "INSERT INTO users(UserName,Pass) VALUE('$username','$hashedPassword')";
          $conn->query($query);
          header("Location: ../signup.php");
          exit;
          
        }

}

}
    
        