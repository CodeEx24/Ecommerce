<?php
// Get the user ID from the session
$user_id = $_SESSION['auth_user']['user_id'];

// Create a query to retrieve the cart items for the user
$items_query = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image, p.selling_price, p.quantity
FROM Carts c, Products p
WHERE c.product_id = p.id AND c.user_id='$user_id' ORDER BY c.id";

// Execute the query
$items = mysqli_query($con, $items_query);

// Variable to determine if the user can continue with checkout
$continue = true;

// Loop through the items in the cart
foreach ($items as $item) {
    // If the quantity in the cart is greater than the available quantity of the product
    if ($item['product_qty'] > $item['quantity']) {
        // Set a session message indicating that the product is out of stock
        $_SESSION['message'] = $item['name'] . " is out of stock.";

        // Redirect the user to the cart page
        header('Location: ./cart.php');

        // Set the continue variable to false
        $continue = false;

        // Stop the script execution
        die();
    }
}
