<?php
session_start();
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $active_query = "SELECT * FROM $table WHERE status='1'";
    return $active_query_run = mysqli_query($con, $active_query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='1'";
    return $query_run = mysqli_query($con, $query);
}

function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='1' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getProductByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM Products WHERE categoryid='$category_id' AND status='1'";
    return $query_run = mysqli_query($con, $query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
