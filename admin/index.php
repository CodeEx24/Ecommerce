<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
// Retrieve all users data
$users = getAll('Users');
// Get the number of rows returned from the query
$user_number = mysqli_num_rows($users);

// Retrieve the number of users added this month
$users_num = getUsersAddedThisMonth();
// Get the number of rows returned from the query
$users_this_month = mysqli_num_rows($users_num);

// Retrieve all completed orders data
$sales = getAllCompletedOrders();
// Fetch all the rows as associative arrays
$sales_data = mysqli_fetch_all($sales, MYSQLI_ASSOC);
// Extract the 'Total_Price' column from the $sales_data array
$total_prices = array_column($sales_data, 'Total_Price');
// Calculate the total sales from all the 'Total_Price' values
$total_sales = array_sum($total_prices);

// Retrieve all completed orders for the current day
$get_sale_today = getCurrentDayCompletedOrders();
// Fetch all the rows as associative arrays
$sales_data_today = mysqli_fetch_all($get_sale_today, MYSQLI_ASSOC);
// Extract the 'total_sales' column from the $sales_data_today array
$total_prices_today = array_column($sales_data_today, 'total_sales');
// Calculate the total sales for today from all the 'total_sales' values
$total_sales_today = array_sum($total_prices_today);

// Retrieve all completed orders for the current month
$get_sale_month = getCurrentMonthCompletedOrders();
// Fetch all the rows as associative arrays
$sales_data_month = mysqli_fetch_all($get_sale_month, MYSQLI_ASSOC);
// Extract the 'total_sales' column from the $sales_data_month array
$total_prices_month = array_column($sales_data_month, 'total_sales');
// Calculate the total sales for the current month from all the 'total_sales' values
$total_sales_month = array_sum($total_prices_month);

// Retrieve all completed orders for the current week
$get_week_sale = getCurrentWeekCompletedOrders();
// Fetch the first row as an associative array
$weekly_sales = mysqli_fetch_assoc($get_week_sale);

// Retrieve all orders
$orders = getAllOrders();
// Get the number of rows returned from the query
$orders_number = mysqli_num_rows($orders);

// Retrieve the number of current day's orders
$orders_num = getCurrentOrdersThisDay();
// Get the number of rows returned from the query
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
                        <i class="material-icons opacity-10">attach_money</i>
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