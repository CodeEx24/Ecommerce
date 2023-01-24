<?php
include('functions/userfunctions.php');
include('includes/header.php');

?>

<section id="collections" class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Our Collections</p>
        <h1 class="text-white fw-bold h1 text-center">Shop for the best deals in our collection</h1>
    </div>
</section>

<header class="bg-dark">
    <?php if (isset($_SESSION['message'])) { ?>

        <h2 class="text-danger text-center"><?= $_SESSION['message']; ?></h2>
    <?php
        unset($_SESSION['message']);
    } ?>
    <div class="container pt-4 pt-xl-5">
        <div class="row pt-5">
            <h1 class='fw-bold'>Our Collections</h1>
            <hr>
            <?php
            $categories = getAllActive("Categories");

            if (mysqli_num_rows($categories) > 0) {
                foreach ($categories as $item) {
            ?>
                    <div class="col-md-3 my-3 ">
                        <a href="products.php?category=<?= $item['Slug'] ?>">
                            <div class="bg-card card h-100">
                                <div class="card-body ">
                                    <img class="w-100" src="uploads/category/<?= $item['Image'] ?>" alt="">
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


<section class="py-5">
    <div class="container">
        <div class="bg-dark border rounded border-dark d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
            <div class="text-center text-lg-start py-3 py-lg-1">
                <h2 class="fw-bold mb-2">Subscribe to our newsletter</h2>
                <p class="mb-0">Imperdiet consectetur dolor.</p>
            </div>
            <form class="d-flex justify-content-center flex-wrap flex-lg-nowrap" method="post">
                <div class="my-2"><input class="border rounded-pill shadow-sm form-control" type="email" name="email" placeholder="Your Email" /></div>
                <div class="my-2"><button class="btn btn-primary shadow ms-2" type="submit">Subscribe </button></div>
            </form>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>