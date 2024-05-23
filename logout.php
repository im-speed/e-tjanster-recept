<?php

session_start();

if (isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] = null;
}

header("Location: index.php?notice=Logged out.");
