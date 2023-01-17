<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

$cartItems = getCartItems();

if (mysqli_num_rows($cartItems) === 0) {
    header('Location: index.php');
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
                                    <input class="form-2" name="name" id="name" type="text" placeholder="Enter your full name" required>
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6">
                                    <h6>Email</h6>
                                    <input class="form-2" name="email" id="email" type="email" value="<?= $_SESSION['auth_user']['email'] ?>" placeholder="Enter your email" required>
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Phone</h6>
                                    <input class="form-2" name="phone" id="phone" type="text" placeholder="Enter your phone number" required>
                                    <small class="text-danger phone"></small>
                                </div>
                                <h5 class="mt-4">Address Details</h5>
                                <hr>
                                <div class="col-md-12">
                                    <h6>Provinces</h6>
                                    <select class="form-2" name="province" id="province-select" required>
                                        <option value="" disabled selected>Select a province</option>
                                    </select>
                                    <small class="text-danger province"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Street Name</h6>
                                    <input class="form-2" name="street" id="street" type="text" placeholder="Enter the street name" required>
                                    <small class="text-danger street"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>City</h6>
                                    <input class="form-2" name="city" id="city" type="text" placeholder="Enter the city" required>
                                    <small class="text-danger city"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Pin Code</h6>
                                    <input class="form-2 input-pincode" id="pincode" name="pincode" type="text" placeholder="Enter your pin code" required>
                                    <small class="text-danger pincode"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Barangay</h6>
                                    <input class="form-2" name="barangay" id="barangay" type="text" placeholder="Enter the barangay" required>
                                    <small class="text-danger barangay"></small>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h6>Building, House No.</h6>
                                    <textarea class="form-2 mb-2" name="bldg_houseno" id="bldg_houseno" placeholder="Enter the building house number" rows="3" required></textarea>
                                    <small class="text-danger bldg_houseno"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <?php
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
                                $total += $item['selling_price'] * $item['product_qty'];
                            }
                            ?>
                            <div class="p-3">
                                <h5>Total Price: <strong class="float-end">$<?= $total ?></strong></h5>
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

<script>
    var provinces = ['Abra', 'Agusan del Norte', 'Agusan del Sur', 'Aklan', 'Albay', 'Antique', 'Apayao', 'Aurora', 'Basilan', 'Bataan', 'Batanes', 'Batangas', 'Benguet', 'Biliran', 'Bohol', 'Bukidnon', 'Bulacan', 'Cagayan', 'Camarines Norte', 'Camarines Sur', 'Camiguin', 'Capiz', 'Catanduanes', 'Cavite', 'Cebu', 'Compostela Valley', 'Cotabato', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental', 'Dinagat Islands', 'Eastern Samar', 'Guimaras', 'Ifugao', 'Ilocos Norte', 'Ilocos Sur', 'Iloilo', 'Isabela', 'Kalinga', 'La Union', 'Laguna', 'Lanao del Norte', 'Lanao del Sur', 'Leyte', 'Maguindanao', 'Marinduque', 'Masbate', 'Metro Manila', 'Misamis Occidental', 'Misamis Oriental', 'Mountain Province', 'Negros Occidental', 'Negros Oriental', 'Northern Samar', 'Nueva Ecija', 'Nueva Vizcaya', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Pampanga', 'Pangasinan', 'Quezon', 'Quirino', 'Rizal', 'Romblon', 'Samar', 'Sarangani', 'Siquijor', 'Sorsogon', 'South Cotabato', 'Southern Leyte', 'Sultan Kudarat', 'Sulu', 'Surigao del Norte', 'Surigao del Sur', 'Tarlac', 'Tawi-Tawi', 'Zambales', 'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'];

    var select = document.getElementById("province-select");
    for (var i = 0; i < provinces.length; i++) {
        var opt = provinces[i];
        var el = document.createElement("option");
        el.textContent = opt;
        el.value = opt;
        select.appendChild(el);
    }
</script>
<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=ActZNAmGgUgPbTFaT1BeyxwxTuTgLVk6fOq8sFcOqMMnoc--p7WPGJuwTqXnmh18pYi9JBi-QdPc0pX2&currency=USD"></script>

<script>
    paypal.Buttons({
        onClick() {
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            //Address details
            var pincode = $('#pincode').val();
            var street = $('#street').val();
            var city = $('#city').val();
            var bldg_houseno = $('#bldg_houseno').val();
            var barangay = $('#barangay').val();
            var province = $("#province-select option:selected").val();


            if (name.length == 0) {
                $('.name').text("*This field is required");
            } else {
                $('.name').text("")
            }
            if (email.length == 0) {
                $('.email').text("*This field is required");
            } else {
                $('.email').text("")
            }
            if (phone.length == 0) {
                $('.phone').text("*This field is required");
            } else {
                $('.phone').text("")
            }
            if (pincode.length == 0) {
                $('.pincode').text("*This field is required");
            } else {
                $('.pincode').text("")
            }

            if (street.length == 0) {
                $('.street').text("*This field is required");
            } else {
                $('.street').text("")
            }
            if (city.length == 0) {
                $('.city').text("*This field is required");
            } else {
                $('.city').text("")
            }
            if (barangay.length == 0) {
                $('.barangay').text("*This field is required");
            } else {
                $('.barangay').text("")
            }
            if (bldg_houseno.length == 0) {
                $('.bldg_houseno').text("*This field is required");
            } else {
                $('.bldg_houseno').text("")
            }
            if (province.length == 0) {
                $('.province').text("*This field is required");
            } else {
                $('.province').text("")
            }

            if (name.length == 0 || email.length == 0 || phone.length == 0 || pincode.length == 0 || street.length == 0 || city.length == 0 || barangay.length == 0 || bldg_houseno.length == 0 || province.length == 0) {
                return false;
            }
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $total ?>' // Can also reference a variable or function
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                //Address details
                var pincode = $('#pincode').val();
                var street = $('#street').val();
                var city = $('#city').val();
                var bldg_houseno = $('#bldg_houseno').val();
                var barangay = $('#barangay').val();
                var province = $("#province-select option:selected").val();


                var data = {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'pincode': pincode,
                    'street': street,
                    'city': city,
                    'bldg_houseno': bldg_houseno,
                    'barangay': barangay,
                    'province': province,
                    'payment_mode': "PayPal",
                    'payment_id': transaction.id,
                    'placeOrderBtn': true
                }

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
                // When ready to go live, remove the alert and show a success message within this page. For example:
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');
</script>