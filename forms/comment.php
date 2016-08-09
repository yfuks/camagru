<?php
session_start();

include_once("../functions/montage.php");

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$comment = $_POST['comment'];

if ($uid == null || $comment == null || $comment == "" || $img == null || $img == "") {
  return;
}

$val = comment($uid, $img, $comment);

if ($val == 0) {
  echo htmlspecialchars($username);
}

?>
