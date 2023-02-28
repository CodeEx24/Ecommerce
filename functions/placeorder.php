<?php

session_start();
include('../config/dbcon.php');

// Check if the user has already logged in
if (isset($_SESSION['auth'])) {
    // Check if the form to place an order is submitted
    if (isset($_POST['placeOrderBtn'])) {
        // Create the address string from the form data
        $address =  $_POST['province'] . ", " . $_POST['bldg_houseno'] . ", " . $_POST['street'] . " Street, " . $_POST['city'] . " City, Barangay " . $_POST['barangay'];

        // Escape user input to prevent SQL injection
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        // $payment_id = null;
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        $address = mysqli_real_escape_string($con, $address);

        // Validate if all form fields are filled out
        if ($name == "" || $email == "" || $phone == "" || $pincode == "" || $_POST['bldg_houseno'] == "" || $_POST['street'] == "" || $_POST['city'] == "" || $_POST['province'] == "" || $_POST['barangay'] == "") {
            $_SESSION['message'] = "All fields are required.";
            header('Location: ../checkout.php');
            exit(0);
        }

        // Get the items in the cart of the user
        $user_id = $_SESSION['auth_user']['user_id'];
        $items_query = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image, p.selling_price 
        FROM Carts c, Products p
        WHERE c.product_id = p.id AND c.user_id='$user_id' ORDER BY c.id";
        $items = mysqli_query($con, $items_query);

        // Calculate the total price of the cart
        $total = 0;
        foreach ($items as $item) {
            $total += $item['selling_price'] * $item['product_qty'];
        }

        $total =  $total + ($total * 0.08);

        // Generate a tracking number
        $tracking_no = "TrackNo" . rand(1111, 9999) . substr($phone, 2);

        // Insert the order into the database
        $insert_order_query = "INSERT INTO orders (Tracking_No, User_ID, Name, Email, Phone, Address, Pincode, Total_Price, Payment_Mode, Payment_ID)
        VALUES ('$tracking_no', '$user_id', '$name', '$email', '$phone', '$address', '$pincode', '$total', '$payment_mode', '$payment_id');";
        $insert_order_query_run = mysqli_query($con, $insert_order_query);

        //Check if the order query run successfully
        if ($insert_order_query_run) {
            $order_id = mysqli_insert_id($con); // Give the latest inserted ID in db

            //For each items in the order will generate a order_items in the database
            foreach ($items as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['product_qty'];
                $price = $item['selling_price'];

                //Inserting orders_item query
                $insert_items_query = "INSERT INTO Order_Items (Order_ID, Product_ID, Quantity, Price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                $insert_items_query_run = mysqli_query($con, $insert_items_query);

                //Selecting the product items
                $product_query =  "SELECT * FROM Products WHERE id='$product_id'";
                $product_query_run = mysqli_query($con, $product_query);

                //Get the product data quantity
                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['Quantity'];

                //Minus the current_qty to the quantity that the users buy.
                $new_qty = $current_qty - $quantity;

                //Update the new quantity of the products
                $update_qty_query = "UPDATE Products SET Quantity='$new_qty' WHERE id='$product_id'";
                $update_qty_query_run = mysqli_query($con, $update_qty_query);
            }

            //Deleting the carts of a user
            $deleteCart_query = "DELETE FROM Carts WHERE user_id='$user_id';";
            $deleteCart_query_run = mysqli_query($con, $deleteCart_query);

            //Default payment is COD
            if ($payment_mode == "COD") {
                $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my-orders.php');
                die();
            } else if ($payment_mode == "PayPal") {
                //Paypal payments if the user decided to pay using Paypal
                echo 201;
            }
        }
    }
} else {
    header('Location: ../index.php');
}
