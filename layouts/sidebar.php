<?php

$activePage = "none";

if (isset($_GET["active-page"])) {
    $activePage = $_GET["active-page"];
}

echo "<script>console.log($activePage)</script>";

enum EnumMenu
{
    case dashboard;
    case order;
    case menu;
    case category;
}

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../admin/index.php?active-page=dashboard" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Neo Cafe Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 mb-1 d-flex align-item-center">
            <div class="info">
                <h3 class="text-white fs-2"><?= $sessionUsername; ?></h3>
                <!-- <a href="#" class="d-block"></a> -->
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar">
                <li class="nav-item">
                    <a href="index.php?active-page=dashboard" class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="order.php?active-page=order" class="nav-link <?= $activePage === 'order' ? 'active' : '' ?>">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="menu.php?active-page=menu" class="nav-link <?= $activePage === "menu" ? "active" : '' ?>">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Menu & Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin/report3.php" target="_blank" class="nav-link">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php?active-page=profile" class="nav-link <?= $activePage === "profile" ? "active" : '' ?>">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../functions/admin_action_form.php?action=logout" class="nav-link">
                        <!-- <i class="far fa-circle nav-icon"></i> -->
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->