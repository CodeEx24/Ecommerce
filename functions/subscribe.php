<?php
session_start();
include('../config/dbcon.php');

if (isset($_POST['subs'])) {
    $email = $_POST['email'];

    $chk_existing_email = "SELECT * FROM Subscribers WHERE email='$email'";
    $chk_existing_email_run = mysqli_query($con, $chk_existing_email);

    if (mysqli_num_rows($chk_existing_email_run) > 0) {
        echo 200;
    } else {
        $insert_email_query = "INSERT INTO Subscribers (Email) VALUES ('$email')";
        $insert_email_query_run = mysqli_query($con, $insert_email_query);
        if ($insert_email_query_run) {
            echo 200;
        } else {
            echo 404;
        }
    }
}
