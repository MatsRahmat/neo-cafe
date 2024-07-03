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

$raw = $conn->query("SELECT * FROM menus");
$menus = [];
if ($raw->num_rows > 0) {
    while ($row = $raw->fetch_assoc()) {
        $menus[] = $row;
    }
}

$orderDetail = null;
$orderListDetail = null;

if (isset($_GET["id"])) {
    $detailId = $_GET["id"];

    $sql = "SELECT * FROM orders WHERE id = $detailId";
    $sqlOrderList = "SELECT ol.menu_id as menu_id, m.name as menu_name, ol.quantity as quantity, ol.id as order_list_id FROM order_list ol LEFT JOIN menus m ON m.id = ol.menu_id WHERE ol.order_id = $detailId ORDER BY ol.id DESC";

    $rawOrder = $conn->query($sql);
    $rawOrderList = $conn->query($sqlOrderList);

    $orderDetail = extractRaw($rawOrder)[0];
    $orderListDetail = extractRaw($rawOrderList);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer>
        let listMenu = [];
    </script>
    <?php
    if (count($menus)) {
        $encodedJson = json_encode($menus, JSON_PRETTY_PRINT);
        echo "<script> listMenu = $encodedJson </script>";
    }
    ?>
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
        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Order</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <!-- general form elements -->
                <div class="d-flex justify-content-center w-100">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Order</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="../functions/admin_action_form.php?action=edit&page=order&id=<?= $detailId ?>" method="post" id="main-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" id="order-id" name="id" value="<?= $detailId ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_table">No Meja</label>
                                    <input type="text" class="form-control" id="no_table" placeholder="Enter No Table" name="no_table" value="<?= $orderDetail["no_table"] ?>">
                                </div>
                                <div class="form-group" id="menu-section">
                                    <?php foreach ($orderListDetail as $listOrder) : ?>
                                        <div class="row" data-row>
                                            <div class="col-9">
                                                <label>Menu</label>
                                                <select class="form-control" name="menu[]">
                                                    <option disabled>-- SELECT --</option>
                                                    <?php foreach ($menus as $menu) : ?>
                                                        <option value="<?= $menu['id'] ?>" <?= $menu["id"] == $listOrder["menu_id"] ? "selected" : "" ?>><?= $menu["name"] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="qty">Jumlah</label>
                                                <input type="number" class="form-control" id="qty" value="<?= $listOrder["quantity"] ?>" min="1" name="qty[]">
                                                <input type="hidden" value="<?= $listOrder["order_list_id"] ?>" name="order_list_id[]" />
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="d-flex justify-content-end px-3 mt-3">
                                    <button class="btn btn-outline-primary" type="button" id="btn-add-section">
                                        <i class="fas fa-plus">
                                        </i>
                                        <span>Add More</span>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" rows="3" name="note" placeholder="Enter Note ( Opt ) ..."><?= $orderDetail["note"] ?></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="btn-submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </section>
        </div>
        <!-- Content Wrapper. Contains page content -->
    </div>
    <!-- ============================== SCRIPT =========================================== -->
    <?php require_once "../layouts/admin-body-scripts.php" ?>
    <script>
        function createNewSection() {
            //* Create Div
            const divCol9 = document.createElement("div");
            const divCol3 = document.createElement("div");
            divCol9.classList.add("col-9");
            divCol3.classList.add("col-3");

            // * Create label and select option
            const labelSelect = document.createElement("label");
            labelSelect.innerText = "Menu";
            const select = document.createElement("select");
            select.classList.add("form-control");
            select.setAttribute("name", "menu[]");

            const defaultOpt = document.createElement("option");
            defaultOpt.setAttribute("selected", "");
            defaultOpt.setAttribute("disabled", "");
            defaultOpt.innerText = "-- SELECT --";
            select.append(defaultOpt);

            listMenu.forEach((menu) => {
                const options = document.createElement("option");
                options.setAttribute("value", menu.id);
                options.innerText = menu.name;
                select.append(options);
            });

            //* Append label and select option
            divCol9.append(labelSelect);
            divCol9.append(select);

            //* Create label and input for div col 3
            const labelJumlah = document.createElement("label");
            labelJumlah.innerText = "Jumlah";
            const jumlah = document.createElement("input");
            const orderListId = document.createElement("input");

            //* Set attribute
            orderListId.type = "hidden";
            orderListId.value = null;
            orderListId.name = "order_list_id[]";

            //* Set attribute
            jumlah.type = "number";
            jumlah.setAttribute("value", 1);
            jumlah.classList.add("form-control");
            jumlah.name = "qty[]";
            jumlah.min = "1";

            //* Append
            divCol3.append(labelJumlah);
            divCol3.append(jumlah);
            divCol3.append(orderListId);
            
            const parent = document.createElement("div");
            parent.classList.add("row");
            parent.append(divCol9);
            parent.append(divCol3);
            parent.setAttribute("data-row", "");
            return parent
        }
        document.getElementById("btn-add-section").addEventListener("click", function(e) {
            const menuSection = document.getElementById("menu-section");
            const newRow = createNewSection();
            menuSection.append(newRow);
            // console.log(document.querySelectorAll("[data-row]"));
        })

        document.getElementById("btn-submit").addEventListener("", function(e) {
            const form = document.forms[0];

            const formData = new FormData(form);
            console.log({
                formData
            });

            const noTable = form.querySelector('[id="no_table"]').value;
            const note = form.querySelector('[name="note"]').value;
            const orderList = form.querySelectorAll('[data-row]');
            // debugger;
            const listOrder = [];

            for (let order of orderList) {
                const menuId = order.querySelector('[name="menu"]').value;
                const qty = order.querySelector('[name="qty"]').value;
                const orderListId = order.querySelector('[name="order_list_id"]').value || null;

                listOrder.push({
                    menu: menuId,
                    qty,
                    order_list_id: orderListId
                })
                // console.log({
                //     order,
                //     menuId
                // });
            }

            console.log({
                listOrder
            });
        })
    </script>
</body>

</html>