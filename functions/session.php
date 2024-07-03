<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["userId"]) && !isset($_SESSION["email"])) {
    header("Location:login.php");
    exit();
}

$sessionUsername = $_SESSION["username"];
$sessionEmail = $_SESSION["email"];
$sessionUserId = $_SESSION["userId"];
$sessionRole = $_SESSION["role"];
