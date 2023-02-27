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
                            <a href="order-history.php" class="btn btn-danger text-white">Order History</a>
                        </div>
                    </div>

                </div>
                <div class="card-body" id="">
                    <table id="orders" class="display table-dark table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">User</th>
                                <th class="table-text">Tracking No.</th>
                                <th class="table-text">Price</th>
                                <th class="table-text">Date</th>
                                <th class="table-text">Status</th>
                                <th class="table-text">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getAllOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['ID'] ?></td>
                                        <td><?= $item['Name'] ?></td>
                                        <td><?= $item['Tracking_No'] ?></td>
                                        <td>₱ <?= number_format($item['Total_Price'], 2, '.', ',') ?></td>
                                        <td><?= $item['Created_At'] ?></td>
                                        <td><?= $item['Status'] ? "Cancelled" : "Under Process" ?></td>
                                        <td class="table-text">
                                            <a href="view-order.php?tracking=<?= $item['Tracking_No']; ?>" class="btn btn-info shadow button-text" style="margin-bottom: 0;">View Details</a>
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
                        <tfoot>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">User</th>
                                <th class="table-text">Tracking No.</th>
                                <th class="table-text">Price</th>
                                <th class="table-text">Date</th>
                                <th class="table-text">Status</th>
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
        $('#orders').DataTable();
    });
</script>