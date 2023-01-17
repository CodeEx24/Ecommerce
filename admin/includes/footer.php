<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://dev-jbagency.pantheonsite.io/" class="font-weight-bold" target="_blank">JBAgency</a>
                    for a better web.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/blog" class="nav-link" target="_blank">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0" target="_blank">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</main>

<script src="assets/js/jquery-3.6.3.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/perfect-scrollbar.min.js"></script>
<script src="assets/js/smooth-scrollbar.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="assets/js/custom.js"></script>


<!-- AlertifyJS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- Display messages if category is successfully added or updated and if there is an error. -->
<script>
    <?php
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] == "Category Added Successfully." || $_SESSION['message'] == "Category Updated Successfully." || $_SESSION['message'] == "Category Deleted Successfully." || $_SESSION['message'] == "Product Added Successfully." || $_SESSION['message'] == "Product Updated Successfully." || $_SESSION['message'] == "Order status updated successfully.") {
    ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['message'] ?>');
        <?php
            unset($_SESSION['message']);
        } else {
        ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('<?= $_SESSION['message'] ?>');
    <?php
            unset($_SESSION['message']);
        }
    }

    ?>
</script>



</body>

</html>