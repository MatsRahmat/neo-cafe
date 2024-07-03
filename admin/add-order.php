<?php
include "../functions/session.php";
include_once "../config/connection.php";

$raw = $conn->query("SELECT * FROM menus");
$menus = [];
if ($raw->num_rows > 0) {
    while ($row = $raw->fetch_assoc()) {
        $menus[] = $row;
    }
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
                            <h1 class="m-0">Add Order</h1>
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
                <!-- general form elements -->
                <div class="d-flex justify-content-center w-100">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Order</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form onsubmit="disableSubmit" action="../functions/admin_action_form.php?action=add&page=order" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_table">No Meja</label>
                                    <input type="text" class="form-control" id="no_table" placeholder="Enter No Table" name="no_table">
                                </div>
                                <div class="form-group" id="menu-section">
                                    <div class="row" data-row>
                                        <div class="col-9">
                                            <label>Menu</label>
                                            <select class="form-control" name="menu[]">
                                                <option disabled selected>-- SELECT --</option>
                                                <?php foreach ($menus as $menu) : ?>
                                                    <option value="<?= $menu['id'] ?>"><?= $menu["name"] ?></option>
                                                <?php endforeach ?>
                                                <!-- <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option> -->
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="qty">Jumlah</label>
                                            <input type="number" class="form-control" id="qty" value="1" min="1" name="qty[]">
                                        </div>
                                    </div>
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
                                    <textarea class="form-control" rows="3" name="note" placeholder="Enter Note ( Opt ) ..."></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        function disableSubmit(e) {
            e.prefentDefault();
        }

        console.log(listMenu);

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
            //* Set attribute
            jumlah.type = "number";
            jumlah.setAttribute("value", 1);
            jumlah.classList.add("form-control");
            jumlah.name = "qty[]";
            jumlah.min = "1";

            //* Append
            divCol3.append(labelJumlah);
            divCol3.append(jumlah);
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
            console.log(document.querySelectorAll("[data-row]"));
        })
    </script>
</body>

</html>