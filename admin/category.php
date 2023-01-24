<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-12 p-3">
                    <div class="card-header" style="padding-bottom: 0;">
                        <h2>Categories</h2>
                    </div>
                    <div class="card-body" id="category_table">
                        <table id="category" class="display" class="table-dark table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-text p-4">ID</th>
                                    <th class="table-text p-4" style="width: 120px;">Image</th>
                                    <th class="table-text p-4">Name</th>
                                    <th class="table-text p-4">Status</th>
                                    <th class="table-text p-4">Action</th>
                                </tr>
                            <tbody>
                                <?php
                                $category = getAll("categories");

                                if (mysqli_num_rows($category) > 0) {
                                    foreach ($category as $item) {
                                ?>

                                        <tr>
                                            <td class="table-text p-4"><?= $item['ID']; ?></td>
                                            <td class="table-text p-4" style="width: 120px;"><img src="../uploads/category/<?= $item['Image']; ?>" alt="<?= $item['Name']; ?>" width="100px" height="100px"></td>
                                            <td class="table-text p-4"><?= $item['Name']; ?></td>
                                            <td class="table-text p-4"><?= $item['Status'] == 1 ? "Visible" : "Hidden" ?></td>
                                            <td class="table-text p-4">
                                                <a href="edit-category.php?id=<?= $item['ID']; ?>" class="btn btn-info shadow button-text" style="width: 100px;">Edit</a>
                                                <button type="button" value="<?= $item['ID']  ?>" class="btn btn-danger shadow button-text mx-2 delete_category_btn" style="width: 100px;">Delete</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No records found";
                                }
                                ?>
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

<script>
    $(document).ready(function() {
        $('#category').DataTable();
    });
</script>