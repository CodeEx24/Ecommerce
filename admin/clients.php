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
                        <h2>Clients</h2>
                    </div>
                    <div class="card-body" id="clients_table">

                        <table id="clients" class="display" class="table-dark table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-text">ID</th>
                                    <th class="table-text">Name</th>
                                    <th class="table-text">Phone</th>
                                    <th class="table-text">Email</th>
                                    <th class="table-text">Delete User</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $users = getAll("Users");

                                if (mysqli_num_rows($users) > 0) {
                                    foreach ($users as $user) {
                                ?>
                                        <tr>
                                            <td class="table-text pl-2"><?= $user['ID']; ?></td>
                                            <td class="table-text"><?= $user['Name']; ?></td>
                                            <td class="table-text"><?= $user['Phone']; ?></td>
                                            <td class="table-text"><?= $user['Email'] ?></td>
                                            <td class="table-text my-auto">
                                                <button type="button" value="<?= $user['ID'] ?>" class="btn btn-danger shadow button-text mx-2 delete_client_btn" style="width: 100px; margin-bottom: 0;">Delete</button>
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
                                    <th class="table-text">Name</th>
                                    <th class="table-text">Phone</th>
                                    <th class="table-text">Email</th>
                                    <th class="table-text">Delete User</th>
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
    // Data tables for clients
    $(document).ready(function() {
        $('#clients').DataTable();
    });
</script>