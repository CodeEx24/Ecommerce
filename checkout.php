<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');
include('functions/cartstockchecker.php');

// Getting the user details
$user_details = getDetails();
$user_details_data = mysqli_fetch_array($user_details);

// Check if the user have a cart items
$cartItems = getCartItems();
if (mysqli_num_rows($cartItems) === 0) {
    header('Location: index.php'); //If no cart items redirect to home page
}
?>

<section class="bg-dark checkout">
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <form action="functions/placeorder.php" method="POST">
                    <div class="row p-3">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Name</h6>
                                    <input class="form-2" name="name" id="name" type="text" placeholder="Enter your full name" value="<?= isset($user_details_data['Name']) ? $user_details_data['Name'] : '' ?>">
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6">
                                    <h6>Email</h6>
                                    <input class="form-2" name="email" id="email" type="email" placeholder="Enter your email" value="<?= isset($user_details_data['Email']) ? $user_details_data['Email'] : $_SESSION['auth_user']['email'] ?>">
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Phone</h6>
                                    <input class="form-2" name="phone" id="phone" type="text" placeholder="Enter your phone number" value="<?= isset($user_details_data['Phone']) ? $user_details_data['Phone'] : '' ?>">
                                    <small class="text-danger phone"></small>
                                </div>
                                <h5 class="mt-4">Address Details</h5>
                                <hr>
                                <div class="col-md-12">
                                    <h6>Provinces</h6>
                                    <select class="form-2" name="province" id="province-select">
                                        <?php
                                        if (isset($user_details_data['Province'])) {
                                        ?>
                                            <option value="<?= $user_details_data['Province'] ?>" selected><?= $user_details_data['Province'] ?></option>
                                        <?php
                                        } else {

                                        ?>
                                            <option value="" disabled selected>Select a province</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <small class="text-danger province"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Street Name</h6>
                                    <input class="form-2" name="street" id="street" type="text" placeholder="Enter the street name" value="<?= isset($user_details_data['Street']) ? $user_details_data['Street'] : '' ?>">
                                    <small class="text-danger street"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>City</h6>
                                    <input class="form-2" name="city" id="city" type="text" placeholder="Enter the city" value="<?= isset($user_details_data['City']) ? $user_details_data['City'] : '' ?>">
                                    <small class="text-danger city"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Pin Code</h6>
                                    <input class="form-2 input-pincode" id="pincode" name="pincode" type="text" placeholder="Enter your pin code" value="<?= isset($user_details_data['Pincode']) ? $user_details_data['Pincode'] : '' ?>">
                                    <small class="text-danger pincode"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Barangay</h6>
                                    <input class="form-2" name="barangay" id="barangay" type="text" placeholder="Enter the barangay" value="<?= isset($user_details_data['Barangay']) ? $user_details_data['Barangay'] : '' ?>">
                                    <small class="text-danger barangay"></small>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h6>Building, House No.</h6>
                                    <textarea class="form-2 mb-2" name="bldg_houseno" id="bldg_houseno" placeholder="Enter the building house number" rows="3"><?= isset($user_details_data['Bldg_houseno']) ? $user_details_data['Bldg_houseno'] : '' ?></textarea>
                                    <small class="text-danger bldg_houseno"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <?php
                            // Getting cart items
                            $items = getCartItems();
                            $total = 0;
                            foreach ($items as $item) {
                                $subtotal = $item['selling_price'] * $item['product_qty'];
                            ?>
                                <div class="row align-items-center py-3 product-data border border-gray m-1 mt-3">
                                    <div class="col-md-2 text-center">
                                        <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="object-fit: fill; width: 60px; height: 60px;">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p><?= $item['name'] ?></p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p>$<?= $item['selling_price'] ?></p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p>x<?= $item['product_qty'] ?></p>
                                    </div>
                                </div>

                            <?php
                                // Calculating the total of all products in the order
                                $total += $item['selling_price'] * $item['product_qty'];
                            }
                            $vat = ($total * 0.08);
                            ?>
                            <div class="px-3 pt-3 text-end">
                                <p class=" text-gray">Includes 8% VAT($<?= $vat ?>)</p>
                            </div>
                            <div class="px-3 pb-3">
                                <h5>Total Price: <strong class="float-end">$<?= $total + $vat ?></strong></h5>
                            </div>

                            <div class="order-button">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary text-white w-100">Confirm and place order | COD</button>

                                <div class="mt-3" id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>




<!-- Provinces option of a user -->
<script>
    // array of all the provinces in the Philippines
    var provinces = ['Abra', 'Agusan del Norte', 'Agusan del Sur', 'Aklan', 'Albay', 'Antique', 'Apayao', 'Aurora', 'Basilan', 'Bataan', 'Batanes', 'Batangas', 'Benguet', 'Biliran', 'Bohol', 'Bukidnon', 'Bulacan', 'Cagayan', 'Camarines Norte', 'Camarines Sur', 'Camiguin', 'Capiz', 'Catanduanes', 'Cavite', 'Cebu', 'Compostela Valley', 'Cotabato', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental', 'Dinagat Islands', 'Eastern Samar', 'Guimaras', 'Ifugao', 'Ilocos Norte', 'Ilocos Sur', 'Iloilo', 'Isabela', 'Kalinga', 'La Union', 'Laguna', 'Lanao del Norte', 'Lanao del Sur', 'Leyte', 'Maguindanao', 'Marinduque', 'Masbate', 'Metro Manila', 'Misamis Occidental', 'Misamis Oriental', 'Mountain Province', 'Negros Occidental', 'Negros Oriental', 'Northern Samar', 'Nueva Ecija', 'Nueva Vizcaya', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Pampanga', 'Pangasinan', 'Quezon', 'Quirino', 'Rizal', 'Romblon', 'Samar', 'Sarangani', 'Siquijor', 'Sorsogon', 'South Cotabato', 'Southern Leyte', 'Sultan Kudarat', 'Sulu', 'Surigao del Norte', 'Surigao del Sur', 'Tarlac', 'Tawi-Tawi', 'Zambales', 'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'];

    // select the HTML element with id "province-select"
    var select = document.getElementById("province-select");

    // loop through the provinces array
    for (var i = 0; i < provinces.length; i++) {
        var opt = provinces[i];
        // create a new HTML "option" element
        var el = document.createElement("option");
        // set the text content and value of the "option" element to the current province
        el.textContent = opt;
        el.value = opt;
        // add the "option" element to the "select" element
        select.appendChild(el);
    }
</script>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=ActZNAmGgUgPbTFaT1BeyxwxTuTgLVk6fOq8sFcOqMMnoc--p7WPGJuwTqXnmh18pYi9JBi-QdPc0pX2&currency=USD"></script>

<!-- Paypal process and rendering the details in the database -->
<script>
    paypal.Buttons({
        onClick() {

            var fields = ['name', 'email', 'phone', 'pincode', 'street', 'city', 'barangay', 'bldg_houseno', 'province-select option:selected'];
            var validation = true;
            fields.forEach(function(field) {
                if (field == 'province-select option:selected' && !$('#' + field).val()) {
                    validation = false;
                    $('.province').text("*This field is required");
                } else if (!$('#' + field).val()) {
                    validation = false;
                    $('.' + field).text("*This field is required");
                } else {
                    $('.' + field).text("");
                }
            });
            if (!validation) {
                return false;
            }
        },
        createOrder: (data, actions) => {

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $total + $vat ?>' // Can also reference a variable or function
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                const transaction = orderData.purchase_units[0].payments.captures[0];
                var fields = ['name', 'email', 'phone', 'pincode', 'street', 'city', 'barangay', 'bldg_houseno', 'province'];
                var province = $("#province-select option:selected").val();
                var data = {
                    'placeOrderBtn': true,
                    'payment_mode': "PayPal",
                    'payment_id': transaction.id,
                };
                fields.forEach(function(field) {
                    if (field == 'province') {
                        data[field] = province;

                    } else {
                        data[field] = $('#' + field).val();
                    }

                });

                $.ajax({
                    type: "POST",
                    url: "functions/placeorder.php",
                    data: data,
                    success: function(response) {
                        if (response == 201) {
                            alertify.success("Order placed successfully.");
                            window.location.href = 'my-orders.php';
                        }
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>