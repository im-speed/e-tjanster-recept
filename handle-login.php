<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        header("Location: login.php?error=Email is empty.");
        exit();
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        header("Location: login.php?error=Password is empty.");
        exit();
    }
} else {
    header("Location: login.php?error=Login form not submitted.");
    exit();
}

require_once __DIR__ . "/include/db/functions/user.php";
include __DIR__ . '/include/db/functions/establish-db-connection.php';

if (matchEmail($conn, $email)) {
    $row = getPassFromEmail($conn, $email);
    if (password_verify($password, $row['Password'])) {
        session_start();
        $_SESSION['UserID'] = $row['UserID'];
        header("Location: index.php?notice=Login successful.");
        exit();
    } else {
        header("Location: login.php?error=Incorrect password.");
        exit();
    }
} else {
    header("Location: login.php?error=Email is not registered.");
    exit();
}
