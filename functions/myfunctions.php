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
