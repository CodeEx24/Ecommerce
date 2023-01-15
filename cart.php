<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php')
?>

<section class="bg-dark">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="mycart">
                    <?php
                    $items = getCartItems();
                    if (mysqli_num_rows($items) > 0) {
                    ?>
                        <h1>Shopping Cart</h1>
                        <div class="row mt-4">
                            <div class="col-md-2 text-center cart-text-sm">PRODUCT</div>
                            <div class="col-md-4 text-center cart-text-sm">NAME</div>
                            <div class="col-md-2 text-center cart-text-sm">PRICE</div>
                            <div class="col-md-2 text-center cart-text-sm">QUANTITY</div>
                            <div class="col-md-2 text-end cart-text-sm ">TOTAL</div>
                        </div>
                        <hr>
                        <div>

                            <?php
                            $total = 0;
                            foreach ($items as $item) {
                                $subtotal = $item['selling_price'] * $item['product_qty'];
                                $total += $subtotal;
                            ?>
                                <div class="row align-items-center py-3 product-data">
                                    <div class="col-md-2 text-center">
                                        <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="object-fit: fill; width: 120px; height: 120px;">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <strong><?= $item['name'] ?></strong>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="hidden" value="<?= $item['selling_price'] ?>" class='productPrice'>
                                        $<?= $item['selling_price'] ?>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="hidden" id="productID" value="<?= $item['product_id'] ?>">
                                        <div class="input-group mt-3">
                                            <button class="input-group-text bg-dark text-white decrement-btn-cart updateQty">-</button>
                                            <input type="number" class="form-control bg-dark text-white text-center input-quantity" value="<?= $item['product_qty'] ?>" disabled>
                                            <button class="input-group-text text-white bg-dark increment-btn-cart updateQty">+</button>

                                        </div>
                                        <button class="btn btn-danger bg-dark text-danger deleteItem" value="<?= $item['cid'] ?>" style=" border: none; font-size: 14px;">REMOVE</button>

                                        <!-- <a href=" #" class="text-danger cart-text-sm deleteItem">REMOVE</a> -->
                                    </div>

                                    <div class="col-md-2 d-flex justify-content-end">
                                        <span>$</span>
                                        <input type="number" class="bg-dark text-white text-end subtotal" style="border: none; padding: 0; width:50%" value="<?= $subtotal ?>" disabled>
                                    </div>
                                </div>
                                <hr>
                            <?php
                            }
                            ?>
                            <div class="d-flex justify-content-between footer">
                                <div>
                                    <a href="https://google.com" target="_blank">Terms &amp; Conditions</a>
                                    <a href="https://google.com" target="_blank">Privacy Policy</a>
                                    <a href="https://google.com" target="_blank">Refund Policy</a>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end totals">
                                    <span>$</span>
                                    <input type="number" class="bg-dark text-white text-end total" style="border: none; padding: 0; width:46%" value="<?= $total ?>" disabled>
                                </div>
                            </div>
                            <div class="float-end mt-3">
                                <a href="checkout.php" class="btn btn-primary placeorder">Proceed to checkout</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center">
                            <h1 class="py-3 fw-bold">Your cart is empty.</h1>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>