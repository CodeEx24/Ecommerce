<?php

session_start();
include('../functions/myfunctions.php');
include('../config/dbcon.php');

if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    //Getting the Image
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name == null || $slug == null || $description == null) {
        redirect('add-category.php', "Something Went Wrong In Adding Category.");
    } else {
        $category_query = "INSERT INTO Categories (name, slug, description, meta_title, meta_description, meta_keywords, image, status, popular) 
        VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$filename', '$status', '$popular')";

        $category_query_run = mysqli_query($con, $category_query);
    }

    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect('add-category.php', "Category Added Successfully.");
    } else {
        redirect('add-category.php', "Something Went Wrong In Adding Category.");
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    //Getting the Image
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    $path = "../uploads";


    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_query = "UPDATE Categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
    } else {
        redirect("edit-category.php?id=$category_id", "Something went wrong.");
    }
}
