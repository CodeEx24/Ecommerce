<nav class="navbar navbar-dark navbar-expand-md sticky-top py-3 sticky-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center justify-content-between" style="width: 180px;" href="index.php">
            <img src="./uploads/trendycart.png" class="navbar-brand-img h-100" height="50px" width="50px" alt="main_logo">
            <span>TrendyCart</span>
        </a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.html">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li> -->
                <li class="nav-item"><a class="nav-link" href="categories.php">Collections</a></li>
            </ul>
            <a href="cart.php" class="me-md-2 me-lg-4">Cart</a>

            <?php
            if (isset($_SESSION['auth'])) {
            ?>
                <div class="dropdown show">
                    <a class="btn btn-primary shadow dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <?= $_SESSION['auth_user']['name']; ?>
                    </a>

                    <div class="dropdown-menu darker-item" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="my-orders.php">Orders</a>
                        <!-- <a class="dropdown-item" href="view-order.php">View Order</a> -->
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <a class="btn btn-primary shadow" role="button" href="login.php">Log In</a>
            <?php
            }
            ?>

        </div>
    </div>
</nav>