<?php

session_start();
include('../config/dbcon.php');
include('myfunctions.php');

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);



    $check_email_query = "SELECT Email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect('../register.php', "Email already registered");
    } else if ($name == null || $phone == null || $email == null || $password == null) {
        redirect('../register.php', "Please fill up all the blanks in the form.");
    } else if ($password == $cpassword) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$hashed_password')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if ($insert_query_run) {
            redirect('../login.php', "Registered successfully");
        } else {
            redirect('../register.php', "Something went wrong!");
        }
    } else {
        redirect('../register.php', "Your password do not match!");
    }
} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if ($email == '' || $password == '') {
        redirect('../login.php', "Fill up all requirement fields");
    }

    $login_query = "SELECT * FROM Users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {

        // Fetch the hashed password from the database
        $userdata = mysqli_fetch_array($login_query_run);
        $hashed_password = $userdata['Password'];

        // Compare the hashed password to the password entered by the user
        if (password_verify($password, $hashed_password)) {
            $_SESSION['auth'] = true;

            //Fetching the data for the backend
            $userid = $userdata['ID'];
            $username = $userdata['Name'];
            $useremail = $userdata['Email'];
            $role_as = $userdata['Role_As'];

            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail
            ];

            $_SESSION['role_as'] = $role_as;

            if ($role_as == 1) {
                redirect('../admin/index.php', "Welcome to Dashboard");
            } else {
                redirect('../index.php', "Logged In Successfully.");
            }
        } else {
            redirect('../login.php', "Incorrect email or password");
        }
    } else {
        redirect('../login.php', "Incorrect email or password");
    }
}
