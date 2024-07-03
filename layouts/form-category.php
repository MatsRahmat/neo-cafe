<?php
include_once "../functions/get-function.php";
$detailId = null;
$isEdit = false;
$detailData = null;

// Asume that form is edit mode
if (isset($_GET["id"])) {
    $detailId = $_GET["id"];
    $isEdit = true;
    $detailData = getData("categories", "id = $detailId");
}

if ($detailData) {
    $detailData = $detailData[0];
}

// $categories = getData("categories");
?>
<div class="row">
    <div class="col-12 d-flex justify-content-center align-item-center">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><?= $isEdit == true ? "Edit" : "Add" ?> Category</h3>
            </div>
            <form action="../functions/admin_action_form.php?action=<?= $isEdit == true ? "edit" : "add" ?>&page=category<?= $isEdit && $detailId !== null ? "&id=$detailId" : "" ?>" method="POST" enctype="application/x-www-form-urlencoded">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="e.g Nasi goreng" value="<?= $detailData !== null ? $detailData["name"] : "" ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">
                            <?= $isEdit === true ? "Save" : "Submit" ?>
                        </button>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
    </div>
</div>