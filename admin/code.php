<?php

include('../functions/myfunctions.php');
include('../config/dbcon.php');
// Check if the add_category_btn is set in the POST request
if (isset($_POST['add_category_btn'])) {
    // Escape special characters in the form inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    // Check if the status is set and store the value as 1 or 0
    $status = isset($_POST['status']) ? '1' : '0';
    // Check if the popular is set and store the value as 1 or 0
    $popular = isset($_POST['popular']) ? '1' : '0';

    // Get the uploaded image and its information
    $image = $_FILES['image']['name'];
    $path = "../uploads/category";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // If name, slug, or description are null, redirect to the add-category.php page with an error message
    if ($name == null || $slug == null || $description == null) {
        redirect('add-category.php', "Something Went Wrong In Adding Category.");
        exit();
    } else {
        // Insert the form inputs into the Categories table
        $category_query = "INSERT INTO Categories (name, slug, description, meta_title, meta_description, meta_keywords, image, status, popular) 
      VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$filename', '$status', '$popular')";

        $category_query_run = mysqli_query($con, $category_query);
    }

    // If the query was successful, move the uploaded image to the correct directory and redirect to the add-category.php page with a success message
    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect('add-category.php', "Category Added Successfully.");
    } else {
        // If the query was not successful, redirect to the add-category.php page with an error message
        redirect('add-category.php', "Something Went Wrong In Adding Category.");
    }
} else if (isset($_POST['update_category_btn'])) {
    //Escape the form data to prevent SQL injection
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    //Check if the status checkbox is checked and set the value accordingly
    $status = isset($_POST['status']) ? '1' : '0';
    //Check if the popular checkbox is checked and set the value accordingly
    $popular = isset($_POST['popular']) ? '1' : '0';

    //Getting the Image
    $new_image = mysqli_real_escape_string($con, $_FILES['image']['name']);
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);
    $path = "../uploads/category";

    //Update the status of products associated with the category
    $update_products = "UPDATE Products SET status='$status' WHERE CategoryID='$category_id'";
    $update_products_run = mysqli_query($con, $update_products);

    //Check if name, slug, and description fields are empty
    if ($name == null || $slug == null || $description == null) {
        //Redirect to the add-category page with an error message
        redirect('add-category.php', "Something Went Wrong In Updating Category.");
        exit();
    }

    //Check if a new image has been uploaded
    if ($new_image != "") {
        //Generate a new filename for the uploaded image
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        //If a new image has not been uploaded, use the old image name
        $update_filename = $old_image;
    }

    //Update the category information in the database
    $update_query = "UPDATE Categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";
    $update_query_run = mysqli_query($con, $update_query);

    // Check if the query to update category has been executed successfully
    if ($update_query_run) {
        // Check if a new image has been uploaded
        if ($_FILES['image']['name'] != "") {
            // Move the uploaded image to the specified folder
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            // Delete the old image if it exists
            if (file_exists("../uploads/category/" . $old_image)) {
                unlink("../uploads/category/" . $old_image);
            }
        }
        // Redirect to edit-category page with success message
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully.");
    } else {
        // Redirect to edit-category page with error message
        redirect("edit-category.php?id=$category_id", "Something went wrong.");
    }

    // Check if the delete_category_btn is set in $_POST
} else if (isset($_POST['delete_category_btn'])) {
    // Sanitize the category_id from $_POST
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    // Get the category data from the database
    $category_query = "SELECT * FROM Categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['Image'];

    // Delete the category from the database
    $delete_query = "DELETE FROM categories WHERE id ='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    // If the category is successfully deleted from the database
    if ($delete_query_run) {
        // Check if the category image exists and delete it
        if (file_exists("../uploads/category/" . $image)) {
            unlink("../uploads/category/" . $image);
        }
        // Return a success status code
        echo 200;
    } else {
        // Return an error status code
        echo 500;
    }

    // Check if the add_product_btn button is set
} else if (isset($_POST['add_product_btn'])) {
    // Escape and store the values from the form
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $original_price = mysqli_real_escape_string($con, $_POST['original_price']);
    $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_keywords']);

    //Get the Image
    $image = mysqli_real_escape_string($con, $_FILES['image']['name']);
    $path = "../uploads";
    // Get the image extension and generate a filename using time()
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Check if the required fields are filled
    if ($name == "" || $slug == "" || $description == "" ||  $category_id ==  "") {
        redirect('add-product.php', "Please Fill Up All neccessary fields");
        exit();
    }

    // Insert the product into the database
    $add_product_query = "INSERT INTO products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description) VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$filename', '$quantity', '$status', '$trending', '$meta_title', '$meta_keywords', '$meta_description')";
    $add_product_query_run = mysqli_query($con, $add_product_query);

    // Check if the query run successfully
    if ($add_product_query_run) {
        // Upload the image to its directories
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        // Redirect the user with the message of Product Added Successfully.
        redirect("add-product.php", "Product Added Successfully.");
    } else {
        // Else redirect the user with the message of something went wrong.
        redirect('add-product.php', "Something Went Wrong In Adding Product.");
    }

    // Check if the update_product_btn button is set
} else if (isset($_POST['update_product_btn'])) {
    // Escaping special characters in the form data to prevent SQL injection
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $original_price = mysqli_real_escape_string($con, $_POST['original_price']);
    $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

    // Setting values for Status and Trending based on the form data
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_keywords']);

    // Defining the path for saving the uploaded image
    $path = "../uploads";

    // Getting the new and old image filenames
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    // If a new image has been uploaded, update the filename
    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        // Use the old image if no new image has been uploaded
        $update_filename = $old_image;
    }

    // The SQL query for updating the product
    $update_product_query = "UPDATE Products SET CategoryID='$category_id', Name='$name', Slug='$slug', Small_Description='$small_description', Description='$description', Original_Price='$original_price', Selling_Price='$selling_price', Quantity='$quantity', Status='$status', Trending='$trending', Meta_Title='$meta_title', Meta_Keywords='$meta_keywords', Meta_Description='$meta_description', Image='$update_filename' WHERE ID='$product_id'";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    // Check if the update product query run successfully
    if ($update_product_query_run) {
        // Check if a new image was uploaded
        if ($_FILES['image']['name'] != "") {
            // Move the uploaded image to the 'uploads' folder
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            // Check if the old image exists and delete it
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        // Redirect the user to the edit product page with a success message
        redirect("edit-product.php?id=$product_id", "Product Updated Successfully.");
    } else {
        // Redirect the user to the edit product page with an error message
        redirect("edit-product.php?id=$product_id", "Something went wrong.");
    }

    // Check if the delete_product_btn is set in the POST request
} else if (isset($_POST['delete_product_btn'])) {
    // Escape and store the product ID from the POST request
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    // Select all information of the product with the specified ID
    $product_query = "SELECT * FROM Products WHERE ID='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['Image'];

    // Delete the product from the Products table with the specified ID
    $delete_query = "DELETE FROM Products WHERE ID ='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    // If the delete query runs successfully, delete the image file and return 200
    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        // redirect("products.php", "Product Deleted Successfully.");
        echo 200;
    } else {
        // If the delete query failed, redirect to products.php with an error message
        redirect("products.php", "Something Went Wrong");
    }

    // Check if the update_order_btn is set in the POST request
} else if (isset($_POST['update_order_btn'])) {
    // Escape and store the tracking number and status from the POST request
    $tracking_no = mysqli_real_escape_string($con, $_POST['tracking_no']);
    $order_status = mysqli_real_escape_string($con, $_POST['status']);

    // Update the status of the order with the specified tracking number
    $update_order_query = "UPDATE orders SET Status='$order_status', Updated_At=CURRENT_TIMESTAMP WHERE Tracking_No='$tracking_no';";
    $update_order_query_run = mysqli_query($con, $update_order_query);

    // Redirect to view-order.php with a success message
    redirect("view-order.php?tracking=$tracking_no", "Order status updated successfully.");

    // Check if the "add_post_btn" is set in $_POST
} else if (isset($_POST['add_post_btn'])) {
    // Escape and store the values from $_POST into variables
    $category_id = mysqli_real_escape_string($con, isset($_POST['category_id']) ? $_POST['category_id'] : "");
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = mysqli_real_escape_string($con, isset($_POST['status']) ? '1' : '0');
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_keywords']);

    // Set the path for the blog images
    $path = "../uploads/blog";
    // Get the image name from $_FILES and store in a variable
    $image = mysqli_real_escape_string($con, $_FILES['image']['name']);
    // Get the image extension
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    // Generate the filename for the image
    $filename = time() . '.' . $image_ext;

    // Check if the title, slug, description, and category_id fields have values
    if ($title == "" || $slug == "" || $description == "" ||  $category_id ==  "") {
        // Redirect back to the add-post page and display an error message
        redirect('add-post.php', "Please fill up all neccessary fields");
        exit();
    }

    // Insert the post into the Posts table
    $query = "INSERT INTO Posts (categoryid, title, image, slug, description, status, meta_title, meta_keywords, meta_description) 
                VALUES ('$category_id', '$title', '$filename', '$slug', '$description', '$status','$meta_title', '$meta_keywords', '$meta_description')";
    $query_run = mysqli_query($con, $query);

    // Check if the query ran successfully
    if ($query_run) {
        // If successful, move the uploaded image to the designated folder
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        // Redirect back to the add-post page with a success message
        redirect('add-post.php', "Post Added Successfully");
    } else {
        // Redirect back to the add-post page with an error message
        redirect('add-post.php', "Something went wrong in adding blog post");
    }

    // This else if statement checks if the form with the name 'update_post_btn' was submitted.
} else if (isset($_POST['update_post_btn'])) {
    // Escaping special characters from the form input data to prevent SQL injection
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // The status is set to 1 if the checkbox was checked, otherwise it's set to 0
    $status = isset($_POST['status']) ? '1' : '0';

    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_keywords']);

    // The path to the uploads directory for the blog images
    $path = "../uploads/blog";

    // Getting the new image name and old image name
    $new_image = mysqli_real_escape_string($con, $_FILES['image']['name']);
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);

    // If a new image was uploaded, set the update filename to the new image with a unique timestamp. 
    // Otherwise, keep the old image.
    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    // Update the post data in the database
    $update_post_query = "UPDATE Posts SET CategoryID='$category_id', Title='$title', Slug='$slug', Description='$description', Status='$status', Meta_Title='$meta_title', Meta_Keywords='$meta_keywords', Meta_Description='$meta_description', Image='$update_filename' WHERE ID='$post_id'";
    $update_post_query_run = mysqli_query($con, $update_post_query);

    // If the update query was successful
    if ($update_post_query_run) {
        // Check if a new image was uploaded
        if ($_FILES['image']['name'] != "") {
            // Move the uploaded file to the specified path
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            // If an old image exists, delete it
            if (file_exists("../uploads/blog/" . $old_image)) {
                unlink("../uploads/blog/" . $old_image);
            }
        }
        // Redirect to the edit post page with a success message
        redirect("edit-post.php?id=$post_id", "Post Updated Successfully.");
    } else {
        // Redirect to the edit post page with an error message
        redirect("edit-post.php?id=$post_id", "Something went wrong.");
    }

    //Check if delete_post_btn is set in $_POST
} else if (isset($_POST['delete_post_btn'])) {
    //Escaping post id from user input
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);

    //Retrieve post data with the given post id
    $post_query = "SELECT * FROM Posts WHERE ID='$post_id'";
    $post_query_run = mysqli_query($con, $post_query);
    $post_data = mysqli_fetch_array($post_query_run);
    $image = $post_data['Image'];

    //Delete post from database with the given post id
    $delete_query = "DELETE FROM Posts WHERE ID='$post_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    //Check if post deletion is successful
    if ($delete_query_run) {
        //Delete the post image if exists
        if (file_exists("../uploads/blog/" . $image)) {
            unlink("../uploads/blog/" . $image);
        }
        //Return success status
        echo 200;
    } else {
        //Return failure status
        echo 500;
    }

    //Check if delete_client_btn is set in $_POST
} else if (isset($_POST['delete_client_btn'])) {
    //Escaping user id from user input
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    //Delete user address with the given user id
    $delete_user_address_query = "DELETE FROM Address WHERE UserID='$user_id'";
    $delete_user_address_query_run = mysqli_query($con, $delete_user_address_query);

    //Delete user with the given user id
    $delete_query = "DELETE FROM Users WHERE ID='$user_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    //Check if both user and user address deletion are successful
    if ($delete_query_run && $delete_user_address_query_run) {
        //Return success status
        echo 200;
    } else {
        //Return failure status
        echo 500;
    }
}
//Otherwise, return failure status
else {
    echo 500;
}
