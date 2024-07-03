<?php
require_once "function.php";
$action = $_GET["action"];

if (isset($action)) {
    switch ($action) {
        case "login":
            // var_dump($_POST);
            $isLogin = login($_POST);
            if ($isLogin) {
                redirec("./index.php");
            } else {
                redirec("../login.php?message=error");
            }
            break;
        case "register":
            $isRegister = register($_POST);
            if ($isRegister) {
                redirec("../login.php");
            } else {
                redirec("../register.php?message=error");
            }
            break;
        case "logout":
            $role = logout();
            if ($role === "user") {
                redirec("../login.php");
            } elseif ($role === "admin") {
                redirec("../admin/login.php");
            }
            break;
    }
}
