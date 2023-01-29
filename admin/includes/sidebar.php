<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);

?>
<aside class="sidenav shadow navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="index.php" target="_blank">
            <img src="../uploads/trendycart.png" class="navbar-brand-img h-100" height="30px" width="30px" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">TrendyCart</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link text-white <?= $page == "index.php" ? "active bg-gradient-info" : "" ?>" href="index.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1 ">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "category.php" ? "active bg-gradient-info" : "" ?>" href="category.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Category List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "add-category.php" ? "active bg-gradient-info" : "" ?>" href="add-category.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add</i>
                    </div>
                    <span class="nav-link-text ms-1">Add Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "products.php" ? "active bg-gradient-info" : "" ?>" href="products.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Product List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "add-product.php" ? "active bg-gradient-info" : "" ?>" href="add-product.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add</i>
                    </div>
                    <span class="nav-link-text ms-1">Add Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "posts.php" ? "active bg-gradient-info" : "" ?>" href="posts.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Post List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "add-post.php" ? "active bg-gradient-info" : "" ?>" href="add-post.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">add</i>
                    </div>
                    <span class="nav-link-text ms-1">Add post</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "clients.php" ? "active bg-gradient-info" : "" ?>" href="clients.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Client List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "orders.php" ? "active bg-gradient-info" : "" ?>" href="orders.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Orders</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn btn-info shadow button-text mt-4 w-100" href="../logout.php">Logout</a>
        </div>
    </div>
</aside>