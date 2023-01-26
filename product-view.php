<?php
include('functions/userfunctions.php');
include('includes/header.php');


if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("Products", $product_slug); //Calling Function to get active product
    $product = mysqli_fetch_array($product_data); //Fetching Data



    if ($product) {
?>

        <div class="bg-dark">
            <div class="container product-data">
                <div class="row ">
                    <div class="col-md-4 col-sm-12 my-5 mx-1 ">
                        <div class="d-flex flex-column">
                            <img class="ref-image rounded " src="uploads/<?= $product['Image'] ?>" alt="<?= $product['Name'] ?>" loading="lazy" />
                            <p class="<?= $product['Trending']  ? "ref-sale-badge" : "" ?>"><?= $product['Trending'] ? "TRENDING" : "" ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mx-1 my-5">
                        <h4 class="fw-bold"><?= $product['Name'] ?></h4>
                        <hr>
                        <p><?= $product['Description'] ?></p>
                        <div class="d-flex">
                            <div class="orig-price">
                                <h5>$<s><?= $product['Original_Price'] ?></s></h5>
                            </div>
                            <div class="selling-price">
                                <h5 class="fw-bold">$<?= $product['Selling_Price'] ?></h5>
                            </div>
                        </div>
                        <!-- The input field with the spinner -->
                        <div class="row mt-3">
                            <div class="col-md-8 col-lg-5">
                                <div class="input-group mb-3 ">
                                    <button class="input-group-text bg-dark text-white decrement-btn">-</button>
                                    <input type="number" class="form-control bg-dark text-white text-center input-quantity" value="1" disabled>
                                    <button class="input-group-text text-white bg-dark increment-btn">+</button>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="btn-group d-flex m" role="group">
                                <div class=''>
                                    <button class='btn btn-primary <?= $product['Quantity'] ? "addToCart-btn" : "disabled" ?> ' value='<?= $product['ID'] ?>'>
                                        <i class='fa fa-shopping-cart me-2'></i>
                                        Add to Cart
                                    </button>
                                </div>
                                <div class='mx-3'> <button class='btn btn-danger addToWishlist-btn' value='<?= $product['ID'] ?>'><i class='fa fa-heart me-2'></i>Add to Wishlist</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-10 mb-5">
                        <hr>
                        <p><?= $product['Small_Description'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="container pt-2">
                <div class="row pt-5">
                    <h1 class="fw-bold">Related Products</h1>
                    <hr>
                    <?php
                    $related_product = getRelatedProduct($product['CategoryID'], $product['ID']);

                    if (mysqli_num_rows($related_product) > 0) {
                        foreach ($related_product as $item) {
                    ?>
                            <div class="col-lg-4 col-md-6 col-sm-12  my-3 mb-4">
                                <div class="card bg-card h-100">
                                    <div class="card-body bg-dark d-flex flex-column" style="border-radius: 20px;">
                                        <a class="ref-product" href="product-view.php?product=<?= $item['Slug'] ?>">
                                            <img class="ref-image mb-3" src="uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" loading="lazy" />
                                            <p class="<?= $item['Trending']  ? "ref-sale-badge" : "" ?>"><?= $item['Trending'] ? "TRENDING" : "" ?></p>
                                            <div class="ref-product-info d-flex justify-content-between">
                                                <h5 class="ref-name fw-bold"><?= $item['Name'] ?></h5>
                                                <strong class="ref-price ref-on-sale">
                                                    <s class="ref-original-price"><?= $item['Original_Price'] ?> </s>
                                                    <span class="ref-selling-price"> <?= $item['Selling_Price'] ?> </span>
                                                </strong>
                                            </div>
                                            <p class="ref-excerpt"><?= substr($item['Description'], 0, 125) . '...' ?></p>
                                        </a>
                                        <div class="ref-addons mt-auto">
                                            <button class="btn btn-primary addToCart-btn" value="<?= $item['ID'] ?>">
                                                <i class="fa fa-shopping-cart me-2"></i>
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "No Product Available.";
                    }
                    ?>
                </div>
            </div>
        </div>


<?php
    } else {
        include('includes/404.php');
    }
} else {
    include('includes/404.php');
}

include('includes/footer.php');
