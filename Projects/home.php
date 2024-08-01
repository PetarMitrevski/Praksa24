
<?php
session_start();

require_once 'PHP_data/config.php';
require_once 'PHP_data/functions.php';

$sql = "SELECT UserName FROM users";
$results = $conn->query($sql)->fetch_all();



if(!isset($_SESSION['status']) && !isset($_SESSION['User'])){
     
     header("Location: index.php");

     destroySession();

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
           
         if($_SESSION['editType'] === 'Teams' || $_SESSION['editType'] === 'Both')
         include "PHP_data/teams.php";

         else 
         include "PHP_data/teams_guestmode.php";
          
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

     <table class="clubs__table-matches">
     
     <?php
        
        if($_SESSION['editType'] === 'Matches' || $_SESSION['editType'] === 'Both')
        include "PHP_data/matches.php";      
        
        else 
        include "PHP_data/matches_guestmode.php";     
        ?>
     </table>


     <?php
        include "PHP_data/change_logs.php";
     ?>

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