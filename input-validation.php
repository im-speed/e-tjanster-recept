<?php
function validateName($name){
    return preg_match("/.{2,50}/", $name);
}
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function validatePassword($password){
    return preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/", $password);
}