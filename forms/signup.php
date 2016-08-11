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

if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = "You need to enter a valid email";
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

$url = $_SERVER['HTTP_HOST'] . str_replace("/forms/signup.php", "", $_SERVER['REQUEST_URI']);

signup($mail, $username, $password, $url);

header("Location: ../signup.php");
?>
