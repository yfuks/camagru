<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>CAMAGRU</title>
  </header>
  <body>
    <?php if(isset($_SESSION['id'])) { ?>
      log in
    <?php } else { ?>
    <div id="login">
      <div class="title">LOGIN</div>
      <div id="blue">
        <form method="post" style="position: relative;">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" SEND ">
          <a href="signup.php" target="_blank">Create account</a>
          <a href="#" target="_blank">Forget password ?</a>
          <span><?php echo $error; ?></span>
        </form>
      </div>
    </div>
    <?php } ?>
  </body>
</HTML>
