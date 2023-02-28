<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

?>

<section class="bg-dark py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="wishlist">
                    <?php
                    $items = getItemsWishlist();
                    if (mysqli_num_rows($items) > 0) {
                    ?>
                        <h1 class="fw-bold">Shopping Cart</h1>
                        <div class="row mt-4 d-none d-md-flex">
                            <div class="col-md-2 text-center cart-text-sm ">PRODUCT</div>
                            <div class="col-md-3 text-center cart-text-sm ">NAME</div>
                            <div class="col-md-2 text-center cart-text-sm ">PRICE</div>
                            <div class="col-md-5 text-center cart-text-sm ">ACTION</div>
                        </div>

                        <hr>
                        <div>

                            <?php
                            $total = 0;
                            foreach ($items as $item) {

                            ?>
                                <div class="row align-items-center py-3 product-data">
                                    <div class="col-lg-2 text-center">
                                        <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="120px" height="120px" style="object-fit: cover;"">
                                    </div>
                                    <div class=" col-lg-3 text-center">
                                        <strong><?= $item['name'] ?></strong>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <input type="hidden" value="<?= $item['selling_price'] ?>" class='productPrice'>
                                        ₱ <?= number_format($item['selling_price'], 2, '.', ',') ?>
                                    </div>
                                    <div class="col-lg-5 text-center mt-4 mt-md-0">
                                        <button class="btn btn-primary mx-3 <?= $item['pqty'] > 0 ? "addToCartWishlist-btn" : "disabled" ?>" value="<?= $item['pid'] ?>">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            <?= $item['pqty'] > 0 ? "Add to Cart" : "Out of Stock" ?>
                                        </button>
                                        <button class="btn btn-danger deleteItemToWishlist-btn" value="<?= $item['wid'] ?>">
                                            <i class="fa fa-shopping-cart me-2"></i>
                                            Remove
                                        </button>
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

                            </div>

                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center w-100">
                            <h1 class="py-3 fw-bold">Your wishlist is empty.</h1>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('includes/trendprod-section.php');
include('includes/footer.php')
?>