<?php

$db_file = "db/gastronomy.db";
$conn = new SQLite3($db_file);
if(!$conn){
    die("Connection failed: " . $conn->lastErrorMsg());
}