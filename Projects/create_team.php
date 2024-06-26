
<?php
if(file_exists('views/navigation.php'))
require_once 'views/navigation.php';
?>



<form action="Edit_Delete/create_exec.php"  method="post">
            <fieldset>
             
            <div>
             <label>Team:</label>
             <input name="Team" type="text"/>
             </div>

             <div>
             <label  for="Wins">Wins:</label>
             <input required id="Wins" name="Wins" type="number" placeholder="Wins"/>
             </div>

             <div>
             <label>Draws:</label>
             <input required id="Draws" name="Draws" type="number" placeholder="Draws"/>
             </div>
             
             <div>
             <label>Losses:</label>
             <input required name="Losses" id="Losses" type="number" placeholder="Losses"/>
             </div> 
            
             
                
                <input id="submit_btn" type="submit" name="submit" value="Submit"/>
            </fieldset>
 
           
         </form>

         <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>
         
         
</body>
</html>