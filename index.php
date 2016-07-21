<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <meta charset="UTF-8">
    <title>CAMAGRU</title>
  </header>
  <body>
    <?php if(isset($_SESSION['id'])) { ?>
      log in
    <?php } else { ?>
    <div id="login">
      <div class="title">LOGIN</div>
      <div id="blue">
        <form method="post" style="position: relative;" action="forms/login.php">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" SEND ">
          <a href="signup.php">Create account</a>
          <a href="forgot.php">Forget password ?</a>
          <span>
            <?php
              echo $_SESSION['error'];
              $_SESSION['error'] = null;
            ?>
          </span>
        </form>
      </div>
    </div>
    <?php } ?>
  </body>
</HTML>
