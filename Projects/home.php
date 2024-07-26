
<?php
session_start();

require_once 'PHP_data/config.php';

$sql = "SELECT UserName FROM users";
$results = $conn->query($sql)->fetch_all();

$parsed_url = parse_url($_SERVER['REQUEST_URI']);




if(!array_key_exists("status", $_SESSION) && !in_array($_GET['User'], $results) && !array_key_exists("query", $parsed_url)){
     
     if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }

     session_unset();
     session_destroy();
     header("Location: index.php");
     exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

require_once 'views/navigation_admin.php';
echo $_GET['User'];
?>

  
<section class="clubs">


<div class="btn-group clubs__buttons_stats">
      <button class="btn">Overall</button>
      <button class="btn">Home</button>
      <button class="btn">Away</button>
    </div>
  
<table id="table_overall" class="clubs__table-overall">
       
        <?php
           
         include "PHP_data/teams.php";
          
        ?>
        </table>

<table id="table_home" class="clubs__table-home">
          <?php
           
         include "PHP_data/homeStats.php";
            
          ?>
     </table>


     <table id="table_away" class="clubs__table-away">
          <?php
           
         include "PHP_data/awayStats.php";
            
          ?>

     </table>
        </section>

       
        <?php
        include "PHP_data/matches.php";      
        ?>

        <div style="text-align:center">
        <p> <span style="background: royalblue; color:transparent;">-</span> Champions league</p>
        <p><span style="background: lime; color:transparent;">-</span> Europe league</p>
        <p><span style="background: red; color:transparent;">-</span> Will be out</p>
        </div>

        
        <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>

                
        <script src="JS/tables.js"></script>

        </body>
        </html>