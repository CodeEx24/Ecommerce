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

<section class="bg-dark">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tracking No.</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($orders) > 0) {
                            foreach ($orders as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['ID'] ?></td>
                                    <td><?= $item['Tracking_No'] ?></td>
                                    <td>$<?= $item['Total_Price'] ?></td>
                                    <td><?= $item['Created_At'] ?></td>
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

<?php include('includes/footer.php') ?>