<?php
session_start();

$_SESSION['error'] = null;
$_SESSION['id'] = null;
$_SESSION['username'] = null;

header("Location: ../index.php");

?>
