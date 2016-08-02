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
		  <div class="select">
			<img class="thumbnail" src="img/cadre.png"></img>
			<input id="cadre.png" type="radio" name="img" value="cadre.png">
			<img class="thumbnail" src="img/cigarette.png"></img>
			<input id="cigarette.png" type="radio" name="img" value="cigarette.png">
			<img class="thumbnail" src="img/hat.png"></img>
			<input id="hat.png" type="radio" name="img" value="hat.png">
		  </div>
          <video width="100%" autoplay="true" id="webcam"></video>
		  <div class="capture"><img class="camera" src="img/camera.png"></img></div>
          <input type="file" id="take-picture" accept="image/*">
        </div>
        <div class="side">
			<div class="title">Montages</div>
		</div>
        <?php //} else { ?>
          <!-- You need to connect to use the gallery -->
        <?php //} ?>
      </div>
    <?php include('fragments/footer.php') ?>
  </body>
  <script type="text/javascript" src="js/webcam.js"></script>
</HTML>
