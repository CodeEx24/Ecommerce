<?php

session_start();
include('../config/dbcon.php');

if (isset($_SESSION['auth'])) {
    // Check if the `scope` variable has been set
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        // Check which value the `scope` variable holds
        switch ($scope) {
            case 'addWishlist':
                // Get the product id and user id from the request
                $product_id = $_POST['product_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the product is already in the wishlist for the user
                $chk_existing_wishlist = "SELECT * FROM Wishlist WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_wishlist_run = mysqli_query($con, $chk_existing_wishlist);

                // If the product is in the wishlist, return 'existing'
                if (mysqli_num_rows($chk_existing_wishlist_run) > 0) {
                    echo "existing";
                    break;
                } else {
                    // If the product is not in the wishlist, insert it into the Wishlist table
                    $insert_wishlist_query = "INSERT INTO Wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
                    $insert_wishlist_query_run = mysqli_query($con, $insert_wishlist_query);

                    // If the insertion is successful, return 201
                    if ($insert_wishlist_query_run) {
                        echo 201;
                    } else {
                        // If the insertion fails, return 500
                        echo 500;
                    }

                    break;
                }

                // Check if the scope is set to deleteWishlist
            case 'deleteWishlist':
                // Get the wishlist id from the post request
                $wishlist_id = $_POST['wishlist_id'];
                // Get the user id from the current session
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the wishlist id and user id combination exists in the Wishlist table
                $chk_existing_wishlist = "SELECT * FROM Wishlist WHERE id='$wishlist_id' AND user_id='$user_id'";
                $chk_existing_wishlist_run = mysqli_query($con, $chk_existing_wishlist);

                // If the combination exists, proceed to delete
                if (mysqli_num_rows($chk_existing_wishlist_run) > 0) {
                    // Delete the entry from the Wishlist table
                    $delete_query = "DELETE FROM Wishlist WHERE id='$wishlist_id'";
                    $delete_query_run = mysqli_query($con, $delete_query);

                    // If the delete query is successful, return 200
                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        // If the delete query is unsuccessful, return 500
                        echo 500;
                    }
                } else {
                    // If the combination does not exist, return an error message
                    echo 'Something went wrong';
                }
                // End the switch case
                break;

                // If the scope is not set to either addWishlist or deleteWishlist, return 500
            default:
                echo 500;
        }
    }
} else {
    //Else echo 401
    echo 401;
}
