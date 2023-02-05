<?php

session_start();
include('../config/dbcon.php');

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $category_id = $_POST['category_id'];

    if ($input != "") {
        $query = "SELECT * FROM Products WHERE CategoryID='$category_id' AND Name LIKE '%{$input}%'";
    } else {
        $query = "SELECT * FROM Products WHERE CategoryID='$category_id'";
    }


    $products = mysqli_query($con, $query);

    if (mysqli_num_rows($products) > 0) {
        foreach ($products as $item) { ?>
            <div class="col-lg-4 my-3 mb-4">
                <div class="card bg-card h-100">
                    <div class="card-body d-flex flex-column">
                        <a class="ref-product" href="product-view.php?product=<?= $item['Slug'] ?>">
                            <img class="ref-image mb-3" src="uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" loading="lazy" />
                            <p class="<?= $item['Trending'] ? "ref-sale-badge" : "" ?>"><?= $item['Trending'] ? "TRENDING" : "" ?></p>
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
        echo "<h6 class='text-danger text-center'>No data found</h6>";
    }
} else if (isset($_POST['trending_input'])) {
    $input = $_POST['trending_input'];


    if ($input != "") {
        $query = "SELECT * FROM Products WHERE Trending=1 AND Name LIKE '%{$input}%'";
    } else {
        $query = "SELECT * FROM Products WHERE Trending=1";
    }


    $products = mysqli_query($con, $query);

    if (mysqli_num_rows($products) > 0) {
        foreach ($products as $item) { ?>
            <div class="col-lg-4 my-3 mb-4">
                <div class="card bg-card h-100">
                    <div class="card-body d-flex flex-column">
                        <a class="ref-product" href="product-view.php?product=<?= $item['Slug'] ?>">
                            <img class="ref-image mb-3" src="uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" loading="lazy" />
                            <p class="<?= $item['Trending'] ? "ref-sale-badge" : "" ?>"><?= $item['Trending'] ? "TRENDING" : "" ?></p>
                            <div class="ref-product-info d-flex justify-content-between">
                                <h5 class="ref-name fw-bold"><?= $item['Name'] ?></h5>
                                <strong class="ref-price ref-on-sale">
                                    <s class="ref-original-price">$<?= $item['Original_Price'] ?> </s>
                                    <span class="ref-selling-price"> $<?= $item['Selling_Price'] ?> </span>
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
    }
}
?>