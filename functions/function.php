<?php
require_once "../config/connection.php";
session_start();

function extractRow(mysqli_result $mysqlResponse)
{
    $result = [];
    while ($row = $mysqlResponse->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
}

function redirec(string $path)
{
    header("Location:" . $path);
    exit();
}

function login($post, $option = null)
{
    global $conn;
    $email = htmlspecialchars($post["email"]);
    $password = htmlspecialchars($post["password"]);

    $qeury = "SELECT * FROM users WHERE email = '$email'";

    $user = extractRow($conn->query($qeury))[0];
    if (password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["userId"] = $user["id"];
        $_SESSION["isLogin"] = true;
        redirec("../index.php");
    } else {
        redirec("../login.php?message=error");
    }
}

function register($post, $option = null)
{
    global $conn;
    $username = htmlspecialchars($post["username"]);
    $email = htmlspecialchars($post["email"]);
    $password = htmlspecialchars($post["password"]);
    $role = "user";
    if (isset($post["role"])) {
        $role = htmlspecialchars($post["role"]);
    }
    $hassed = password_hash($password, PASSWORD_BCRYPT);
    $queryInsert = "INSERT INTO users (username, email, password, role) VALUES ('$username','$email', '$hassed', '$role')";
    $result = $conn->query($queryInsert);

    if ($result) {
        redirec("../login.php");
    } else {
        redirec("../register.php?message=error");
    }
}


function logout(){
    session_unset();
    session_destroy();
    redirec("../login.php");
}
