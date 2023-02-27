<?php
session_start();
include('config/dbcon.php');

// This function retrieves all records with a "status" of 1 from the specified table
function getAllActive($table)
{
    global $con;
    $active_query = "SELECT * FROM $table WHERE status='1'";
    return mysqli_query($con, $active_query);
}

// This function retrieves all trending products with a "status" of 1 and with a quantity greater than 0
function getAllTrending()
{
    global $con;
    $active_query = "SELECT * FROM Products WHERE trending='1' AND status='1' AND Quantity!='0'";
    return mysqli_query($con, $active_query);
}


// This function retrieves a record from the specified table with the given id and status of 1
function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='1'";
    return mysqli_query($con, $query);
}

// This function retrieves a record from the specified table with the given slug and status of 1
function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='1' LIMIT 1";
    return mysqli_query($con, $query);
}

// This function retrieves all products with the given category id and with a status of 1 and a quantity greater than 0
function getProductByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM Products WHERE categoryid='$category_id' AND status='1' AND Quantity!=0";
    return mysqli_query($con, $query);
}

// This function retrieves up to 6 related products with the same category id, but not the product with the given id, and with a status of 1 and a quantity greater than 0
function getRelatedProduct($category_id, $product_id)
{
    global $con;
    $query = "SELECT * FROM Products WHERE categoryid='$category_id' AND status='1' AND id!='$product_id' AND quantity!=0 LIMIT 6";
    return mysqli_query($con, $query);
}

// This function returns the cart items of the logged in user that have active status
function getCartItemsActiveStatus()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image, p.selling_price 
    FROM Carts c, Products p
    WHERE c.product_id = p.id AND c.user_id='$user_id' AND p.status = 1 ORDER BY c.id DESC";
    return mysqli_query($con, $query);
}

// This function returns the wishlist items of the logged in user that have active status
function getItemsWishlist()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT w.id as wid, w.product_id, p.id as pid, p.name, p.image, p.selling_price, p.quantity as pqty
    FROM Wishlist w, Products p
    WHERE w.product_id = p.id AND w.user_id='$user_id' AND p.status = 1 ORDER BY w.id DESC";
    return mysqli_query($con, $query);
}

// This function returns the cart items of the logged in user regardless of the active status
function getCartItems()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image, p.selling_price 
    FROM Carts c, Products p
    WHERE c.product_id = p.id AND c.user_id='$user_id' ORDER BY c.id DESC";
    return mysqli_query($con, $query);
}

// This function returns the order history of the logged in user
function getOrders()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM Orders WHERE User_ID='$user_id' ORDER BY Created_At DESC;";
    return mysqli_query($con, $query);
}

// This function returns the address details of the logged in user
function getDetails()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM Address WHERE UserID='$user_id';";
    return mysqli_query($con, $query);
}

function getOrderDetails($user_id, $tracking_no)
{
    global $con;
    // The query
    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.quantity as Order_Quantity, p.* FROM orders o, order_items oi, products p WHERE o.user_id='$user_id' AND oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$tracking_no'";

    // Execute the query
    $order_query_run = mysqli_query($con, $order_query);

    // Return the result
    return mysqli_fetch_all($order_query_run, MYSQLI_ASSOC);
}

// function to redirect to a URL with a message
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}

// function to redirect to a URL without a message
function redirectNoMess($url)
{
    header('Location: ' . $url);
    exit();
}

// function to check if the tracking number is valid for the current user
function checkTrackingNoValid($tracking_no)
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM Orders WHERE tracking_no='$tracking_no' AND user_id='$user_id'";
    return mysqli_query($con, $query);
}
