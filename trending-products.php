<?php
include('functions/userfunctions.php');
include('includes/header.php');

?>
<section id="collections" class="d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Trending Products</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center">Checkout our latest trending products</h1>
        </div>
    </div>
</section>

<div class="bg-dark py-5">
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col d-flex justify-content-between py-3">
                <h1 class="fw-bold float-left">Trending Products</h1>
                <input type="text" class="form-control float-right w-25" oninput="change()" id="live_search" autocomplete="off" placeholder="Search ... ">
            </div>
            <hr>
            <div id='searchresult' class="row"></div>
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

<script>
    $(document).ready(function() {
        $("#live_search").on('input', function() {
            var input = $(this).val();

            $.ajax({
                url: "functions/livesearch.php",
                method: "POST",
                data: {
                    trending_input: input,
                },

                success: function(data) {
                    $("#searchresult").html(data);
                }
            });
        }).trigger('input');
    });
</script>