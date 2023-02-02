<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

?>

<section class="bg-dark py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="mycart">
                    <?php
                    $items = getCartItemsActiveStatus();
                    if (mysqli_num_rows($items) > 0) {
                    ?>
                        <h1>Shopping Cart</h1>
                        <div class="row mt-4 d-none d-md-flex">
                            <div class="col-md-2 text-center cart-text-sm ">PRODUCT</div>
                            <div class="col-md-3 text-center cart-text-sm ">NAME</div>
                            <div class="col-md-2 text-center cart-text-sm ">PRICE</div>
                            <div class="col-md-3 text-center cart-text-sm ">QUANTITY</div>
                            <div class="col-md-2 text-center text-lg-end cart-text-sm  ">TOTAL</div>
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
                                    <div class="col-lg-2 text-center">
                                        <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="object-fit: fill; width: 120px; height: 120px;">
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <strong><?= $item['name'] ?></strong>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <input type="hidden" value="<?= $item['selling_price'] ?>" class='productPrice'>
                                        $<?= $item['selling_price'] ?>
                                    </div>

                                    <div class="col-lg-3 text-center">
                                        <div class="d-flex justify-content-center">
                                            <div><input type="hidden" id="productID" value="<?= $item['product_id'] ?>"></div>
                                            <div class="input-group mt-3" style="width:200px;">
                                                <button class="input-group-text bg-dark text-white decrement-btn-cart updateQty">-</button>
                                                <input type="number" class="form-control bg-dark text-white text-center text-sm input-quantity" value="<?= $item['product_qty'] ?>" disabled>
                                                <button class="input-group-text text-white bg-dark increment-btn-cart updateQty">+</button>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger bg-dark text-danger deleteItem" value="<?= $item['cid'] ?>" style=" border: none; font-size: 14px;">REMOVE</button>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="d-flex text-center justify-content-center justify-content-md-end">
                                            <span>$</span>
                                            <input type="hidden" class="bg-dark text-white email form-control subtotal" style="border: none; padding: 0;" value="<?= $subtotal ?>" disabled>
                                            <p class="bg-dark text-white subtotal-text" style=""><?= $subtotal ?></p>
                                        </div>
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
                                <div class="col-md-2 d-flex justify-content-end totals align-items-start">
                                    <span>$</span>
                                    <input type="hidden" class="bg-dark text-white text-end total" style="border: none; padding: 0; width:46%" value="<?= $total ?>" disabled>
                                    <p class="bg-dark text-white total-text" style="" id="total"><?= $total ?></p>
                                </div>
                            </div>
                            <div class="float-end mt-3 text-center w-100 w-md-25">
                                <a href="checkout.php" class="btn btn-primary placeorder w-100">Proceed to checkout</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center w-100">
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

<?php include('includes/trendprod-section.php') ?>

<script>
    const decrementBtn = document.querySelector('.decrement-btn-cart');
    const incrementBtn = document.querySelector('.increment-btn-cart');

    decrementBtn.addEventListener('click', function() {
        const input_quantity = document.querySelector('.input-quantity');
        const quantity = input_quantity.value;

        const input_sellingPrice = document.querySelector('.productPrice');
        const sellingPrice = input_sellingPrice.value;
        console.log("SELLING PRICE " + sellingPrice);

        var st2 = document.querySelector('#st2');
        if (quantity > 1) {
            console.log("Quantity - 1: " + (quantity - 1));
            var val = sellingPrice * (quantity - 1);
            console.log("SAD")
            st2.innerHTML = val.toFixed(2);

        }
    });

    incrementBtn.addEventListener('click', function() {
        const input_quantity = document.querySelector('.input-quantity');
        var quantity = Number(input_quantity.value);

        const input_sellingPrice = document.querySelector('.productPrice');
        const sellingPrice = input_sellingPrice.value;
        console.log("SELLING PRICE " + sellingPrice);

        var st2 = document.querySelector('#st2');

        if (quantity < 10) {
            quantity = quantity + 1;
            console.log("Quantity + 1: " + (quantity));
            var val = sellingPrice * (quantity);
            console.log("SAD")
            st2.innerHTML = val.toFixed(2);
        }
    });
</script>


<?php include('includes/footer.php') ?>