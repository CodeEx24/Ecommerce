<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" href="../assets/img/trendycart.png">
    <title>
        Trendy Cart
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> -->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle1" href="assets/css/styles.css" rel="stylesheet" />
    <link id="pagestyle2" href="assets/css/material-dashboard.min.css" rel="stylesheet" />

    <!-- AlertifyJs -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <!-- SweetAlert Dark Theme -->
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <!-- DATA TABLES PAGINATION -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />

    <!-- SUMMER NOTES -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- Styles for data table label, input etc. -->
    <style>
        /* Some modification for data tables because we use the cdn link for datatables */
        .dataTables_length label,
        .dataTables_filter label {
            color: white;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: white;
        }

        .dataTables_filter input[type="search"] {
            background-color: white;
            margin-bottom: 10px
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: white !important;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php
    include('sidebar.php') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">