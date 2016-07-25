#!/usr/bin/php
<?php
include 'database.php';

// CREATE DATABASE
try {
        // Connect to Mysql server
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING DB: \n".$e->getMessage()."\nAborting process\n";
        exit(-1);
    }

// CREATE TABLE USERS
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `users` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `username` VARCHAR(50) NOT NULL,
          `mail` VARCHAR(100) NOT NULL,
          `password` VARCHAR(255) NOT NULL,
          `token` VARCHAR(50) NOT NULL,
          `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
        )";
        $dbh->exec($sql);
        echo "Table users created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

// CREATE TABLE GALLERY
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `gallery` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `img` VARCHAR(100) NOT NULL,
          FOREIGN KEY (userid) REFERENCES users(id)
        )";
        $dbh->exec($sql);
        echo "Table gallery created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
?>
