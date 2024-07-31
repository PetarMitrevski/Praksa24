
<?php
session_start();

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