<?php
include('../middleware/adminMiddleware.php');

include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category_item = getByID("categories", $id);

                if (mysqli_num_rows($category_item) > 0) {
                    $data = mysqli_fetch_array($category_item);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h2>Edit Category<a href="category.php" class="btn btn-primary shadow float-end button-text">Back</a></h2>

                        </div>
                        <hr class="light horizontal my-0">
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="category_id" value="<?= $data['ID'] ?>">
                                        <label class="text-white my-2" for="">Name</label>
                                        <div class="mb-3">
                                            <input class="form-control" type="text" name="name" placeholder="Enter Category Name" value="<?= $data['Name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-white my-2" for="">Slug</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug" value="<?= $data['Slug'] ?>" required></div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label class="text-white my-2" for="">Description</label><br>
                                    <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3" required><?= $data['Description'] ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="text-white my-2" for="">Meta Title</label>
                                    <div class="mb-3"><input class="form-control" type="text" name="meta_title" placeholder="Enter Meta Title" value="<?= $data['Meta_Title'] ?>"></div>
                                </div>
                                <div class="col-md-12">
                                    <label class="text-white my-2" for="">Meta Description</label><br>
                                    <textarea class="form-control mb-2" name="meta_description" placeholder="Enter Meta Description" rows="3"><?= $data['Meta_Description'] ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="text-white my-2" for="">Meta Keywords</label><br>
                                    <textarea class="form-control mb-2" name="meta_keywords" placeholder="Enter Meta Keywords" rows="3"><?= $data['Meta_Keywords'] ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="text-white" for="">Current Image</label><br>
                                                <img src="../uploads/category/<?= $data['Image'] ?>" alt="" width="100px" height="100px" style="object-fit: cover;">
                                            </div>
                                            <div class="col-md-8 my-auto">
                                                <label class="text-white" for="">Change Image</label><br>
                                                <input type="file" name="image" ?></input>
                                                <input type="hidden" name="old_image" value="<?= $data['Image'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5 my-auto">
                                        <label class="text-white" for="">Visibility & Popularity</label><br>
                                        <div class="mt-2">
                                            <input type="checkbox" <?= $data['Status'] ? "checked" : "" ?> class="category-checkbox" name="status">
                                            <label class="checkbox-label" for="">Status</label>
                                            <input type="checkbox" <?= $data['Popular'] ? "checked" : "" ?> class="category-checkbox" name="popular">
                                            <label class="checkbox-label" for="">Popular</label>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="mt-4">
                                        <button class="btn btn-info shadow d-block w-100" type="submit" name="update_category_btn">Update Category</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
        </div>
<?php
                } else {
                    include('includes/404.php');
                }
            } else {
                include('includes/404.php');
            }
?>
    </div>
</div>
</div>
</div>
<?php include('includes/footer.php') ?>