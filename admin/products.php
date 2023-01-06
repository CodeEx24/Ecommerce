<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Products</h2>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">Image</th>
                                <th class="table-text">Name</th>
                                <th class="table-text">Status</th>
                                <th class="table-text">Action</th>
                            </tr>
                        <tbody>
                            <?php
                            $products = getAll("products");

                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>

                                    <tr>
                                        <td class="table-text"><?= $item['ID']; ?></td>
                                        <td class="table-text"><img src="../uploads/<?= $item['Image']; ?>" alt="<?= $item['Name']; ?>" width="100px" height="100px"></td>
                                        <td class="table-text"><?= $item['Name']; ?></td>
                                        <td class="table-text"><?= $item['Status'] == 0 ? "Visible" : "Hidden" ?></td>
                                        <td class="table-text">
                                            <a href="edit-product.php?id=<?= $item['ID']; ?>" class="btn btn-primary shadow button-text" style="width: 100px; ">Edit</a>
                                            <button type="button" value="<?= $item['ID']  ?>" class="btn btn-danger shadow button-text mx-2 delete_product_btn" style="width: 100px;">Delete</button>

                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No records found";
                            }
                            ?>


                            <tr>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<?php include('includes/footer.php') ?>