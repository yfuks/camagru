<?php
session_start();

include_once("../functions/montage.php");

$uid = $_SESSION['id'];
$src = $_POST['src'];

$val = remove_montage($uid, $src);

if ($val == 0) {
  echo "OK";
  unlink("../montage/" . $src);
} else {
  echo "KO";
}

?>
