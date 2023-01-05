<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container-fluid py-4 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Add Category</h2>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="category-label my-2" for="">Name</label>
                                <div class="mb-3"><input class="form-control" type="text" name="name" placeholder="Enter Category Name"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="category-label my-2" for="">Slug</label>
                                <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug"></div>
                            </div>
                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Description</label><br>
                                <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Title</label>
                                <div class="mb-3"><input class="form-control" type="text" name="meta_title" placeholder="Enter Meta Title"></div>
                            </div>
                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Description</label><br>
                                <textarea class="form-control mb-2" name="meta_description" placeholder="Enter Meta Description" rows="3"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="category-label my-2" for="">Meta Keywords</label><br>
                                <textarea class="form-control mb-2" name="meta_keywords" placeholder="Enter Meta Keywords" rows="3"></textarea>
                            </div>
                            <!-- <div class="col-md-12">
                            <label for="">Upload Image</label><br>
                            <input type="file" name="image"></input>
                        </div> -->
                            <div class="col-md-6">
                                <label class="category-label" for="">Upload Image</label><br>
                                <input type="file" name="image"></input>
                            </div>
                            <div class="col-md-6 category-checkbox-div flex-container">
                                <input type="checkbox" class="category-checkbox" name="status">
                                <label class="checkbox-label" for="">Status</label>
                                <input type="checkbox" class="category-checkbox" name="popular">
                                <label class="checkbox-label" for="">Popular</label>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-4"><button class="btn btn-primary shadow d-block w-100" type="submit" name="add_category_btn">Add Category</button></div>
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