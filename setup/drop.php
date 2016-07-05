#!/usr/bin/php
<?php
include 'database.php';

// DROP DATABASE
try {
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database droped successfully\n";
    } catch (PDOException $e) {
        echo "ERROR DROPING DB: \n".$e->getMessage()."\n";
    }
?>
