<?php
session_start();

include '../functions/password.php';

// retreive values
$mail = $_POST['email'];

$_SESSION['error'] = null;

if (($res = reset_password($mail)) !== 0) {
  if ($res == -1) {
    $_SESSION['error'] = "user not found";
  } else {
    $_SESSION['error'] = "internal error";
  }
} else {
  $_SESSION['forgot_success'] = true;
}

header("Location: ../forgot.php");

?>
