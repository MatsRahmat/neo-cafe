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

function json_dump($data)
{
    var_dump(json_encode($data, JSON_PRETTY_PRINT));
}

function consoleLog($message)
{
    echo "<script>console.log($message)</script>";
}

function login($post, $option = null)
{
    global $conn;
    $email = htmlspecialchars($post["email"]);
    $password = htmlspecialchars($post["password"]);

    $qeury = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

    $row = $conn->query($qeury);
    //* if result fetcing data is 0, user not found;
    if ($row->num_rows < 1) {
        return false;
    }
    $user =  extractRow($row)[0];
    if (!password_verify($password, $user["password"])) {
        return false;
    }
    if ($user["role"] !== "admin") {
        return false;
    }
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["userId"] = $user["id"];
    $_SESSION["isLogin"] = true;
    $_SESSION["role"] = $user["role"];
    return true;
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
    return $conn->query($queryInsert);
}

// ============================= [ ADMIN SECTION ] =================================

// -------------------------------- [ Order ] -------------------------------------

function addNewOrder($post)
{
    global $conn;
    $success = false;
    $note = htmlspecialchars($post["note"]);
    $noTable = htmlspecialchars($post["no_table"]);
    $userId = $_SESSION["userId"];
    $menus = $post["menu"];
    $qty = $post["qty"];
    $lastOrders = extractRow($conn->query("SELECT no_order FROM orders ORDER BY created_at DESC LIMIT 1 "));
    $lastNoOrder = 0;

    $orderId = null;
    if (count($lastOrders)) {
        $lastNoOrder = $lastOrders[0]["no_order"];
    };

    $sqlCreteOrder = "INSERT INTO orders (no_order, no_table, user_id, note) VALUES ($lastNoOrder + 1, '$noTable', $userId,'$note')";
    try {
        //code...
        $conn->begin_transaction();
        $conn->query($sqlCreteOrder);
        $lasInsert = extractRow($conn->query("SELECT id FROM orders ORDER BY created_at DESC LIMIT 1"));
        $orderId = null;
        if (count($lasInsert)) {
            $orderId = (int)$lasInsert[0]["id"];
        }
        if (is_array($menus) && is_array($qty) && $orderId !== null) {
            for ($i = 0; $i < count($menus); $i++) {
                $menu = (int)$menus[$i];
                $menuQty = (int)$qty[$i];

                $queryInsertList = "INSERT INTO order_list (order_id, menu_id, quantity) VALUES ($orderId, $menu, $menuQty)";
                $conn->query($queryInsertList);
            }
            $success = true;
        } else {
            throw new Exception("Failed add new order");
            $success = false;
        }
        $conn->commit();
        return $success;
    } catch (\Throwable $th) {
        //throw $th;
        $conn->rollback();
        return false;
    }
}

function editOrder($post, $id)
{
    global $conn;
    try {
        //code...
        $conn->begin_transaction();

        $noTable = htmlspecialchars($post["no_table"]);
        $note = htmlspecialchars($post["note"]);

        $orderListId = $post["order_list_id"];
        $menus = $post["menu"];
        $quantity = $post["qty"];

        $listOrder = [];
        $newData = [];

        foreach ($menus as $index => $menu) {
            $crQty = $quantity[$index];
            $crId = $orderListId[$index];
            if ($crId === "") {
                $newData[] = ["menu" => $menu, "qty" => $crQty];
            } else {
                $listOrder[] = ["menu" => $menu, "qty" => $crQty, "order_list_id" => $crId];
            }
        }

        $orderSql = "UPDATE orders SET no_table = '$noTable', note = '$note' WHERE id = $id";
        $conn->query($orderSql);

        foreach ($listOrder as $order) {
            $menuId = $order["menu"];
            $qty = $order["qty"];
            $olId = $order["order_list_id"];

            $updateSql = "UPDATE order_list SET menu_id = '$menuId', quantity = '$qty' WHERE id = $olId";
            $conn->query($updateSql);
        }

        if (count($newData) > 0) {
            foreach ($newData as $newOrder) {
                $menu = $newOrder["menu"];
                $qty = $newOrder["qty"];

                $sqlInsert = "INSERT INTO order_list (order_id, menu_id, quantity) VALUES ($id, $menu, $qty)";
                $conn->query($sqlInsert);
            }
        }
        $conn->commit();
        return true;
    } catch (\Throwable $th) {
        //throw $th;
        $conn->rollback();
        return false;
    }
    // var_dump(json_encode($post, JSON_PRETTY_PRINT));
    // die();
}

function deleteRecord($sql)
{
    global $conn;
    try {
        //code...
        $result =  $conn->query($sql);
        return $result;
    } catch (\Throwable $th) {
        //throw $th;
        consoleLog($th->getMessage());
        return false;
    }
}

function completeOrder($id)
{
    global $conn;
    $sqlUpdate = "UPDATE orders SET complete = true WHERE id = $id";
    return $conn->query($sqlUpdate);
}

function addRecord($sql)
{
    global $conn;
    return $conn->query($sql);
}

function editRecord($sql)
{
    global $conn;
    return $conn->query($sql);
}

function logout()
{
    $role = $_SESSION["role"];
    session_unset();
    session_destroy();
    return $role;
}
