<?php

include 'database.php';

session_start();
echo "signup...";

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) FROM users WHERE ";
        $dbh->exec($sql);
    } catch (PDOException $e) {
        $_SESSION['error'] = "ERROR: ".$e->getMessage()."\n";
    }
?>
