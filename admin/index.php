<?php
include "../functions/session.php";
include_once "../config/connection.php";

function extractRaw(mysqli_result $raw)
{
    $result = [];
    while ($row = $raw->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
}

$newOrder = extractRaw($conn->query("SELECT count(id) AS total FROM orders o WHERE complete = false"))[0];
$competeOrder = extractRaw($conn->query("SELECT count(id) AS total FROM orders o WHERE complete = true"))[0];
$menus = extractRaw($conn->query("SELECT count(id) as total FROM menus"))[0];
$categori = extractRaw($conn->query("SELECT count(id)  as total FROM categories"))[0];

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
    <div class="wrapper">

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
                            <h1 class="m-0">Dashboard</h1>
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- New Order -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $newOrder["total"] ?></h3>
                                    <p>New Orders</p>
                                </div>
                                <div class="icon">
                                <i class="ion ion-coffee"></i>
                                </div>
                                <a href="order.php?active-page=order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- New Order -->

                        <!-- Complete Order-->
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3> <?= $competeOrder["total"] ?></h3>
                                    <p>Complete Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="order.php?active-page=order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- Complete Order-->

                        <!-- Menu -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $menus["total"] ?></h3>
                                    <p>Menu & Category</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- Menu -->

                        <!-- Category -->
                        <!-- <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $categori["total"] ?></h3>
                                    <p>Category</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> -->
                        <!-- Category -->
                    </div>
                </div>
            </section>
        </div>
        <!-- Content Wrapper. Contains page content -->
    </div>

    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>
</body>

</html>