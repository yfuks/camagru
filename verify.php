<?php
session_start();
include './functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - VERIFY</title>
  </header>
  <body>
    <div id="login">
    <div class="title">VERIFY</div>
    <?php if (verify($_GET["token"]) == 0) { ?>
      <strong>
        Your account as been verified
      </strong>
    <?php } else { ?>
      <strong>
        An error have occured
      </strong>
    <?php } ?>
    <div id="blue">
      <a href="index.php">Login</a>
    </div>
    </div>
  </body>
</HTML>
