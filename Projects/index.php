<?php
require_once 'views/navigation.php';

?>

  
<section class="clubs">
  
<table id="table_overall" class="clubs__table-overall">
       
        <?php
           
         include "PHP_data/teams.php";
          
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

        

        <script src="JS/index.js"></script>
        </body>
        </html>


