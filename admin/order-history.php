<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h2>Orders</h2>
                        <div class="order-button">
                            <a href="orders.php" class="btn btn-danger text-white">Back To Orders</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="">
                    <table id="order-history" class="display table-dark table-striped">
                        <thead>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">User</th>
                                <th class="table-text">Tracking No.</th>
                                <th class="table-text">Price</th>
                                <th class="table-text">Status</th>
                                <th class="table-text">Date</th>
                                <th class="table-text">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrderHistory();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['ID'] ?></td>
                                        <td><?= $item['Name'] ?></td>
                                        <td><?= $item['Tracking_No'] ?></td>
                                        <td>$<?= $item['Total_Price'] ?></td>
                                        <td class="<?= $item['Status'] == 1 ? "text-info" : "text-danger" ?>"><?= $item['Status'] == 1 ? "Completed" : "Cancelled" ?></td>
                                        <td><?= $item['Created_At'] ?></td>
                                        <td class="table-text">
                                            <a href="view-order.php?tracking=<?= $item['Tracking_No']; ?>" class="btn btn-info shadow button-text">View Details</a>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No completed orders yet</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">User</th>
                                <th class="table-text">Tracking No.</th>
                                <th class="table-text">Price</th>
                                <th class="table-text">Status</th>
                                <th class="table-text">Date</th>
                                <th class="table-text">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>

<script>
    $(document).ready(function() {
        $('#order-history').DataTable();
    });
</script>