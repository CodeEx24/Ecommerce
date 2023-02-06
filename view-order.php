<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

// Check if tracking number of an order is existing
if (isset($_GET['tracking'])) {
    // Getting the value of tracking coming from URL
    $tracking_no = $_GET['tracking'];
    $orderData = checkTrackingNoValid($tracking_no);

    // If there are no data in order data it will display the message that tracking number is not existing
    if (mysqli_num_rows($orderData) == 0) {
?>
        <h4 class="bg-dark text-center pt-5" style="margin: 0;">It seems that you don't have existing orders for the tracking number</h4>
    <?php
        // Throw and error page
        include('includes/404.php');
        die();
    }
} else {
    ?>
    <h4 class="bg-dark text-center pt-5" style="margin: 0;">Tracking number is missing in parameter of url</h4>
<?php
    include('includes/404.php');
    die();
}
$data = mysqli_fetch_array($orderData);
?>

<section class="">
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-12 p-5 bg-dark" style="border-radius: 14px;">

                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="fw-bold">View Order</h3>
                    <div class="order-button">
                        <a href="my-orders.php" class="btn btn-primary "><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>

                <hr class="mt-4">
                <div class="row mt-4">

                    <div class="col-md-6">
                        <h5>Delivery Details</h5>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Name</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Name']; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Email</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Email']; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Phone</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Phone']; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Tracking No.</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Tracking_No']; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Address</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Address']; ?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fw-bold">Pin Code</label>
                                <div class="border p-2 form-control" style="border-radius: 5px;">
                                    <?= $data['Pincode']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-details">
                        <h5>Order Details</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                // Get the user_id from the session
                                $user_id = $_SESSION['auth_user']['user_id'];
                                // Call the function
                                $order_items = getOrderDetails($con, $user_id, $tracking_no);

                                // Check if the result is not empty
                                if (!empty($order_items)) {
                                    foreach ($order_items as $item) {
                                ?>
                                        <tr>
                                            <td class="">
                                                <img src="uploads/<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" width="80px" height="80px">
                                                <span style="margin-left: 20px; "> <?= $item['Name'] ?></span>
                                            </td>
                                            <td class="align-middle"><?= $item['Price'] ?></td>
                                            <td class="align-middle"><?= $item['Order_Quantity'] ?></td>

                                        </tr>
                                <?php
                                    }
                                }

                                ?>
                            </tbody>
                        </table>

                        <div class="p-1 fw-bold">
                            Payment Mode:
                            <span class="float-end"> <?= $data['Payment_Mode'] ?></span>
                        </div>
                        <div class="p-1  fw-bold">
                            Status:
                            <span class="float-end"> <?= $data['Status'] ? ($data['Status'] == 1 ? "Completed" : "Cancelled") : "Under Process" ?></span>
                        </div>
                        <hr>
                        <div class="p-1 mb-3">
                            <h5 class="fw-bold">Total Price: <span class="float-end">$<?= $data['Total_Price'] ?></span></h5>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>