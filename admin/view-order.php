<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

if (isset($_GET['tracking'])) {
    $tracking_no = $_GET['tracking'];

    $orderData = checkTrackingNoValid($tracking_no);

    if (mysqli_num_rows($orderData) < 0) {
?>
        <h4>Something went wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something went wrong</h4>;

<?php
    die();
}
$data = mysqli_fetch_array($orderData);
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0;">
                    <div class="d-flex justify-content-between">
                        <h2>Orders</h2>
                        <div class="order-button">
                            <a href="orders.php" class="btn btn-danger text-white">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-white">Delivery Details</h5>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Name</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Name']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Email</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Email']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Phone</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Phone']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Tracking No.</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Tracking_No']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Address</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Address']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="fw-bold text-white">Pin Code</label>
                                    <div class="border p-2 form-control" style="border-radius: 5px;">
                                        <?= $data['Pincode']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-details">
                            <h5 class="text-white">Order Details</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td class="fw-bold">Product</td>
                                        <td class="fw-bold">Price</td>
                                        <td class="fw-bold">Quantity</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.quantity as Order_Quantity, p.* FROM orders o, order_items oi, products p WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$tracking_no'";
                                    $order_query_run = mysqli_query($con, $order_query);

                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as $item) {
                                    ?>
                                            <tr>
                                                <td class="">
                                                    <img src="../uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" width="70px" height="70px">
                                                    <span style="margin-left: 20px; "> <?= $item['Name'] ?></span>
                                                </td>
                                                <td class="align-middle">$<?= $item['Selling_Price'] ?></td>
                                                <td class="align-middle"><?= $item['Order_Quantity'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <tr></tr>
                                </tbody>
                            </table>
                            <div>
                                <div class="p-1 fw-bold">
                                    Payment Mode:
                                    <span class="float-end"> <?= $data['Payment_Mode'] ?></span>
                                </div>
                                <div class="p-1 fw-bold">
                                    Total Price:
                                    <span class="float-end">$<?= $data['Total_Price'] ?></span>
                                </div>
                            </div>
                            <hr style="color: white;">
                            <form action="code.php" method="POST">
                                <div class="form-group fw-bold p-1 d-flex justify-content-between">
                                    Status:
                                    <input type="hidden" name="tracking_no" value="<?= $data['Tracking_No'] ?>">
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input-2" type="radio" name="status" id="status-0" value="0" <?= $data['Status'] == 0 ? "checked" : "" ?>>
                                            <label class="form-check-label text-white" for="status-0">Under Process</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input-2" type="radio" name="status" id="status-1" value="1" <?= $data['Status'] == 1 ? "checked" : "" ?>>
                                            <label class="form-check-label text-white" for="status-1">Completed</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input-2" type="radio" name="status" id="status-2" value="2" <?= $data['Status'] == 2 ? "checked" : "" ?>>
                                            <label class="form-check-label text-white" for="status-2">Cancelled</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info float-end" name="update_order_btn">Update Status</button>
                            </form>
                            <br>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>