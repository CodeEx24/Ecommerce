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
                        <h2>Posts</h2>
                    </div>
                    <div class="card-body" id="post_table">
                        <table id="posts" class="display table-dark table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-text">ID</th>
                                    <th class="table-text" style="width: 120px;">Image</th>
                                    <th class="table-text">Title</th>
                                    <th class="table-text">Status</th>
                                    <th class="table-text">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = getAll("posts");

                                if (mysqli_num_rows($posts) > 0) {
                                    foreach ($posts as $item) {
                                ?>
                                        <tr id="<?= $item['ID']; ?>">
                                            <td class="table-text pl-2"><?= $item['ID']; ?></td>
                                            <td class="table-text"><img src="../uploads/blog/<?= $item['Image']; ?>" alt="<?= $item['Title']; ?>" style="object-fit: cover; width: 100px; height: 100px;"></td>
                                            <td class="table-text"><?= $item['Title']; ?></td>
                                            <td class="table-text"><?= $item['Status'] == 1 ? "Visible" : "Hidden" ?></td>
                                            <td class="table-text my-auto">
                                                <a href="edit-post.php?id=<?= $item['ID']; ?>" class="btn btn-info shadow button-text" style="width: 100px; margin-bottom: 0;">Edit</a>
                                                <button type="button" value="<?= $item['ID']  ?>" class="btn btn-danger shadow button-text mx-2 delete_post_btn" style="width: 100px; margin-bottom: 0;">Delete</button>
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
                                    <th class="table-text">Title</th>
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

<?php include('includes/footer.php') ?>

<script>
    $(document).ready(function() {
        $('#posts').DataTable();
    });
</script>