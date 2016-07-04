#!/usr/bin/php
<?php
include 'database.php'

try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("CREATE DATABASE `'.$DB_NAME.'`;
                CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
                GRANT ALL ON `$db`.* TO '$DB_USER'@'localhost';
                FLUSH PRIVILEGES;")
        or die(echo $dbh->errorInfo());

    } catch (PDOException $e) {
        die(echo "DB ERROR: ".$e->getMessage());
    }
?>
