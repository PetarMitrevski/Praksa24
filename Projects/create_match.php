<?php
if(file_exists('views/navigation.php'))
include 'views/navigation.php';

?>



<form action="Edit_Delete/create_match_exec.php"  method="post">
            <fieldset>
             
            <div>
             <label>Week:</label>
             <input required name="Week" type="text"/>
             </div>

             <div>
             <label>Home Team:</label><br>
        <select name="Home" required>
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "premier league";

          
            $conn = new mysqli($servername, $username, $password, $database);

           
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

           
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

          
            $conn->close();
            
            ?>
            </select>
             </div>

             <div>
             <label>Away:</label>
        <select name="Away" required>
            <?php
            
            $conn = new mysqli($servername, $username, $password, $database);

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
             <input required name="Home_score" type="number" placeholder="Score"/>
             </div>
             
             <div>
             <label>Away Score:</label>
             <input required name="Away_score" type="number" placeholder="Score"/>
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