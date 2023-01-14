<?php

session_start();
include('../config/dbcon.php');

if (isset($_SESSION['auth'])) {

    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case 'add':
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * FROM Carts WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    echo "existing";
                    break;
                } else {
                    $insert_cart_query = "INSERT INTO Carts (user_id, product_id, product_qty) VALUES ('$user_id', '$product_id', '$quantity')";
                    $insert_cart_query_run = mysqli_query($con, $insert_cart_query);

                    if ($insert_cart_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }

                    break;
                }
            case 'update':
                $product_id = $_POST['product_id'];
                $product_qty = $_POST['quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * FROM Carts WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    $update_query = "UPDATE Carts SET product_qty='$product_qty' WHERE product_id='$product_id' AND user_id='$user_id'";
                    $update_query_run = mysqli_query($con, $update_query);

                    if ($update_query_run) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo 'Something went wrong';
                }
                break;
            case 'delete':
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * FROM Carts WHERE id='$cart_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    $delete_query = "DELETE FROM Carts WHERE id='$cart_id'";
                    $delete_query_run = mysqli_query($con, $delete_query);

                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        echo 'Something went wrong';
                    }
                } else {
                    echo 'Something went wrong';
                }
                break;

            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
