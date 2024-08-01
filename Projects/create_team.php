
<?php
session_start();

require_once "PHP_data/functions.php";

if(!isset($_SESSION['status']) && !isset($_SESSION['User'])){
     
   header("Location: index.php");

   destroySession();

    exit;    

}

else if ($_SESSION['editType'] !== 'Teams')
header("Location: home.php");



if(file_exists('views/navigation_admin.php'))
require_once 'views/navigation_admin.php';

?>



<form action="Edit_Delete/create_exec.php"  method="post">
            <fieldset>
             
            <div>
             <label>Team:</label>
             <input name="Team" type="text"/>
             </div>

             <div>
             <label>Home Wins:</label>
             <input min="0" required name="Home_Wins" type="number" placeholder="Home Wins"/>
             <br>
             <label>Away Wins:</label>
             <input min="0" required name="Away_Wins" type="number" placeholder="Away Wins"/>
             </div>

             <div>
             <label>Home Draws:</label>
             <input min="0" required name="Home_Draws" type="number" placeholder="Home Draws"/>
             <br>
             <label>Away Draws:</label>
             <input min="0" required name="Away_Draws" type="number" placeholder="Away Draws"/>
             </div>
             
             <div>
             <label>Home Losses:</label>
             <input min="0" required name="Home_Losses" type="number" placeholder="Home Losses"/>
             <br>
             <label>Away Losses:</label>
             <input min="0" required name="Away_Losses" type="number" placeholder="Away Losses"/>
             </div> 
            
             
                
                <input id="submit_btn" type="submit" name="submit" value="Submit"/>
            </fieldset>
 
           
         </form>

         <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>
         
         
</body>
</html>