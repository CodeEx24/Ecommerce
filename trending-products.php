<?php
include('functions/userfunctions.php');
include('includes/header.php');

?>
<section id="collections" class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Trending Products</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center">Checkout our latest trending products</h1>
        </div>
    </div>
</section>

<div class="bg-dark">

    <div class="container pt-2">
        <div class="row pt-5">
            <h1 class="fw-bold">Trending Products</h1>
            <hr>
            <?php
            $products = getAllTrending();

            if (mysqli_num_rows($products) > 0) {
                foreach ($products as $item) {
            ?>
                    <div class="col-lg-4 col-md-6 col-sm-12  my-3 mb-4">
                        <div class="card bg-card h-100">
                            <div class="card-body d-flex flex-column">
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

<section class="py-5">
    <div class="container">
        <div class="bg-dark border rounded border-dark d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
            <div class="text-center text-lg-start py-3 py-lg-1">
                <h2 class="fw-bold mb-2">Subscribe to our newsletter</h2>
                <p class="mb-0">Imperdiet consectetur dolor.</p>
            </div>
            <form class="d-flex justify-content-center flex-wrap flex-lg-nowrap subscribe-data" method="post">
                <div class="my-2"><input class="border rounded-pill shadow-sm form-control email" type="email" name="email" placeholder="Your Email" /></div>
                <div class="my-2"><button class="btn btn-primary shadow ms-2 subscribe-btn">Subscribe</button></div>
            </form>
        </div>
    </div>
</section>
<?php

include('includes/footer.php') ?>