<?php
include('functions/userfunctions.php');
include('includes/header.php');


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
    <section id="collections" class="d-flex align-items-center justify-content-center" style="height: 50vh;">
        <div class="overlay"></div>
        <div class="d-inline">
            <p class="text-center fw-bold text-success mb-2">Products</p>
            <div class="container d-flex justify-content-center">
                <h1 class="text-white fw-bold h1 text-center"><?= $category['Name'] ?></h1>
            </div>
        </div>
    </section>

    <div class="bg-dark py-5">
        <div class="container pt-2">
            <div class="row pt-5">
                <div class="col d-flex justify-content-between py-3">
                    <h1 class="fw-bold float-left"><?= $category['Name'] ?></h1>
                    <input type="text" class="form-control float-right w-25" oninput="change()" id="live_search" autocomplete="off" placeholder="Search ... ">
                    <input type="hidden" id="category_id" value="<?= $category['ID']; ?>">
                </div>

                <hr>
                <div id='searchresult' class="row"></div>
            </div>
        </div>
    </div>

<?php
} else {
    include('includes/404.php');
}
include('includes/trendprod-section.php');
include('includes/footer.php') ?>

<script>
    $(document).ready(function() {
        $("#live_search").on('input', function() {
            var input = $(this).val();
            var category_id = $('#category_id').val();

            $.ajax({
                url: "functions/livesearch.php",
                method: "POST",
                data: {
                    input: input,
                    category_id: category_id
                },

                success: function(data) {
                    $("#searchresult").html(data);
                }
            });
        }).trigger('input');
    });
</script>