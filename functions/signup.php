<?php

include '../setup/database.php';
include '../functions/mail.php';

session_start();

// retreive values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $dbh->prepare("SELECT id FROM users WHERE username=?");
        $query->execute(array($username));

        if ($val = $query->fetch()) {
          $_SESSION['error'] = "user already exist";
          header("Location: ../signup.php");
          exit(-1);
        }
        $query->closeCursor();

        // encrypt password
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query= $dbh->prepare("INSERT INTO users (username, mail, password, token) VALUES (:username, :mail, :password, :token)");
        $token = uniqid(rand(), true);
        $query->execute(array(':username' => $username, ':mail' => $mail, ':password' => $password, ':token' => $token));
        send_verification_email($mail, $username, $token, $_SERVER['HTTP_HOST']);

        $_SESSION['signup_success'] = true;

        header("Location: ../signup.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "ERROR: ".$e->getMessage();
    }
?>
