<?php
// Start a new session or resume the existing one
session_start();

// Include the database connection configuration file
include('../config/dbcon.php');

// Check if the "auth" key exists in the session
if (isset($_SESSION['auth'])) {
    // Check if the "scope" key exists in the POST request
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case 'add': //Adding products to the cart
                // Get the product id, quantity, and user id from the POST request and the session
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the product already exists in the cart for this user
                $chk_existing_cart = "SELECT * FROM Carts WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                // If the product already exists in the cart for this user
                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    echo "existing";
                    break;
                } else {
                    // Insert the new product into the cart
                    $insert_cart_query = "INSERT INTO Carts (user_id, product_id, product_qty) VALUES ('$user_id', '$product_id', '$quantity')";
                    $insert_cart_query_run = mysqli_query($con, $insert_cart_query);

                    // Check if the insert operation was successful
                    if ($insert_cart_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                    break;
                }
            case 'update': // Updating products to the cart
                // Get the product id, quantity, and user id from the POST request and the session
                $product_id = $_POST['product_id'];
                $product_qty = $_POST['quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the product already exists in the cart for this user
                $chk_existing_cart = "SELECT * FROM Carts WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                // If the product already exists in the cart for this user
                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    // Update the quantity for the product in the cart
                    $update_query = "UPDATE Carts SET product_qty='$product_qty' WHERE product_id='$product_id' AND user_id='$user_id'";
                    $update_query_run = mysqli_query($con, $update_query);

                    // Check if the update operation was successful
                    if ($update_query_run) {
                        echo 200;
                    } else {
                        //If not throw an echo 500
                        echo 500;
                    }
                } else {
                    //If it not exist in the cart throw a "Something went wrong"
                    echo 'Something went wrong';
                }
                break;
            case 'delete':
                // Get the cart id from the posted data
                $cart_id = $_POST['cart_id'];

                // Get the user id from the session
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the cart exists for the current user
                $chk_existing_cart = "SELECT * FROM Carts WHERE id='$cart_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                // If the cart exists for the current user
                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    // Delete the cart
                    $delete_query = "DELETE FROM Carts WHERE id='$cart_id'";
                    $delete_query_run = mysqli_query($con, $delete_query);

                    // Check if the deletion was successful
                    if ($delete_query_run) {
                        // Return 200 if successful
                        echo 200;
                    } else {
                        // Return error message if something went wrong
                        echo 'Something went wrong';
                    }
                } else {
                    // Return error message if the cart does not exist for the current user
                    echo 'Something went wrong';
                }
                break;
            case 'addWishlist':
                // Get the product ID and quantity from the POST request
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                // Get the user ID from the session
                $user_id = $_SESSION['auth_user']['user_id'];

                // Check if the product already exists in the Carts table for this user
                $chk_existing_cart = "SELECT * FROM Carts WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                // If the product already exists in the Carts table, delete it from the Wishlist table
                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    $delete_wishlist_query = "DELETE FROM Wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
                    $delete_wishlist_query_run = mysqli_query($con, $delete_wishlist_query);
                    // Return the "existing" message
                    echo "existing";
                    break;
                } else {
                    // If the product does not exist in the Carts table, delete it from the Wishlist table
                    $delete_wishlist_query = "DELETE FROM Wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
                    $delete_wishlist_query_run = mysqli_query($con, $delete_wishlist_query);

                    // Insert the product into the Carts table
                    $insert_cart_query = "INSERT INTO Carts (user_id, product_id, product_qty) VALUES ('$user_id', '$product_id', '$quantity')";
                    $insert_cart_query_run = mysqli_query($con, $insert_cart_query);

                    // If both queries are successful, return 201
                    if ($insert_cart_query_run && $delete_wishlist_query_run) {
                        echo 201;
                    } else {
                        // Return 500 for any other case
                        echo 500;
                    }

                    break;
                }
            default:
                // Return 500 for any other case
                echo 500;
        }
    }
} else {
    // Else echo 401
    echo 401;
}
