<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - FORGOT</title>
  </header>
  <body>
    <?php include('fragments/header.php') ?>
    <div id="login">
      <div class="title">FORGOT</div>
      <div id="blue">
        <form method="post" style="position: relative;" action="forms/forgot.php">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <input name="submit" type="submit" value=" SEND ">
        </form>
      </div>
      <?php
      echo $_SESSION['error'];
      $_SESSION['error'] = null;
      if (isset($_SESSION['forgot_success'])) {
        echo "An email has been sent to your email address";
        $_SESSION['forgot_success'] = null;
      }
      ?>
    </div>
  </body>
</HTML>
