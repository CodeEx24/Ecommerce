<?php
include('functions/userfunctions.php');
include('includes/header.php');

?>

<section id="collections" class="d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Our Collections</p>
        <h1 class="text-white fw-bold h1 text-center">Shop for the best deals in our collection</h1>
    </div>
</section>

<header class="bg-dark py-5">
    <?php if (isset($_SESSION['message'])) { ?>
        <h2 class="text-danger text-center"><?= $_SESSION['message']; ?></h2>
    <?php
        unset($_SESSION['message']);
    } ?>
    <div class="container py-5">
        <div class="row pt-5">
            <h1 class='fw-bold'>Our Collections</h1>
            <hr>
            <?php
            $categories = getAllActive("Categories");
            if (mysqli_num_rows($categories) > 0) {
                foreach ($categories as $item) {
            ?>
                    <div class="col-md-3 my-3">
                        <a href="products.php?category=<?= $item['Slug'] ?>">
                            <div class="bg-card card h-100">
                                <div class="card-img-top" style="background-image: url('uploads/category/<?= $item['Image'] ?>'); background-size: cover; background-position: center; height: 250px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="mt-3 text-center"><?= $item['Name'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No Category Available.";
            }
            ?>
        </div>
    </div>
</header>




<?php
include('includes/trendprod-section.php');
include('includes/footer.php')
?>