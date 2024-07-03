<?php
include_once "../functions/get-function.php";
$detailId = null;
$isEdit = false;
$detailData = null;
// Asume that form is edit mode
if (isset($_GET["id"])) {
    $detailId = $_GET["id"];
    $isEdit = true;
    $detailData = getData("menus", "id = $detailId");
}

if ($detailData) {
    $detailData = $detailData[0];
}

$categories = getData("categories");
?>
<div class="row">
    <div class="col-12 d-flex justify-content-center align-item-center">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><?= $isEdit == true ? "Edit" : "Add" ?> menu</h3>
            </div>
            <form action="../functions/admin_action_form.php?action=<?= $isEdit == true ? "edit" : "add" ?>&page=menu<?= $isEdit && $detailId !== null ? "&id=$detailId" : "" ?>" method="POST" enctype="application/x-www-form-urlencoded">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="e.g Nasi goreng" value="<?= $detailData !== null ? $detailData["name"] : "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input class="form-control" id="price" name="price" type="text" placeholder="e.g 12000" value="<?= $detailData !== null ? $detailData["price"] : "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select class="form-control" name="category_id">
                            <option value="" disabled <?= $isEdit === false ? "selected" : "" ?>>-- SELECT CATEGORY --</option>
                            <?php foreach ($categories as $cate) : ?>
                                <option value="<?= $cate["id"] ?>" <?= $isEdit && $detailData !== null && $cate["id"] == $detailData["category_id"] ? "selected" : "" ?>><?= $cate["name"] ?></option>
                            <?php endforeach ?>
                        </select>
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