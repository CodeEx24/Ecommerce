<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

<section id="blog" class="d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="d-inline blog-main-div">
        <p class="text-center fw-bold text-success mb-2">Blog</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center w-75">Stay informed on e-commerce trends and deals with our blog</h1>
        </div>
    </div>
</section>

<header class="bg-dark py-5">
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
                    <div class="col-md-3 my-3">
                        <a href="blog-view.php?post=<?= $item['Slug'] ?>">
                            <div class="bg-card card h-100" style="position: relative;">
                                <div class="card-body">
                                    <img src="uploads/blog/<?= $item['Image'] ?>" width="100%" height="250px" style="object-fit: cover">
                                    <h6 class="mt-3 text-white fw-bold"><?= $item['Title'] ?></h6>
                                    <p class="ref-excerpt text-muted mb-4"><?= substr($item['Meta_Description'], 0, 130) . '...' ?></p>
                                </div>
                                <a class="text-success" style="font-size: 16px !important; position: absolute; bottom: 10px; left: 16px;" href="blog-view.php?post=<?= $item['Slug'] ?>">Read More &#x000BB;</a>
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



<?php
include('includes/subscribe-section.php');
include('includes/footer.php')
?>