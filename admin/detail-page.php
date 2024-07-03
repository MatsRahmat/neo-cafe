<?php
include "../functions/session.php";
include "../config/connection.php";

function extractRaw(mysqli_result $raw)
{
    $result = [];
    while ($row = $raw->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
}

if (isset($_GET["id"])) {
    $orderId = $_GET["id"];
    $sqlGet = "SELECT id, no_table, no_order, user_id, complete, note FROM orders WHERE id = $orderId";
    $order = extractRaw($conn->query($sqlGet))[0];

    $orderListSql = "SELECT ol.quantity as quantity, m.name as menu_name FROM order_list ol LEFT JOIN menus m ON m.id = ol.menu_id WHERE ol.order_id = $orderId";
    $listMenu = extractRaw($conn->query($orderListSql));

    $userId = $order['user_id'];
    $requestUser = extractRaw($conn->query("SELECT username FROM users WHERE id = $userId"));
    if (count($requestUser) > 0) {
        $requestUser = $requestUser[0];
    }
} else {
    header("Location: order.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neo Cafe | Admin panel</title>
    <?php require_once "../layouts/admin-head-link.php" ?>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <div class="wrapper container-body">

        <!-- Navbar -->
        <?php require_once "../layouts/navbar.php" ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once "../layouts/sidebar.php" ?>
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Order</h1>
                            <p class="p-2 btn btn-success" role="button" style="font-size: 1rem; border: 1px dotted black; border-radius: 12px; display: inline-block;">
                                <a href="order.php?active-page=order" style="text-decoration: none; color: #fff;">
                                    <i class="fas fa-solid fa-arrow-left"></i>
                                    Back</a>
                            </p>
                        </div><!-- /.col -->
                        <!-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div> -->
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center align-item-center">
                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">For table <?= $order["no_table"] ?>, Order by <?= $requestUser["username"] ?> </h3>
                                </div>
                                <!-- Card header -->
                                <div class="card-body overflow-scroll">
                                    <div class="position-relative p-3 bg-gray">
                                        <div class="ribbon-wrapper ribbon-lg">
                                            <div class="ribbon bg-primary">
                                                Table <?= $order["no_table"] ?>
                                            </div>
                                        </div>
                                        <h3>Order no: <?= $order["no_order"] ?></h3>
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="pl-2 m-0 h5">
                                                    Menu
                                                </p>
                                            </div>
                                            <div class="col-4 h5">
                                                Quantity
                                            </div>
                                            <?php
                                            $count = 0;
                                            foreach ($listMenu as $orderList) : ?>
                                                <div class="col-1">
                                                    -
                                                </div>
                                                <div class="col-7">
                                                    <?= $orderList["menu_name"] ?>
                                                </div>
                                                <div class="col-4">
                                                    <?= $orderList["quantity"] ?>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                        <div class="mt-2">
                                            <h5>Note</h5>
                                            <p>
                                                <?= $order["note"] ?>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <p class="badge rounded-pill <?= $order["complete"] ? "badge-danger text-secondary" : " badge-warning" ?>"><?= $order["complete"] ? "Complete" : "Pending" ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end px-3 pb-3">
                                    <!-- <div class="pr-2">
                                        <button class="btn btn-outline-info" data-btn="print" id="btn-print">
                                            Print
                                        </button>
                                    </div> -->
                                    <?php if (!$order["complete"]) : ?>
                                        <div class=" pl-2">
                                            <a href="../functions/admin_action_form.php?action=complete&id=<?= $orderId ?>" role="button" class="btn btn-success">
                                                Complete order
                                            </a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->

        </div>
        <!-- Content Wrapper. Contains page content -->
    </div>
    <div style="display: none;" class="container-print">
        <div class="border rounded d-inline-block" style="min-width: 19rem; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
            <h6 class="text-center underline"><u>Neo Coffe</u></h6>
            <div class=" pl-4 pr-4">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Menu</td>
                            <td>Price</td>
                            <td>Quantiy</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listMenu as $index => $menu) : ?>
                            <?php var_dump($menu) ?>
                            <tr>
                                <td><?= $menu["menu_name"] ?></td>
                                <td>2</td>
                                <td><?= $menu["quantity"] ?></td>
                                <td>24000</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script>
        $(window).ready(function() {
            $('[data-btn="print"]').click(function() {
                const containerBody = $(".container-body");
                const containerPirnt = $(".container-print");
                containerBody.hide()
                containerPirnt.show()
                window.print("Print nota");
                containerBody.show()
                containerPirnt.hide()

            })
        })
    </script>
</body>

</html>