<?php

session_start();
include('../config/dbcon.php');

if (isset($_SESSION['auth'])) {

    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case 'addWishlist':
                $product_id = $_POST['product_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_wishlist = "SELECT * FROM Wishlist WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_wishlist_run = mysqli_query($con, $chk_existing_wishlist);

                if (mysqli_num_rows($chk_existing_wishlist_run) > 0) {
                    echo "existing";
                    break;
                } else {
                    $insert_wishlist_query = "INSERT INTO Wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
                    $insert_wishlist_query_run = mysqli_query($con, $insert_wishlist_query);

                    if ($insert_wishlist_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }

                    break;
                }
            case 'deleteWishlist':
                $wishlist_id = $_POST['wishlist_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_wishlist = "SELECT * FROM Wishlist WHERE id='$wishlist_id' AND user_id='$user_id'";
                $chk_existing_wishlist_run = mysqli_query($con, $chk_existing_wishlist);

                if (mysqli_num_rows($chk_existing_wishlist_run) > 0) {
                    $delete_query = "DELETE FROM Wishlist WHERE id='$wishlist_id'";
                    $delete_query_run = mysqli_query($con, $delete_query);

                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        echo 500;
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
