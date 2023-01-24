<?php
session_start();
include('../config/dbcon.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return mysqli_query($con, $query);
}


function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return mysqli_query($con, $query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status='0'";
    return mysqli_query($con, $query);
}


function getAllCompletedOrders()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status='1'";
    return mysqli_query($con, $query);
}

function getCurrentWeekCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND WEEK(Updated_At) = WEEK(CURDATE())";
    return mysqli_query($con, $query);
}

function getCurrentDayCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND DATE(Updated_At) = CURDATE()";
    return mysqli_query($con, $query);
}

function getCurrentMonthCompletedOrders()
{
    global $con;
    $query = "SELECT SUM(Total_Price) as total_sales FROM Orders WHERE Status='1' AND MONTH(Updated_At) = MONTH(CURDATE()) AND YEAR(Updated_At) = YEAR(CURDATE())";
    return mysqli_query($con, $query);
}

function getUsersAddedThisMonth()
{
    global $con;
    $query = "SELECT * FROM Users WHERE Role_As='0' AND MONTH(Created_At) = MONTH(CURDATE())";
    return mysqli_query($con, $query);
}

function getCurrentOrdersThisDay()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE DAY(Created_At) = DAY(CURDATE())";
    return mysqli_query($con, $query);
}


function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM Orders WHERE Status!='0'";
    return mysqli_query($con, $query);
}
function checkTrackingNoValid($tracking_no)
{
    global $con;

    $query = "SELECT * FROM Orders WHERE tracking_no='$tracking_no'";
    return mysqli_query($con, $query);
}
