<?php
include "../functions/session.php";
include_once "../functions/get-function.php";

$menus = getData("menus");
$category = getData("categories");
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
                            <h1 class="m-0">Menu</h1>
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- MENUS -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Menu</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-primary btn-sm" href="./add-menu.php" role="button">
                                            <i class="fas fa-plus fa-solid">
                                            </i>
                                            Add Menu
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="menu-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menus as $index => $menu) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $menu["name"] ?></td>
                                                    <td><?= $menu["price"] ?></td>
                                                    <td>
                                                        <div class="m-0 p-0 d-flex justify-content-center">
                                                            <a href="./edit-menu.php?id=<?= $menu["id"] ?>" role="button" class="btn btn-info btn-sm mr-2">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="../functions/admin_action_form.php?page=menu&action=delete&id=<?= $menu["id"] ?>" role="button" class="btn btn-danger btn-sm ml-2">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- CATEGORY -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Category</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-primary btn-sm" href="./add-category.php" role="button">
                                            <i class="fas fa-plus fa-solid">
                                            </i>
                                            Add category
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="menu-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($category as $index => $cate) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $cate["name"] ?></td>
                                                    <td>
                                                        <div class="m-0 p-0 d-flex justify-content-center">
                                                            <a href="./edit-category.php?id=<?= $cate["id"] ?>" role="button" class="btn btn-info btn-sm mr-2">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="../functions/admin_action_form.php?page=category&action=delete&id=<?= $cate["id"] ?>" role="button" class="btn btn-danger btn-sm ml-2">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
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

    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>
    <script>
        $('#menu-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
</body>

</html>