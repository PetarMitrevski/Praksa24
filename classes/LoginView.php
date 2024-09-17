<?php 

require_once "LoginModal.php";

class LoginView extends LoginModal{

    public function showLogin() {
        echo '
        <div class="center">
  <h1>Log in</h1>
  <form action="configs/formdata.php" method="post">
    
  <p class="error"><?= $error ?></p>

  <div class="inputbox">
      <input placeholder="Username" name="username" type="text" required>
    </div>

    <div class="inputbox">
      <input placeholder="Password" name="password" type="password" required>
    </div>

    <div class="inputbox">
      <input type="submit" value="Submit">
    </div>

    <div>
      <p>Dont have an account you can choose:</p>
      <span><a href="home_guest.php">Guest mode</a></span>    
    </div>

  </form>
</div>
        ';
    }


}