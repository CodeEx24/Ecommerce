<?php
include('includes/header.php');
include('functions/userfunctions.php');
?>

<header class="bg-dark">
    <?php if (isset($_SESSION['message'])) { ?>

        <h2 class="text-danger text-center"><?= $_SESSION['message']; ?></h2>
    <?php
        unset($_SESSION['message']);
    } ?>
    <div class="container pt-4 pt-xl-5">
        <div class="row pt-5">
            <h1>Our Collections</h1>
            <hr>
            <?php
            $categories = getAllActive("Categories");

            if (mysqli_num_rows($categories) > 0) {
                foreach ($categories as $item) {
            ?>
                    <div class="col-md-3 my-4 ">
                        <div class="card h-100">
                            <div class="card-body ">
                                <img class="w-100" src="uploads/<?= $item['Image'] ?>" alt="">
                                <h5 class="mt-3 text-center"><?= $item['Name'] ?></h5>
                            </div>
                        </div>
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



<section class="container py-5">

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['message'])) { ?>
                    <p class="text-danger">
                        <?= $_SESSION['message']; ?>
                    </p>
                <?php
                    unset($_SESSION['message']);
                } ?>
            </div>
        </div>
    </div>
</section>

<h1>Hello, world!</h1>
<button class="btn btn-primary">Testing</button>
<?php include('includes/footer.php') ?>