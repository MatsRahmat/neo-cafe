<?php
require_once "function.php";
$action = $_GET["action"];

if (isset($action)) {
    switch ($action) {
        case "login":
            $isLogin = login($_POST);
            if ($isLogin) {
                redirec("../admin/index.php?active-page=dashboard&action=login&status=succes");
            } else {
                redirec("../admin/login.php?action=login&status=fail");
            }
            break;
        case "add":
            $menu = isset($_GET["page"]) ? $_GET["page"] : null;
            switch ($menu) {
                case "order":
                    $result = addNewOrder($_POST);
                    if ($result) {
                        redirec("../admin/action-page.php?action=add&status=succes&active-page=order");
                    } else {
                        redirec("../admin/action-page.php?action=add&status=fail&active-page=order");
                    }
                    break;
                case "menu":
                    $name = htmlspecialchars($_POST["name"]);
                    $price = htmlspecialchars($_POST["price"]);
                    $category = htmlspecialchars($_POST["category_id"]);
                    $result = addRecord("INSERT INTO menus (name, price, category_id) VALUES ('$name', $price, $category)");

                    if ($result) {
                        redirec("../admin/action-page.php?action=add&status=succes&active-page=menu");
                        exit();
                    } else {
                        redirec("../admin/action-page.php?action=add&status=fail&active-page=menu");
                        exit();
                    }
                    break;
                case "category":
                    $name = htmlspecialchars($_POST["name"]);
                    $result = addRecord("INSERT INTO categories (name) VALUES ('$name')");
                    if ($result) {
                        redirec("../admin/action-page.php?action=add&status=succes&active-page=category");
                        exit();
                    } else {
                        redirec("../admin/action-page.php?action=add&status=fail&active-page=category");
                        exit();
                    }
                    break;
            }
            break;
        case "edit":
            $page = isset($_GET["page"]) ? $_GET["page"] : null;
            if ($page) {
                switch ($page) {
                    case "order":
                        $result = editOrder($_POST, $_GET["id"]);
                        if ($result) {
                            redirec("../admin/action-page.php?action=edit&status=succes&active-page=order");
                        } else {
                            redirec("../admin/action-page.php?action=edit&status=fail&active-page=order");
                        }
                        break;
                    case "menu":
                        $name = htmlspecialchars($_POST["name"]);
                        $price = htmlspecialchars($_POST["price"]);
                        $categoryId = htmlspecialchars($_POST["category_id"]);
                        $menuId = $_GET["id"];
                        $result = editRecord("UPDATE menus SET name = '$name', price = '$price', category_id = '$categoryId' WHERE id = $menuId ");
                        if ($result) {
                            redirec("../admin/action-page.php?action=edit&status=succes&active-page=menu");
                        } else {
                            redirec("../admin/action-page.php?action=edit&status=fail&active-page=menu");
                        }
                        break;
                    case "category":
                        $name = htmlspecialchars($_POST["name"]);
                        $categoriId = $_GET["id"];
                        $result = editRecord("UPDATE categories SET name = '$name' WHERE id = $categoriId ");
                        if ($result) {
                            redirec("../admin/action-page.php?action=edit&status=succes&active-page=category");
                        } else {
                            redirec("../admin/action-page.php?action=edit&status=fail&active-page=category");
                        }
                        break;
                }
            }

            break;
        case "delete":
            switch ($_GET["page"]) {
                case "order":
                    $orderId =  $_GET["id"];
                    $orderDel = deleteRecord("DELETE FROM orders WHERE id = $orderId");
                    $orderListDel = deleteRecord("DELETE FROM order_list WHERE order_id = $orderId");
                    if ($orderDel && $orderListDel) {
                        redirec("../admin/order.php?action=delete&status=succes&active-page=order");
                        exit();
                        return;
                    }
                    redirec("../admin/order.php?action=delete&status=fail&active-page=order");
                    break;
                case "menu":
                    $menuId = $_GET["id"];
                    $result = deleteRecord("DELETE FROM menus WHERE id = $menuId");
                    if ($result) {
                        redirec("../admin/menu.php?action=delete&status=succes&active-page=menu");
                        exit();
                        return;
                    }
                    redirec("../admin/menu.php?action=delete&status=fail&active-page=menu");
                    exit();
                    break;
                case "category":
                    $categoryId = $_GET["id"];
                    $result = deleteRecord("DELETE FROM categories WHERE id = $categoryId");
                    if ($result) {
                        redirec("../admin/menu.php?action=delete&status=succes&active-page=menu");
                        exit();
                    } else {
                        redirec("../admin/menu.php?action=delete&status=fail&active-page=menu");
                        exit();
                    }
                    break;
            }
            break;
        case "complete":
            $id = $_GET["id"];
            $result = completeOrder($id);
            if ($result) {
                redirec("../admin/order.php?action=complete&status=succes&active-page=order");
            } else {
                redirec("../admin/order.php?action=complete&status=fail&active-page=order");
            }
            break;
        case "logout":
            $role = logout();
            if ($role === "admin") {
                redirec("../admin/login.php");
                exit();
            } else {
                redirec("../login.php");
                exit();
            }
            break;
    }
}
