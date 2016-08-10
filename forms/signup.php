<?php
session_start();

include_once '../functions/signup.php';

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

if ($mail != "" && $mail != null && $username != "" && $username != null && $password  != "" && $password  != null) {
  signup($mail, $username, $password, $_SERVER['HTTP_HOST']);
} else {
  $_SESSION['error'] = "You need to fill all fields";
}

header("Location: ../signup.php");
?>
