<?php

session_start();
include('../config/dbcon.php');

// Check if the user is authenticated
if (isset($_SESSION['auth'])) {
    // Check if the form with the update button was submitted
    if (isset($_POST['updateDetailsBtn'])) {
        // Escape special characters in the form data to prevent SQL injection 
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $province = mysqli_real_escape_string($con, $_POST['province']);
        $street = mysqli_real_escape_string($con, $_POST['street']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
        $bldg_houseno = mysqli_real_escape_string($con, $_POST['bldg_houseno']);

        // Check if there is already an address in the database for this user
        $chk_existing_query = "SELECT * FROM Address Where UserID=$user_id";
        $chk_existing_query_run = mysqli_query($con, $chk_existing_query);

        // If there is an existing address, delete it
        if (mysqli_num_rows($chk_existing_query_run) > 0) {
            $delete_query = "DELETE FROM Address Where UserID=$user_id";
            $delete_query_run = mysqli_query($con, $delete_query);
        }

        // Insert the updated address into the database
        $insert_address_query = "INSERT INTO Address (Name, Phone, Email, Province, Street, City, Pincode, Barangay, Bldg_houseno, UserID)
        VALUES ('$name', '$phone', '$email', '$province', '$street', '$city', '$pincode', '$barangay', '$bldg_houseno', '$user_id');";
        $insert_address_query_run = mysqli_query($con, $insert_address_query);

        // Check if the query was successful and return the appropriate response code
        if ($insert_address_query_run) {
            echo 200;
        } else {
            echo 500;
        }
    }
} else {
    // If the user is not authenticated, redirect to the home page
    header('Location: ../index.php');
}
