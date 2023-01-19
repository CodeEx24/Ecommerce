<?php

if (!isset($_SESSION['auth'])) {
    redirectNoMess("login.php");
}
