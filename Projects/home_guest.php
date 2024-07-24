<?php


require_once 'views/navigation_guest.php';
require_once 'PHP_data/config.php';

?>


<section class="clubs">


<div class="btn-group clubs__buttons_stats">
      <button class="btn">Overall</button>
      <button class="btn">Home</button>
      <button class="btn">Away</button>
    </div>
  
<table id="table_overall" class="clubs__table-overall">
       
        <?php
           
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
        </section>

       
        <?php
        include "PHP_data/matches_guestmode.php";      
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