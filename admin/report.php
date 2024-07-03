<?php
require_once "../functions/get-function.php";

$menus = getData("menus");
$categories = getData("categories");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <?php require_once "../layouts/admin-head-link.php" ?>
    <style>
        .container-fluid:not(:print) {
            display: none;
        }

        .container-fluid {
            print-color-adjust: exact;
        }
        table {
            border-collapse: collapse;
        }

        tr {
            padding: .5rem;
        }
    </style>
</head>

<body class="p-0 m-0">
    <div class="container-fluid">
        <div class="bg-warning d-flex gap-0 mb-4">
            <p class="bg-success p-0 m-0" style="width:3.12%">
                <span class="text-success">a</span>
            </p>
            <p class="bg-info p-0 m-0" style="width:6.25%">
                <span class="text-info">a</span>
            </p>
            <p class="bg-warning  p-0 m-0" style="width:12.5%">
                <span class="text-warning">a</span>
            </p>
            <p class="bg-secondary p-0 m-0" style="width:25%">
                <span class="text-secondary">a</span>
            </p>
        </div>
        <h1 class="" style="font-weight: 500;">Report Memu & Categories</h1>
        <div class="row pl-2 pr-2">
            <div class="col-6 border rounded">
                <h2 class="text-center">Menu</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menus as $index => $menu) : ?>
                            <tr>
                                <td><?= $index + 1 ?>"</td>
                                <td><?= $menu["name"] ?></td>
                                <td>Rp. <?= $menu["price"] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6 border rounded">
                <h2 class="text-center">Categories</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $cate) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $cate["name"] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script defer>
        window.addEventListener('DOMContentLoaded', function() {
            window.print("Report bulanan");
        })
    </script>
</body>

</html>