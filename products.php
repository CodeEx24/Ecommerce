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
    // Wait for the document to be ready before running any code
    $(document).ready(function() {

        // Listen for input changes in the element with id "live_search"
        $("#live_search").on('input', function() {

            // Store the current input value in a variable
            var input = $(this).val();

            // Get the value of the element with id "category_id"
            var category_id = $('#category_id').val();

            // Make an AJAX request to the server-side script "livesearch.php"
            $.ajax({
                url: "functions/livesearch.php", // URL of the script
                method: "POST", // Request method
                data: {
                    input: input, // Send the input value as data
                    category_id: category_id // Send the category id as data
                },

                // If the request is successful, replace the content of the element with id "searchresult" with the returned data
                success: function(data) {
                    $("#searchresult").html(data);
                }
            });
        }).trigger('input'); // Trigger the input event immediately on page load
    });
</script>