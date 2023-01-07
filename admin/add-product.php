<?php
include('../middleware/adminMiddleware.php');

include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Add Product</h2>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Select Category</label>
                                <select name="category_id" class="form-select form-control form-control-lg">
                                    <option selected>Select Category</option>
                                    <?php
                                    $categories = getAll("categories");
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['ID'] ?>"><?= $item['Name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "<option>No Category Found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Name</label>
                                <div class="mb-3"><input class="form-control" type="text" name="name" placeholder="Enter Category Name" required></div>
                            </div>
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Slug</label>
                                <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug" required></div>
                            </div>
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Small Description</label><br>

                                <textarea class="form-control mb-2" name="small_description" placeholder="Enter Small Description" rows="1" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Original Price</label>
                                <div class="mb-3"><input class="form-control" type="number" name="original_price" placeholder="Enter Original Price" required></div>
                            </div>
                            <div class="col-md-4">
                                <label class="category-label my-2" for="">Selling Price</label>
                                <div class="mb-3"><input class="form-control" type="number" name="selling_price" placeholder="Enter Selling Price" required></div>
                            </div>

                            <div class="col-md-6">
                                <label class="category-label my-2" for="">Description</label><br>
                                <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="category-label my-2" for="">Quantity</label>
                                <div class="mb-3"><input class="form-control" type="number" name="quantity" placeholder="Enter Selling Price" required></div>
                            </div>

                            <div class="col-md-6 ">

                                <label class="category-label" for="">Upload Image</label>
                                <br>
                                <input type="file" name="image" required></input>

                            </div>
                            <div class="col-md-6 category-checkbox-div flex-container align-items-center">
                                <input type="checkbox" class="category-checkbox" name="status">
                                <label class="checkbox-label" for="">Status</label>
                                <input type="checkbox" class="category-checkbox" name="trending">
                                <label class="checkbox-label" for="">Trending</label>
                            </div>


                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Title</label>
                                <div class="mb-3"><input class="form-control" type="text" name="meta_title" placeholder="Enter Meta Title" required></div>
                            </div>
                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Description</label><br>
                                <textarea class="form-control mb-2" name="meta_description" placeholder="Enter Meta Description" rows="3" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Keywords</label><br>
                                <textarea class="form-control mb-2" name="meta_keywords" placeholder="Enter Meta Keywords" rows="3" required></textarea>
                            </div>



                            <div class="col-md-12">
                                <div class="mt-4"><button class="btn btn-info shadow d-block w-100" type="submit" name="add_product_btn">Add Product</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


</div>

<?php include('includes/footer.php') ?>