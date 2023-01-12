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
                    echo "wew";
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
            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
