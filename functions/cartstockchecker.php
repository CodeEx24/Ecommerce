<?php
$user_id = $_SESSION['auth_user']['user_id'];
$items_query = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image, p.selling_price, p.quantity
FROM Carts c, Products p
WHERE c.product_id = p.id AND c.user_id='$user_id' ORDER BY c.id";
$items = mysqli_query($con, $items_query);
$continue = true;
foreach ($items as $item) {
    if ($item['product_qty'] > $item['quantity']) {
        $_SESSION['message'] = $item['name'] . " is out of stock.";
        header('Location: ./cart.php');
        $continue = false;
        die();
    }
}
