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


 else if ($_SESSION['editType'] !== 'Matches')
 header("Location: home.php");

if(file_exists('views/navigation_admin.php'))
require_once 'views/navigation_admin.php';

?>



<form action="Edit_Delete/create_match_exec.php"  method="post">
            <fieldset>
             
            <div>
             <label>Week:</label>
             <input min="1" required name="Week" type="number"/>
             </div>

             <div>
             <label>Home Team:</label>
            <select name="Home" required>
            
            <?php
            
            require_once 'PHP_data/config.php';

           
            $sql = "SELECT * FROM teams";
            $result = $conn->query($sql);

            
            if (!$result) {
                die("Error fetching teams: " . $conn->error);
            }

            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $teamID = $row["teamID"];
                    $TeamName = $row["TeamName"];
                    echo "<option value='$teamID'>$TeamName</option>";
                }
            } 

          
            
            ?>
            </select>
             </div>

             <div>
             <label>Away Team:</label>
        <select name="Away" required>
            <?php
            

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);

   
            if (!$result) {
                die("Error fetching teams: " . $conn->error);
            }


            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $teamID = $row["teamID"];
                    $TeamName = $row["TeamName"];
                    echo "<option value='$teamID'>$TeamName</option>";
                }
            }

            $conn->close();
            ?>
            </select>
             </div>
             
             <div>
             <label>Home Score:</label>
             <input min="0" required name="Home_score" type="number" placeholder="Score"/>
             </div>
             
             <div>
             <label>Away Score:</label>
             <input min="0" required name="Away_score" type="number" placeholder="Score"/>
             </div>
             
             <div>
             <label>Match Date:</label>
             <input required name="Match_date" type="date"/>
             </div>
             
             <div>
             <label>Match Time:</label>
             <input required name="Match_time" type="time"/>
             </div> 
            
             
                
                <input id="submit_btn" type="submit" name="submit" value="Submit"/>
            </fieldset>
 
           
         </form>

         <footer>
        <p>&copy; 2024 Example Company.<br> All rights reserved.</p>
        </footer>
         
         
</body>
</html>