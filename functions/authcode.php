<?php

// Start a session
session_start();

// Include the database connection file and custom functions file
include('../config/dbcon.php');
include('myfunctions.php');

// Check if the "register_btn" is clicked
if (isset($_POST['register_btn'])) {
    // Get and escape the form values
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Check if the email is already registered
    $check_email_query = "SELECT Email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    // If the email is already registered, redirect with an error message
    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect('../register.php', "Email already registered");
    }
    // If any of the form values is empty, redirect with an error message
    else if ($name == null || $phone == null || $email == null || $password == null) {
        redirect('../register.php', "Please fill up all the blanks in the form.");
    }
    // If the passwords match, continue with the registration process
    else if ($password == $cpassword) {
        // Hash the password using the password_hash function
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user data into the database
        $insert_query = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$hashed_password')";
        $insert_query_run = mysqli_query($con, $insert_query);

        // If the query is successful, redirect with a success message
        if ($insert_query_run) {
            redirect('../login.php', "Registered successfully");
        }
        // If the query is unsuccessful, redirect with an error message
        else {
            redirect('../register.php', "Something went wrong!");
        }
    }
    // If the passwords do not match, redirect with an error message
    else {
        redirect('../register.php', "Your password do not match!");
    }
    // Check if the login_btn is posted
} else if (isset($_POST['login_btn'])) {
    // Escape the email and password to prevent SQL Injection
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the email and password are empty
    if ($email == '' || $password == '') {
        redirect('../login.php', "Fill up all requirement fields");
    }

    // Select the data from the database with the matching email
    $login_query = "SELECT * FROM Users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    // If the number of rows returned is greater than 0
    if (mysqli_num_rows($login_query_run) > 0) {
        // Fetch the data for the user
        $userdata = mysqli_fetch_array($login_query_run);
        // Get the hashed password from the database
        $hashed_password = $userdata['Password'];

        // Verify if the entered password matches the hashed password in the database
        if (password_verify($password, $hashed_password)) {
            // Set the authentication status to true
            $_SESSION['auth'] = true;

            // Fetch the user data for the backend
            $userid = $userdata['ID'];
            $username = $userdata['Name'];
            $useremail = $userdata['Email'];
            $role_as = $userdata['Role_As'];

            // Store the user data in the session
            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail
            ];

            // Store the user's role in the session
            $_SESSION['role_as'] = $role_as;

            // Redirect to the admin dashboard if the role is 1
            if ($role_as == 1) {
                redirect('../admin/index.php', "Welcome to Dashboard");
            } else {
                // Redirect to the user index page if the role is not 1
                redirect('../index.php', "Logged In Successfully.");
            }
        } else {
            // If the entered password does not match the hashed password
            redirect('../login.php', "Incorrect email or password");
        }
    } else {
        // If the email is not found in the database
        redirect('../login.php', "Incorrect email or password");
    }
}
