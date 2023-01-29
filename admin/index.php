<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

//Users Data
$users = getAll('Users');
$user_number =  mysqli_num_rows($users);

$users_num = getUsersAddedThisMonth();
$users_this_month =  mysqli_num_rows($users_num);

//Sales
$sales = getAllCompletedOrders();
$sales_data = mysqli_fetch_all($sales, MYSQLI_ASSOC);
$total_prices = array_column($sales_data, 'Total_Price');
$total_sales = array_sum($total_prices);

$get_sale_today = getCurrentDayCompletedOrders();
$sales_data_today = mysqli_fetch_all($get_sale_today, MYSQLI_ASSOC);
$total_prices_today = array_column($sales_data_today, 'total_sales');
$total_sales_today = array_sum($total_prices_today);

$get_sale_month = getCurrentMonthCompletedOrders();
$sales_data_month = mysqli_fetch_all($get_sale_month, MYSQLI_ASSOC);
$total_prices_month = array_column($sales_data_month, 'total_sales');
$total_sales_month = array_sum($total_prices_month);

$get_week_sale = getCurrentWeekCompletedOrders();
$weekly_sales = mysqli_fetch_assoc($get_week_sale);


//Orders
$orders = getAllOrders();
$orders_number =  mysqli_num_rows($orders);

$orders_num = getCurrentOrdersThisDay();
$orders_this_day = mysqli_num_rows($orders_num);
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
                        <h4 class="mb-0 text-white">$<?= number_format(($weekly_sales['total_sales'] * 100) / 100, 2); ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">$<?= number_format(($total_sales_today * 100) / 100, 2); ?> </span>added sales today</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                        <h4 class="mb-0 text-white">$<?= $total_sales ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+$<?= number_format(($total_sales_month * 100) / 100, 2); ?> </span>added sales this month</p>
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
                        <p class="text-sm mb-0 text-capitalize">Total Users</p>
                        <h4 class="mb-0 text-white"><?= $user_number ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?= $users_this_month ?> </span>addded users this month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
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