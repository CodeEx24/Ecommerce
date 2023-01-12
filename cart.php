<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

<section class="bg-dark">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Shopping Cart</h1>
                <div class="row mt-4">
                    <div class="col-md-2 text-center cart-text-sm">PRODUCT</div>
                    <div class="col-md-4 text-center cart-text-sm">NAME</div>
                    <div class="col-md-2 text-center cart-text-sm">PRICE</div>
                    <div class="col-md-2 text-center cart-text-sm">QUANTITY</div>
                    <div class="col-md-2 text-end cart-text-sm ">TOTAL</div>
                </div>
                <hr>
                <?php
                $items = getCartItems();
                $total = 0;
                foreach ($items as $item) {
                    $subtotal = $item['selling_price'] * $item['product_qty'];
                    $total += $subtotal;
                ?>
                    <div class="row align-items-center py-3">
                        <div class="col-md-2 text-center">
                            <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="object-fit: fill; width: 120px; height: 120px;">
                        </div>
                        <div class="col-md-4 text-center">
                            <strong><?= $item['name'] ?></strong>
                        </div>
                        <div class="col-md-2 text-center">
                            $<?= $item['selling_price'] ?>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="input-group mt-3">
                                <button class="input-group-text bg-dark text-white decrement-btn">-</button>
                                <input type="number" class="form-control bg-dark text-white text-center input-quantity" value="<?= $item['product_qty'] ?>" disabled>
                                <button class="input-group-text text-white bg-dark increment-btn">+</button>

                            </div>
                            <a href="#" class="text-danger cart-text-sm">REMOVE</a>
                        </div>
                        <div class="col-md-2 text-end">
                            <strong>$<?= $subtotal ?></strong>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="https://google.com" target="_blank">Terms &amp; Conditions</a>
                        <a href="https://google.com" target="_blank">Privacy Policy</a>
                        <a href="https://google.com" target="_blank">Refund Policy</a>
                    </div>
                    <div class="ref-totals">
                        <div class="ref-subtotal">
                            <h5><strong>SubTotal: $<?= $total ?></strong></h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <h3></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>