<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php')
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
                                    <input class="form-2" name="name" type="text" placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6">
                                    <h6>Email</h6>
                                    <input class="form-2" name="email" type="text" value="<?= $_SESSION['auth_user']['email'] ?>" placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Phone</h6>
                                    <input class="form-2" name="phone" type="text" placeholder="Enter your phone number" required>
                                </div>
                                <h5 class="mt-4">Address Details</h5>
                                <hr>
                                <div class="col-md-12">
                                    <h6>Provinces</h6>
                                    <select class="form-2" name="province" id="province-select" required>
                                        <option value="" disabled selected>Select a province</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Street Name</h6>
                                    <input class="form-2" name="street" type="text" placeholder="Enter the street name" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>City</h6>
                                    <input class="form-2" name="city" type="text" placeholder="Enter the city" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Pin Code</h6>
                                    <input class="form-2 input-pincode" name="pincode" type="text" placeholder="Enter your pin code" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>Barangay</h6>
                                    <input class="form-2" name="barangay" type="text" placeholder="Enter the barangay" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h6>Building, House No.</h6>
                                    <textarea class="form-2 mb-2" name="bldg_houseno" placeholder="Enter the building house number" rows="3" required></textarea>
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
                                    <div class="col-md-3 text-center">
                                        <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="object-fit: fill; width: 60px; height: 60px;">
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <p><?= $item['name'] ?></p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p><?= $item['selling_price'] ?></p>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
<?php include('includes/footer.php') ?>