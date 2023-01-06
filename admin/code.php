<?php

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
        exit();
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

    if ($name == null || $slug == null || $description == null) {
        redirect('add-category.php', "Something Went Wrong In Updating Category.");
        exit();
    }


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
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully.");
    } else {
        redirect("edit-category.php?id=$category_id", "Something went wrong.");
    }
} else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM Categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['Image'];

    $delete_query = "DELETE FROM categories WHERE id ='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        // redirect("category.php", "Category Deleted Successfully.");
        echo 200;
    } else {
        // redirect("category.php", "Something Went Wrong");
        echo 500;
    }
} else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $quantity = $_POST['quantity'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_description'];
    $meta_description = $_POST['meta_keywords'];

    //Getting the Image
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    $path = "../uploads";

    if ($name == null || $slug == null || $description == null) {
        redirect('add-category.php', "Something Went Wrong In Updating Category.");
        exit();
    }


    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    //Check if the field has a value
    if ($name == "" || $slug == "" || $description == "") {
        redirect('add-product.php', "Please Fill Up All neccessary fields");
        exit();
    }

    $add_product_query = "INSERT INTO products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description) VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$filename', '$quantity', '$status', '$trending', '$meta_title', '$meta_keywords', '$meta_description')";

    $add_product_query_run = mysqli_query($con, $add_product_query);

    if ($add_product_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-product.php", "Product Added Successfully.");
    } else {
        redirect('add-product.php', "Something Went Wrong In Adding Product.");
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $quantity = $_POST['quantity'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_description'];
    $meta_description = $_POST['meta_keywords'];


    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE Products SET CategoryID='$category_id', Name='$name', Slug='$slug', Small_Description='$small_description', Description='$description', Original_Price='$original_price', Selling_Price='$selling_price', Quantity='$quantity', Status='$status', Trending='$trending', Meta_Title='$meta_title', Meta_Keywords='$meta_keywords', Meta_Description='$meta_description', Image='$update_filename' WHERE ID='$product_id'";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "Product Updated Successfully.");
    } else {
        redirect("edit-product.php?id=$product_id", "Something went wrong.");
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM Products WHERE ID='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['Image'];

    $delete_query = "DELETE FROM Products WHERE ID ='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        // redirect("products.php", "Product Deleted Successfully.");
        echo 200;
    } else {
        redirect("products.php", "Something Went Wrong");
    }
} else {
    // redirect('../index.php', '');
    echo 500;
}
