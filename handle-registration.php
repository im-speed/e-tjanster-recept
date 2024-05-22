<?php
    include("input-validation.php");
    ini_set('display_errors', 1);   
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            if(validateEmail($email)) {
                echo "success";
            }
            else {
                echo "error";
            }
        }
        else {
            echo "Email field is empty";
        }

        if (isset($_POST["password"])) {
            $password = $_POST["password"];
            if(validatePassword($password)) {
                echo "success";
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            }
            else {
                echo "error";
            }
        }

        if (isset($_POST["name"])) {
            $name = $_POST["name"];
        }

        else {
            echo "Password field is empty";
        }
    }
    else {
            echo "Form not submitted";
    }   

include ("establish-db-connection.php");
include ("db-queries.php");

addNewUser($conn, $name, $email, $hashed_password, "regular");