<?php
include('../middleware/adminMiddleware.php');

include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0;">
                    <h2>Add Product</h2>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Select Category</label>
                                        <select name="category_id" class="form-select form-control form-control-lg" required>
                                            <option selected disabled value="">Select Category</option>
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
                                        <label class="text-white my-2" for="">Name</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="name" placeholder="Enter Product Name" required></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Slug</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug" required></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Quantity</label>
                                        <div class="mb-3"><input class="form-control" type="number" name="quantity" placeholder="Enter Quantity" required></div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Original Price</label>
                                        <div class="mb-3"><input class="form-control" type="number" step="0.01" name="original_price" placeholder="Enter Original Price" required></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Selling Price</label>
                                        <div class="mb-3"><input class="form-control" type="number" step="0.01" name="selling_price" placeholder="Enter Selling Price" required></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-white my-2" for="">Small Description</label><br>
                                        <textarea class="form-control mb-2" name="small_description" placeholder="Enter Small Description" rows="3" required></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-white my-2" for="">Description</label><br>
                                        <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3" required></textarea>
                                    </div>


                                    <div class="col-md-6 my-3">

                                        <label class="text-white" for="">Upload Image</label>
                                        <br>
                                        <input type="file" name="image" required></input>

                                    </div>
                                    <div class="col-md-6 my-3">
                                        <label class="text-white" for="">Visibility & Popularity</label><br>
                                        <input type="checkbox" class="category-checkbox" name="status">
                                        <label class="checkbox-label" for="">Status</label>
                                        <input type="checkbox" class="category-checkbox" name="trending">
                                        <label class="checkbox-label" for="">Trending</label>
                                    </div>


                                    <div class="col-md-12">
                                        <label class="text-white my-2" for="">Meta Title</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="meta_title" placeholder="Enter Meta Title"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-white my-2" for="">Meta Description</label><br>
                                        <textarea class="form-control mb-2" name="meta_description" placeholder="Enter Meta Description" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-white my-2" for="">Meta Keywords</label><br>
                                        <textarea class="form-control mb-2" name="meta_keywords" placeholder="Enter Meta Keywords" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mt-4"><button class="btn btn-info shadow d-block w-100" type="submit" name="add_product_btn">Add Product</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h4 class="text-white">Latest Added Product</h4>
                            <?php
                            $products = getLatestAdded("Products");
                            if (mysqli_num_rows($products) != 0) {
                                foreach ($products as $product) {
                            ?>
                                    <img src="../uploads/<?= $product['Image'] ?>" alt="" style="object-fit: cover; width: 100%; height: 400px;">
                                    <h4><?= $product['Name'] ?></h4>
                                    <p class="ref-excerpt text-white mb-2"><?= substr($product['Meta_Description'], 0, 130) . '...' ?></p>
                                    <a href="edit-product.php?id=<?= $product['ID']; ?>" class="btn btn-info shadow button-text" style="width: 100%; margin-bottom: 0; ">Edit</a>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>

<?php include('includes/footer.php') ?>