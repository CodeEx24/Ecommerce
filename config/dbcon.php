<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

//Creating database connection
$con = mysqli_connect($host, $username, $password, $database);

//Create database connection
if (!$con) {
    die("Conenction Failed: " . mysqli_connect_error());
}
