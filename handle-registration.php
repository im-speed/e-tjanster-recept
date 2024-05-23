<?php
include("input-validation.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: registration.php?error=Registration form not submitted.");
    exit;
}

if (!isset($_POST["email"])) {

    header("Location: registration.php?error=Email is empty.");
    exit;
}

$email = $_POST["email"];

if (!validateEmail($email)) {
    header("Location: registration.php?error=Email is invalid.");
    exit;
}

if (!isset($_POST["password"])) {
    header("Location: registration.php?error=Password is empty.");
    exit;
}

$password = $_POST["password"];

if (!validatePassword($password)) {
    header("Location: registration.php?error=Password is invalid.");
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if (!isset($_POST["name"])) {
    header("Location: registration.php?error=Name is invalid.");
    exit;
}

$name = $_POST["name"];

include("establish-db-connection.php");
include("db-queries.php");

if (addNewUser($conn, $name, $email, $hashed_password, "regular")) {
    header("Location: login.php?notice=Account successfully created.");
} else {
    header("Location: registration.php?error=Failed to create account.");
}
