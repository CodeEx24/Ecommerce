<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

$orders = getOrders();

if (mysqli_num_rows($orders) == 0) {
?>
    <h4 class="bg-dark text-center pt-5 fw-bold" style="margin: 0;">You don't have orders yet</h4>
<?php
    include('includes/404.php');
    die();
}
?>
<section id="orders" class="d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="d-inline blog-main-div">
        <p class="text-center fw-bold text-success mb-2">Orders</p>
        <div class="container d-flex justify-content-center">
            <h1 class="text-white fw-bold h1 text-center w-75">Check your transactions in this page
        </div>
</section>


<section class="bg-dark">
    <div class="container py-5">
        <h1 class="my-4 fw-bold">Order Details</h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="h4 fw-bold">ID</th>
                            <th class="h4 fw-bold">Tracking No.</th>
                            <th class="h4 fw-bold">Price</th>
                            <th class="h4 fw-bold">Date</th>
                            <th class="h4 fw-bold">Status</th>
                            <th class="h4 fw-bold">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($orders) > 0) {
                            foreach ($orders as $item) {
                        ?>
                                <tr>
                                    <td class="fw-bold"><?= $item['ID'] ?></td>
                                    <td class="fw-bold"><?= $item['Tracking_No'] ?></td>
                                    <td>₱ <?= number_format($item['Total_Price'], 2, '.', ',') ?></td>
                                    <td><?= $item['Created_At'] ?></td>
                                    <td><?= $item['Status'] ? ($item['Status'] == 1 ? "Completed" : "Cancel") : "Under Process" ?></td>
                                    <td>
                                        <div class="order-button">
                                            <a href="view-order.php?tracking=<?= $item['Tracking_No']; ?>" class="btn btn-sm btn-primary text-white">View Details</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5">No orders yet</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
include('includes/trendprod-section.php');
include('includes/footer.php')
?>