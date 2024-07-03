<?php


function extractRaw(mysqli_result $raw)
{
    $result = [];
    while ($row = $raw->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
}

function getData($table, $where = null)
{
    include "../config/connection.php";
    $querySelect = "SELECT * FROM $table";
    if ($where) {
        $querySelect = $querySelect . " WHERE $where";
    }

    return extractRaw($conn->query($querySelect));
}
