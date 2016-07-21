<div id="header">
  <span class="button">
    <?php if(isset($_SESSION['id'])) { ?>
      <a href="../forms/disconnect.php">Disconnect</a>
    <?php } else { ?>
        <a href="/index.php">Login</a>
    <?php } ?>
  </snap>
</div>
