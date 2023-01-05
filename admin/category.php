<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container-fluid py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Categories</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th class="table-text">ID</th>
                                <th class="table-text">Image</th>
                                <th class="table-text">Name</th>
                                <th class="table-text">Status</th>
                                <th class="table-text">Edit</th>
                            </tr>
                        <tbody>
                            <?php
                            $category = getAll("categories");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                            ?>

                                    <tr>
                                        <td class="table-text"><?= $item['ID']; ?></td>
                                        <td class="table-text"><img src="../uploads/<?= $item['Image']; ?>" alt="<?= $item['Name']; ?>" width="100px" height="100px"></td>
                                        <td class="table-text"><?= $item['Name']; ?></td>
                                        <td class="table-text"><?= $item['Status'] == 0 ? "Visible" : "Hidden" ?></td>
                                        <td class="table-text"><a href="edit-category.php?id=<?= $item['ID']; ?>" class="btn btn-primary shadow button-text">Edit</a></td>
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