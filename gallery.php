<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/gallery.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - gallery</title>
  </header>
  <body>
    <?php include('fragments/header.php') ?>
      <div class="body">
        <?php //if(isset($_SESSION['id'])) { ?>
        <div class="main">
          <video autoplay="true" id="webcam">
          </video>
          <input type="file" id="take-picture" accept="image/*">
        </div>
        <div class="side"></div>
        <?php //} else { ?>
          <!-- You need to connect to use the gallery -->
        <?php //} ?>
      </div>
    <?php include('fragments/footer.php') ?>
  </body>
  <script type="text/javascript" src="js/webcam.js"></script>
</HTML>
