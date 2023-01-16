<?php
session_start();
include('includes/header.php')
?>

<header class="bg-dark">
    <?php if (isset($_SESSION['message'])) { ?>

        <h2 class="text-danger text-center"><?= $_SESSION['message']; ?></h2>
    <?php
        unset($_SESSION['message']);
    } ?>
    <div class="container pt-4 pt-xl-5">
        <div class="row pt-5">
            <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                <div class="text-center">
                    <p class="fw-bold text-success mb-2">
                        Rated As #1 Quality Product
                    </p>
                    <h1 class="fw-bold">
                        The best solution for you and your customers
                    </h1>
                </div>
            </div>
            <div class="col-12 col-lg-10 mx-auto">
                <div class="position-relative" style="display: flex; flex-wrap: wrap; justify-content: flex-end">
                    <div style="
                  position: relative;
                  flex: 0 0 45%;
                  transform: translate3d(-15%, 35%, 0);
                ">
                        <img class="img-fluid" data-bss-parallax="" data-bss-parallax-speed="0.8" src="assets/img/products/3.jpg" style="transform: translate3d(0px, 0px, 0px);">
                    </div>
                    <div style="
                  position: relative;
                  flex: 0 0 45%;
                  transform: translate3d(-5%, 20%, 0);
                ">
                        <img class="img-fluid" data-bss-parallax="" data-bss-parallax-speed="0.4" src="assets/img/products/2.jpg" style="transform: translate3d(0px, 0px, 0px);">
                    </div>
                    <div style="
                  position: relative;
                  flex: 0 0 60%;
                  transform: translate3d(0, 0%, 0);
                ">
                        <img class="img-fluid" data-bss-parallax="" data-bss-parallax-speed="0.25" src="assets/img/products/1.jpg" style="transform: translate3d(0px, 0px, 0px);">
                    </div>
                </div>
            </div>
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


<?php

include('includes/footer.php')
?>