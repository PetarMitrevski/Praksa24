<?php
if(file_exists('views/navigation.php'))
include 'views/navigation.php';
?>


      
         <form>
            <fieldset>
             
            <div>
             <label >Name:</label>
             <input name="name" type="text" placeholder="Name"/>
             </div>

             <div>
             <label  for="surname">Surname:</label>
             <input id="surname" name="surname" type="text" placeholder="Surname"/>
             </div>

             <div>
             <label for="email">Email:</label>
             <input id="email" name="email" type="email" placeholder="Email"/>
             </div>
             
             <div>
             <label for="phone">Phone number:</label>
             <input id="phone" type="tel" placeholder="Phone number"/>
             </div> 
            
             <div>
                <input type="text" placeholder="Subject"/>
                <textarea></textarea>
                </div>
                
                <input id="submit_btn" type="submit" name="submit" value="Submit"/>
            </fieldset>
 
            
         </form>


         <section class="contact_info">

            <div class="contact_info__data">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                  </svg>
            <h4>London England</h4>
            </div>

            <div class="contact_info__data">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                  </svg>
                <h4>+44 (0) 20 7864 9000.</h4>
            </div>

            <div class="contact_info__data">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                  </svg>
                <h4>fpl@ismgames.com</h4>
            </div>


            

            

         </section>

         <footer class="container-fluid">
            <p>&copy; 2024 Example Company. All rights reserved.</p>
         </footer>
     

</body>
</html>