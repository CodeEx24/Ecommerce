<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');
?>
<section class="">
    <div class="container py-5">
        <div class="row mb-4 mb-lg-1">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <p class="fw-bold text-success mb-2">Set-up your order details</p>
                <h2 class="fw-bold">Order Details</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body text-start d-flex flex-column align-items-center">

                        <div>
                            <h5 class="mb-3 fw-bold">Basic Details</h5>

                            <div class="row">
                                <hr class="mx-2">
                                <div class="col-md-6">
                                    <h6>Name</h6>
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter your full name" required>
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6 ">
                                    <h6>Phone</h6>
                                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter your phone number" required>
                                    <small class="text-danger phone"></small>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h6>Email</h6>
                                    <input class="form-control" name="email" id="email" type="email" value="<?= $_SESSION['auth_user']['email'] ?>" placeholder="Enter your email" required>
                                    <small class="text-danger email"></small>
                                </div>
                                <h5 class="mt-5 mb-3 fw-bold">Address Details</h5>
                                <hr class="mx-2">
                                <div class="col-md-12">
                                    <h6>Provinces</h6>
                                    <select class="form-control" name="province" id="province-select" required>
                                        <option value="" disabled selected>Select a province</option>
                                    </select>
                                    <small class="text-danger province"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Street Name</h6>
                                    <input class="form-control" name="street" id="street" type="text" placeholder="Enter the street name" required>
                                    <small class="text-danger street"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>City</h6>
                                    <input class="form-control" name="city" id="city" type="text" placeholder="Enter the city" required>
                                    <small class="text-danger city"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Pin Code</h6>
                                    <input class="form-control input-pincode" id="pincode" name="pincode" type="text" placeholder="Enter your pin code" required>
                                    <small class="text-danger pincode"></small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Barangay</h6>
                                    <input class="form-control" name="barangay" id="barangay" type="text" placeholder="Enter the barangay" required>
                                    <small class="text-danger barangay"></small>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h6>Building, House No.</h6>
                                    <textarea class="form-control mb-2" name="bldg_houseno" id="bldg_houseno" placeholder="Enter the building house number" rows="3" required></textarea>
                                    <small class="text-danger bldg_houseno"></small>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="updateDetailsBtn" class="btn btn-primary text-white w-100 ">Update Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>

<!-- Provinces option of a user -->
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

<!-- Paypal process and rendering the details in the database -->
PHP:
<?php

?>
SCRIPT:
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
                        value: '<?= $total ?>' // Can also reference a variable or function
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