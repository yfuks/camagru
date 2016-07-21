<?php

function send_verification_email($toAddr, $toUsername, $token, $ip) {
  $subject = "[CAMAGRU] - Email verification";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <yfuks@student.42.fr>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . $toUsername . ' </br>
      To finalyze your subscribtion please click the link below </br>
      <a href="http://' . $ip . '/verify.php?token=' . $token . '">Verify my email</a>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}

function send_forget_mail($toAddr, $toUsername, $password) {
  $subject = "[CAMAGRU] - Reset your password";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $headers .= 'From: <yfuks@student.42.fr>' . "\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . $toUsername . ' </br>
      There is your new password : ' . $password . ' </br>
    </body>
  </html>
  ';

  mail($toAddr, $subject, $message, $headers);
}
?>
