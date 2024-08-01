<?php


function destroySession(){

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    session_unset();
}


function checkLogin($status, $user){

    $urlPath = parse_url($_SERVER['REQUEST_URI'])['path'];

    if (!isset($status) && !isset($user)){
     
        header("Location: index.php");
     
        destroySession();
     
         exit;    
     
     }

    
    else if ($_SESSION['editType'] === 'Matches' && )
}


