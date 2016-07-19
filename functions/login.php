<?php

include 'database.php';

session_start();
echo "login...";

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];


?>
