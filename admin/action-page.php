<?php
include "../functions/session.php";

$actionType = $_GET["action"] ?? null;
$status = $_GET["status"] ?? null;
$page = $_GET["active-page"] ?? null;

$currentPage = "";
switch ($page) {
    case "order":
        $currentPage = "order";
        break;
    case "menu":
    case "category":
        $currentPage = "menu";
        break;
}

$message = "";
switch ($actionType) {
    case "add":
        if ($status == "succes") {
            $message = "Sucess Add " . $page;
        } elseif ($status === "fail") {
            $message = "Failed add " . $page;
        }
        break;
    case "edit":
        if ($status === "succes") {
            $message = "Succes add " . $page;
        } elseif ($status == "fail") {
            $message = "Failed add " . $page;
        }
        break;
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
                            <!-- <h1 class="m-0">Dashboard</h1> -->
                            <p><a href="./<?= $page == "category" ? "menu" : $page ?>.php?active-page=<?= $page ?>" class="btn btn-secondary">Back</a></p>
                        </div><!-- /.col -->
                        <!-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div> -->
                        <!-- /.col -->
                        <div class="text-center">
                            <h1><?= $status ?></h1>
                            <p><?= $message ?></p>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <!-- Main content -->

        </div>
        <!-- Content Wrapper. Contains page content -->
    </div>

    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>
</body>

</html>