#!/usr/bin/php
<?php
include 'database.php';

try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE camagru";
        $dbh->exec($sql);
        echo "Database created successfully<br>";
    } catch (PDOException $e) {
        echo "DB ERROR: ".$e->getMessage();
    }
?>
