<?php

include_once __DIR__ . "/views/_boiler.php";
include_once __DIR__ . "/views/_header.php";

session_start();

$user_id = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : null;
