<?php
include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['post'])) {
    $post_slug = $_GET['post'];
    $post_data = getSlugActive("posts", $post_slug); //Calling Function to get active post
    $post = mysqli_fetch_array($post_data); //Fetching Data
    $category_id = $post['CategoryID'];

    if ($post) {
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

        <div class="bg-dark">
            <div class="container product-data">
                <div class="row ">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 my-5 mx-1 ">
                        <h1 class="fw-bold"><?= $post['Title'] ?></h1>
                        <img style="object-fit: cover; height: 50vh; width: 100%;" src="uploads/blog/<?= $post['Image'] ?>" alt="">
                        <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
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
    } else {
        include('includes/404.php');
    }
} else {
    include('includes/404.php');
}

include('includes/footer.php');
