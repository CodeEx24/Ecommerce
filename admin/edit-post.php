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
                $post_item = getByID("Posts", $id);

                if (mysqli_num_rows($post_item) > 0) {

                    $data = mysqli_fetch_array($post_item);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h2>Edit Blog Post<a href="posts.php" class="btn btn-primary shadow float-end button-text">Back</a></h2>
                        </div>
                        <hr class="light horizontal my-0">
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="category-label my-2" for="">Select Category</label>
                                        <select name="category_id" class="form-select form-control form-control-lg">

                                            <?php
                                            $categories = getAll("categories");
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                                    <option value="<?= $item['ID'] ?>" <?= $data['CategoryID'] ==  $item['ID'] ? 'selected' : '' ?>><?= $item['Name'] ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "<option>No Category Found</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="post_id" value="<?= $data['ID'] ?>">
                                    <div class="col-md-4">
                                        <label class="category-label my-2" for="">Title</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="title" placeholder="Enter Category Name" required value="<?= $data['Title'] ?>"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="category-label my-2" for="">Slug</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug" required value="<?= $data['Slug'] ?>"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="category-label my-2" for="">Description</label><br>
                                        <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3" required><?= $data['Description'] ?></textarea>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center">
                                        <div>
                                            <label class="category-label" for="">Current Image</label><br>
                                            <img src="../uploads/blog/<?= $data['Image'] ?>" alt="" width="100px" height="100px">
                                        </div>
                                        <div class="mx-5">
                                            <label class="category-label" for="">Upload Image</label>
                                            <br>
                                            <input type="file" name="image"></input>
                                            <input type="hidden" name="old_image" value="<?= $data['Image'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 category-checkbox-div flex-container align-items-center">
                                        <input type="checkbox" class="category-checkbox" name="status" <?= $data['Status'] ? "checked" : "" ?>>
                                        <label class="checkbox-label" for="">Status</label>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="category-label my-2" for="">Meta Title</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="meta_title" placeholder="Enter Meta Title" value="<?= $data['Meta_Title'] ?>" required></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="category-label my-2" for="">Meta Description</label><br>
                                        <textarea class="form-control mb-2" name="meta_description" placeholder="Enter Meta Description" rows="3" required><?= $data['Meta_Description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="category-label my-2" for="">Meta Keywords</label><br>
                                        <textarea class="form-control mb-2" name="meta_keywords" placeholder="Enter Meta Keywords" rows="3" required><?= $data['Meta_Keywords'] ?></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mt-4"><button class="btn btn-info shadow d-block w-100" type="submit" name="update_post_btn">Update Post</button></div>
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