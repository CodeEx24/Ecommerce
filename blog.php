<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

<section id="collections" class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Blog</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center w-75">Stay informed on e-commerce trends and deals with our blog</h1>
        </div>

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
            <h1 class='fw-bold'>Latest News</h1>
            <hr>
            <?php
            $blog = getAllActive("posts");

            if (mysqli_num_rows($blog) > 0) {
                foreach ($blog as $item) {
            ?>
                    <div class="col-md-3 my-3 ">
                        <a href="blog-view.php?post=<?= $item['Slug'] ?>">
                            <div class="bg-card card h-100">
                                <div class="card-body ">
                                    <img class="w-100" src="uploads/blog/<?= $item['Image'] ?>" alt="">
                                    <h4 class="mt-3 text-white fw-bold"><?= $item['Title'] ?></h4>
                                    <p class="ref-excerpt text-muted"><?= substr($item['Description'], 0, 125) . '...' ?></p>
                                    <a class="text-success" href="blog-view.php?post=<?= $item['Slug'] ?>">Read More &#x000BB;</a>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No Blog Available.";
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
            <form class="d-flex justify-content-center flex-wrap flex-lg-nowrap subscribe-data" method="post">
                <div class="my-2"><input class="border rounded-pill shadow-sm form-control email" type="email" name="email" placeholder="Your Email" /></div>
                <div class="my-2"><button class="btn btn-primary shadow ms-2 subscribe-btn">Subscribe</button></div>
            </form>
        </div>
    </div>
</section>


<?php include('includes/footer.php') ?>