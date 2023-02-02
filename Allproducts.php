<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>
<section id="collections" class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="d-inline">
        <p class="text-center fw-bold text-success mb-2">Products</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center">DUMMY NAME</h1>
        </div>
    </div>
</section>

<div class="bg-dark py-5">
    <div class="container pt-2">
        <div class="row pt-5">

            <h2>PHP MySQL Live Search</h2>
            <input type="text" class="form-control" oninput="change()" id="live_search" autocomplete="off" placeholder="Search ... ">
            <div id='searchresult'></div>
        </div>
    </div>
</div>

<?php
include('includes/trendprod-section.php');
include('includes/footer.php') ?>

<script>
    $(document).ready(function() {
        $("#live_search").on('input', function() {
            var input = $(this).val();
            $.ajax({
                url: "functions/livesearch.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#searchresult").html(data);
                }
            })

        });
    })
</script>