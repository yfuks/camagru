<?php
session_start();

include_once("../functions/like.php");

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$type = $_POST['type'];

if ($uid == null
  || $img == null || $img == ""
  || $type == null || $type == "" || ($type != "L" && $type != "D")) {
  return;
}

$ret = get_like($uid, $img);

if ($ret != null && array_key_exists('type', $ret)) {
  if ($ret['type'] == $type) {
    echo "KO";
  } else {
    $val = update_like($uid, $img, $type);
    if ($val == 0) {
      echo "CHANGE";
    } else {
      echo $val;
    }
  }
} else {
  $val = add_like($uid, $img, $type);

  if ($val == 0) {
    echo "ADD";
  } else {
    echo $val;
  }
}

?>
