<?php
session_start();

include_once '../functions/signup.php';

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

if ($mail == "" || $mail == null || $username == "" || $username == null || $password == "" || $password == null) {
  $_SESSION['error'] = "You need to fill all fields";
  header("Location: ../signup.php");
  return;
}

if (strlen($username) > 50 || strlen($username) < 3) {
  $_SESSION['error'] = "Username should be beetween 3 and 50 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($password) < 3) {
  $_SESSION['error'] = "Password should be beetween 3 and 255 characters";
  header("Location: ../signup.php");
  return;
}

signup($mail, $username, $password, $_SERVER['HTTP_HOST']);

header("Location: ../signup.php");
?>
