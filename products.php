<?php
include('includes/header.php');
include('functions/userfunctions.php');

if (isset($_GET['category'])) {

    $category_slug = $_GET['category']; //URL Parameters
    $category_data = getSlugActive("categories", $category_slug); //Calling Function to get active category
    $category = mysqli_fetch_array($category_data); //Fetching Data

    if (!$category) {
        include('includes/404.php');
        exit();
    }
    $category_id = $category['ID']; //
?>

    <div class="bg-dark">
        <?php if (isset($_SESSION['message'])) { ?>

            <h2 class="text-danger text-center"><?= $_SESSION['message']; ?></h2>
        <?php
            unset($_SESSION['message']);
        } ?>
        <div class="container pt-2">
            <div class="row pt-5">
                <h1><?= $category['Name'] ?></h1>
                <hr>
                <?php
                $products = getProductByCategory($category_id);

                if (mysqli_num_rows($products) > 0) {
                    foreach ($products as $item) {
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-12  my-3 mb-4">
                            <a href="#">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <a class="ref-product" href="/product.html?product=43218622">
                                            <img class="ref-image mb-3" src="uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" loading="lazy" />
                                            <p class=" <?= $item['Trending']  ? "ref-sale-badge" : "" ?>"><?= $item['Trending'] ? "TRENDING" : "" ?></p>
                                            <div class="ref-product-info d-flex justify-content-between">
                                                <h5 class="ref-name"><?= $item['Name'] ?></h5>
                                                <strong class="ref-price ref-on-sale">
                                                    <s class="ref-original-price"><?= $item['Original_Price'] ?> </s>
                                                    <span class="ref-selling-price"> <?= $item['Selling_Price'] ?> </span>
                                                </strong>
                                            </div>
                                            <p class="ref-excerpt"><?= substr($item['Description'], 0, 125) . '...' ?></p>
                                        </a>
                                        <div class="ref-addons mt-auto">
                                            <a class=" btn btn-info" href="#">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
include('includes/footer.php') ?>