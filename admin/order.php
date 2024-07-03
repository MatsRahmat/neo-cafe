<?php
include "../functions/session.php";
include_once "../config/connection.php";
include_once "../functions/enums.php";

function extractRow(mysqli_result $raw)
{
    $result = [];
    while ($row = $raw->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
}

$sql = "SELECT * FROM orders ORDER BY created_at DESC";

$response = $conn->query($sql);
$result = [];
if ($response->num_rows > 0) {
    $result = extractRow($response);
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

        <?php require_once "../layouts/navbar.php" ?>

        <?php require_once "../layouts/sidebar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Order</h1>
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
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Order</h3>
                        <div class="card-tools">
                            <a class="btn btn-primary btn-sm" href="add-order.php" role="button">
                                <i class="fas fa-plus fa-solid">
                                </i>
                                Add order
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if (count($result) > 1) : ?>
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            No
                                        </th>
                                        <th style="width: 20%">
                                            No. Order
                                        </th>
                                        <th style="width: 20%">
                                            Date
                                        </th>
                                        <th>
                                            Note
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 30%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $index => $row) :
                                    ?>
                                        <tr ondblclick="detailOrder(<?= $row['id'] ?>)" class="" role="button">
                                            <td>
                                                <?= $index + 1 ?>
                                            </td>
                                            <td>
                                                <a>
                                                    No. <?= $row['no_order'] ?>
                                                </a>
                                                <br />
                                                <small>
                                                    Meja : <?= $row["no_table"] ?>
                                                </small>
                                            </td>
                                            <td>
                                                <p> <?= date_format(date_create($row["created_at"]), "Y-m-d H:i") ?></p>
                                            </td>
                                            <td class="project_progress">
                                                <p>
                                                    <?= $row["note"] ?>
                                                </p>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge <?= $row["complete"] == true ? 'badge-success' : ' badge-warning text-dark' ?>"><?= $row["complete"] == true ? "Complete" : "Pending" ?></span>
                                            </td>
                                            <td class="project-actions text-right">
                                                <!-- <a class="btn btn-info btn-sm" href="detail-page.php?id=<?= $row["id"] ?>&page=order">
                                                    <i class="fas fa-solid fa-file"></i>
                                                    </i>
                                                    Detail
                                                </a> -->
                                                <a class="btn btn-info btn-sm" href="edit-order.php?id=<?= $row["id"] ?>">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="../functions/admin_action_form.php?action=delete&page=order&id=<?= $row["id"] ?>">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h1>No Order apear</h1>
                        <?php endif ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Modal -->
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Default Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>One fine body&hellip;</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </section>
        </div>
        <!-- Content Wrapper. Contains page content -->
    </div>

    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>

    <script>
        function detailOrder(id) {
            // alert(`AAA ${id}`)
            window.location.replace("detail-page.php?id=".concat(id))
        }
    </script>
</body>

</html>