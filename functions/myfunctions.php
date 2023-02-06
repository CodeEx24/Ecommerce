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

// get all fulfilled orders
function getAllCompletedOrders()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status='1'";
    return mysqli_query($con, $query);
}

// get total sales for the current week
function getCurrentWeekCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND WEEK(Updated_At) = WEEK(CURDATE())";
    return mysqli_query($con, $query);
}

// get total sales for the current day
function getCurrentDayCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND DATE(Updated_At) = CURDATE()";
    return mysqli_query($con, $query);
}

// get total sales for the current month
function getCurrentMonthCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND MONTH(Updated_At) = MONTH(CURDATE()) AND YEAR(Updated_At) = YEAR(CURDATE())";
    return mysqli_query($con, $query);
}

// get all users added this month
function getUsersAddedThisMonth()
{
    global $con;
    $query = "SELECT * FROM Users WHERE Role_As='0' AND MONTH(Created_At) = MONTH(CURDATE())";
    return mysqli_query($con, $query);
}

// get all current orders for the day
function getCurrentOrdersThisDay()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE DAY(Created_At) = DAY(CURDATE())";
    return mysqli_query($con, $query);
}

// get order history which is status is not equal to 0
function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status!='0'";
    return mysqli_query($con, $query);
}

//Check the tracking no. validation for orders
function checkTrackingNoValid($tracking_no)
{
    global $con;
    $query = "SELECT * FROM Orders WHERE tracking_no='$tracking_no'";
    return mysqli_query($con, $query);
}
