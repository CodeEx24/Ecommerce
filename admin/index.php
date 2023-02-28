<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
// Retrieve all users data
// $users = getAllClients();
// Get the number of rows returned from the query
$user_number = getClientNumber();

// Get the number of rows returned from the query
$users_this_month = getUsersAddedThisMonth();

// Get the total sales
$total_sales = getTotalSales();

// Get current sales today
$total_sales_today = getCurrentSalesToday();

// Get total sales for the current month
$total_sales_month = getCurrentMonthSales();

// Get weekly sales
$weekly_sales = getCurrentWeekCompletedOrders();

// Get the orders number
$orders_number = getOrdersNumber();

// Get the number of rows returned from the query
$orders_this_day = getCurrentDayOrdersNumber();
?>

<div class="container-fluid mt-5 mb-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Week's Sales</p>
                        <h4 class="mb-0 text-white">₱ <?= number_format(($weekly_sales * 100) / 100, 2); ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">₱ <?= number_format(($total_sales_today * 100) / 100, 2); ?> </span>added sales today</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">attach_money</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                        <h4 class="mb-0 text-white">₱ <?= number_format(($total_sales * 100) / 100, 2); ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+ ₱<?= number_format(($total_sales_month * 100) / 100, 2); ?> </span>added sales this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Clients</p>
                        <h4 class="mb-0 text-white"><?= $user_number ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?= $users_this_month ?> </span>addded clients this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">shop</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Pending Orders</p>
                        <h4 class="mb-0 text-white"><?= $orders_number ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?= $orders_this_day ?> </span>added orders today</p>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 card">
        <div class="row my-4 mx-4">
            <div class="col-md-4">
                <img src="assets/image/mainpage.jpg" alt="" class="w-100 h-100" style="object-fit: cover;">
            </div>
            <div class="col-md-4">
                <img src="assets/image/mainpage2.jpg" alt="" class="w-100 h-100" style="object-fit: cover;">
            </div>
            <div class="col-md-4">
                <img src="assets/image/mainpage3.jpg" alt="" class="w-100 h-100" style="object-fit: cover;">
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php') ?>