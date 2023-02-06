<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h2>Products</h2>
                    </div>
                    <div class="card-body" id="products_table">

                        <table id="products" class="display" class="table-dark table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-text">ID</th>
                                    <th class="table-text" style="width: 120px;">Image</th>
                                    <th class="table-text">Name</th>
                                    <th class="table-text">Status</th>
                                    <th class="table-text">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $products = getAll("products");

                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $item) {
                                ?>
                                        <tr>
                                            <td class="table-text pl-2"><?= $item['ID']; ?></td>
                                            <td class="table-text"><img src="../uploads/<?= $item['Image']; ?>" alt="<?= $item['Name']; ?>" width="100px" height="100px"></td>
                                            <td class="table-text"><?= $item['Name']; ?></td>
                                            <td class="table-text"><?= $item['Status'] == 1 ? "Visible" : "Hidden" ?></td>
                                            <td class="table-text my-auto">
                                                <a href="edit-product.php?id=<?= $item['ID']; ?>" class="btn btn-info shadow button-text" style="width: 100px; margin-bottom: 0; ">Edit</a>
                                                <button type="button" value="<?= $item['ID']  ?>" class="btn btn-danger shadow button-text mx-2 delete_product_btn" style="width: 100px; margin-bottom: 0;">Delete</button>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    print("<tr><td class='table-text fw-bold'>No Records Found</td> </tr>");
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="table-text">ID</th>
                                    <th class="table-text" style="width: 120px;">Image</th>
                                    <th class="table-text">Name</th>
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
</div>


</div>

<?php include('includes/footer.php') ?>

<script>
    // Data tables for products
    $(document).ready(function() {
        $('#products').DataTable();
    });
</script>