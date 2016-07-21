<?php
session_start();

$_SESSION['error'] = null;
$_SESSION['id'] = null;

header("Location: ../index.php");

?>
