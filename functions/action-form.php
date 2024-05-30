<?php
require_once "function.php";
$action = $_GET["action"];

if (isset($action)) {
    switch ($action) {
        case "login":
            // var_dump($_POST);
            login($_POST);
            break;
        case "register":
            register($_POST);
            break;
        case "logout":
            logout();
            break;
    }
}
