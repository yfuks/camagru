<?php

function add_montage($userId, $imgPath) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
      $query->execute(array(':userid' => $userId, ':img' => $imgPath));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

?>
