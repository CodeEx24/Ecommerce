    <!-- JQUERY CDN LINK -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-dark.js"></script>
    <script src="assets/js/jquery-3.6.3.min.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- AlertifyJS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Display messages if category is successfully added or updated and if there is an error. -->
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php
        if (isset($_SESSION['message'])) {
            if ($_SESSION['message']) {
        ?>
                alertify.success('<?= $_SESSION['message'] ?>');
        <?php
                unset($_SESSION['message']);
            }
        }
        ?>
    </script>
    </body>

    </html>