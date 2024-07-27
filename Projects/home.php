
<?php
session_start();

require_once 'PHP_data/config.php';

$sql = "SELECT UserName FROM users";
$results = $conn->query($sql)->fetch_all();

$parsed_url = parse_url($_SERVER['REQUEST_URI']);




if(!isset($_SESSION['status']) && !isset($_SESSION['User'])){
     
     header("Location: index.php");

     if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }
      
      session_destroy();
      session_unset();

      exit;    

}



require_once 'views/navigation_admin.php';
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

     <table class="clubs__table-overall">
     
     <?php
        include "PHP_data/matches.php";      
        ?>
     </table>

     </section>

       
        

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