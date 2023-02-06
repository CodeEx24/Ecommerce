<?php
include('../middleware/adminMiddleware.php');

include('includes/header.php');
?>

<div class="container-fluid mt-3 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0;">
                    <h2>Add Blog Post</h2>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Select Category</label>
                                        <select name="category_id" class="form-select form-control form-control-lg" pattern="^(?!Select Category$).+" title="Please select a category" required>

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
                                        <label class="text-white my-2" for="">Title</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="title" placeholder="Enter Post Title" required></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-white my-2" for="">Slug</label>
                                        <div class="mb-3"><input class="form-control" type="text" name="slug" placeholder="Enter Slug" required></div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="text-white my-2" for="">Content</label><br>
                                        <textarea class=" mb-2" id="summernote" name="description"></textarea>
                                        <!-- <textarea class="form-control mb-2" name="description" placeholder="Enter Description" rows="3" required></textarea> -->
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label class="text-white" for="">Upload Image</label>
                                        <br>
                                        <input type="file" name="image" required></input>
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <label class="text-white" for="">Visibility</label><br>
                                        <input type="checkbox" class="category-checkbox" name="status">
                                        <label class="checkbox-label" for="">Status</label>
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
                                        <div class="mt-4"><button class="btn btn-info shadow d-block w-100 add_post_btn" type="submit" name="add_post_btn">Add Blog Post</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h4 class="text-white">Latest Added Posts</h4>
                            <?php
                            $blogs = getLatestAdded("posts");
                            if (mysqli_num_rows($blogs) != 0) {
                                foreach ($blogs as $blog) {
                            ?>
                                    <img src="../uploads/blog/<?= $blog['Image'] ?>" alt="" style="object-fit: cover; width: 100%; height: 400px;">
                                    <h4 class='my-2'><?= $blog['Title'] ?></h4>
                                    <p class="ref-excerpt text-white mb-2"><?= substr($blog['Meta_Description'], 0, 130) . '...' ?></p>
                                    <a href="edit-post.php?id=<?= $blog['ID']; ?>" class="btn btn-info shadow button-text my-2" style="width: 100%;">Edit</a>
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

<script>
    function validateForm(event) {
        var select = document.querySelector("select[name='category_id']");
        if (select.selectedIndex === 0) {
            event.preventDefault();
            alert("Please select a category");
        }
    }
</script>


<?php include('includes/footer.php') ?>\

<script>
    $(document).ready(function() {
        $('.dropdown-toggle').attr('data-bs-toggle', 'dropdown');
    });
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.dropdown-toggle').attr('data-bs-toggle', 'dropdown');

    });
</script>