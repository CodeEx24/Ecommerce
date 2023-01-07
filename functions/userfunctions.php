<?php
session_start();
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $active_query = "SELECT * FROM $table WHERE status='1'";
    return $active_query_run = mysqli_query($con, $active_query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
