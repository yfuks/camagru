<div id="header">
  <div class="button">
    <span>
      <?php if(isset($_SESSION['id'])) { ?>
        <a href="../forms/disconnect.php">Disconnect</a>
      <?php } else { ?>
          <a href="/index.php">Login</a>
      <?php } ?>
    </snap>
  </div>
  <?php if(isset($_SESSION['id'])) { ?>
  <div class="button">
    <span>
      <a href="./gallery.php">Gallery</a>
    </snap>
  </div>
  <?php } ?>
</div>
