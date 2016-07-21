<?php
session_start();

include_once '../functions/signup.php';

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

signup($mail, $username, $password, $_SERVER['HTTP_HOST']);

header("Location: ../signup.php");
?>
