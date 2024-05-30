<?php

$host = "localhost";
$database = "neo-cafe";
$password = "root";
$user = "root";

$conn = mysqli_connect($host, $user, $password, $database);

if ($conn->connect_error) {
    die($conn->connect_error);
}
