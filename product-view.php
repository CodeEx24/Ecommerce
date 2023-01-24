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
                                <div class="">
                                    <button class="btn btn-primary addToCart-btn" value="<?= $product['ID'] ?>">
                                        <i class="fa fa-shopping-cart me-2"></i>
                                        Add to Cart
                                    </button>
                                </div>
                                <div class="mx-3"> <button class="btn btn-danger"><i class="fa fa-heart me-2"></i>Add to Wishlist</button></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-10">
                        <hr>
                        <p><?= $product['Small_Description'] ?></p>
                    </div>
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
