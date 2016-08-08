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

function get_all_montage() {
  include_once './setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT userid, img FROM gallery");
      $query->execute();

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function remove_montage($uid, $img) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
      $query->execute(array(':img' => $img, ':userid' => $uid));
      $query->closeCursor();
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_montages($start, $nb) {
  include_once './setup/database.php';

  try {
      if ($start < 0) {
        $start = 0;
      }
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
      $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
      $query->bindValue(':id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $s;
      $s['error'] = $e->getMessage();
      return ($s);
    }
}

?>
