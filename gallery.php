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
      			<input id="cadre.png" type="radio" name="img" value="../img/cadre.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/cigarette.png"></img>
      			<input id="cigarette.png" type="radio" name="img" value="../img/cigarette.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/hat.png"></img>
      			<input id="hat.png" type="radio" name="img" value="../img/hat.png" onclick="onCheckBoxChecked(this)">
    		  </div>
          <video width="100%" autoplay="true" id="webcam"></video>
    		  <div class="capture" id="pickImage">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
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
