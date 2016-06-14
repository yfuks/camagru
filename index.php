<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
  </header>
  <body>
    <div id="login">
      <div class="title">LOGIN</div>
      <div id="blue">
        <form method="post" style="position: relative;">
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" SEND ">
          <span><?php echo $error; ?></span>
        </form>
      </div>
    </div>
  </body>
</HTML>
