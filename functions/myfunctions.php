<?php
session_start();
include('../config/dbcon.php');

// get all records from a table
function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return mysqli_query($con, $query);
}

function getClientNumber()
{
    global $con;
    $query = "SELECT * FROM users where role_as=0";
    $data =  mysqli_query($con, $query);

    return mysqli_num_rows($data);
}


// get a record by ID from a table
function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return mysqli_query($con, $query);
}

// redirect to a URL with a message
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}

// get all unfulfilled orders
function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status='0'";
    return mysqli_query($con, $query);
}

// get all unfulfilled orders
function getOrdersNumber()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status='0'";
    $data =  mysqli_query($con, $query);
    return mysqli_num_rows($data);
}


// get all fulfilled orders
function getTotalSales()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_sales'];
}

// get total sales for the current week
function getCurrentWeekCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND WEEK(Updated_At) = WEEK(CURDATE())";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_sales'];
}

// get total sales for the current day
function getCurrentSalesToday()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND DATE(Updated_At) = CURDATE()";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_sales'];
}
// get total sales for the current month
function getCurrentMonthSales()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND MONTH(Updated_At) = MONTH(CURDATE()) AND YEAR(Updated_At) = YEAR(CURDATE())";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_sales'];
}


// get all users added this month
function getUsersAddedThisMonth()
{
    global $con;
    $query = "SELECT * FROM Users WHERE Role_As=0 AND MONTH(Created_At) = MONTH(CURDATE())";
    $data =  mysqli_query($con, $query);

    return mysqli_num_rows($data);
}

// get all current orders for the day
function getCurrentDayOrdersNumber()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE DAY(Created_At) = DAY(CURDATE())";
    $data =  mysqli_query($con, $query);
    return mysqli_num_rows($data);
}

// get order history which is status is not equal to 0
function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status!='0'";
    return mysqli_query($con, $query);
}

// Check the tracking no. validation for orders
function checkTrackingNoValid($tracking_no)
{
    global $con;
    $query = "SELECT * FROM Orders WHERE tracking_no='$tracking_no'";
    return mysqli_query($con, $query);
}

// Get the latest added in different table
function getLatestAdded($table)
{
    global $con;

    $query = "SELECT * FROM $table ORDER BY Created_At DESC LIMIT 1";
    return mysqli_query($con, $query);
}
