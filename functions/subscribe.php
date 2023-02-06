<?php
session_start();
include('../config/dbcon.php');

//Check if the 'subs' value exists in the POST request
if (isset($_POST['subs'])) {
    //Capture the email from the POST request
    $email = mysqli_real_escape_string($con, $_POST['email']);

    //Check if the email already exists in the Subscribers table
    $chk_existing_email = "SELECT * FROM Subscribers WHERE email='$email'";
    $chk_existing_email_run = mysqli_query($con, $chk_existing_email);

    //If the email already exists, return 200   
    if (mysqli_num_rows($chk_existing_email_run) > 0) {
        echo 200;
    } else {
        //If the email doesn't exist, insert it into the Subscribers table
        $insert_email_query = "INSERT INTO Subscribers (Email) VALUES ('$email')";
        $insert_email_query_run = mysqli_query($con, $insert_email_query);

        //If the email was successfully inserted, return 200, else return 404
        if ($insert_email_query_run) {
            echo 200;
        } else {
            echo 404;
        }
    }
}
