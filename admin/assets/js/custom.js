$(document).ready(function () {
  $(document).on('click', '.delete_post_btn', function (e) {
    // Prevent the default behavior of the click event
    e.preventDefault();

    // Get the value of the `val` attribute of the clicked element
    var id = $(this).val();

    // Define the custom alert using SweetAlert library
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

    // Show the custom alert and wait for the user to confirm or cancel the action
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: false,
      })
      .then((result) => {
        // If the user confirms the action, perform an AJAX request to delete the post
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              post_id: id,
              delete_post_btn: true,
            },
            success: function (response) {
              // If the response is 200, show the success alert and reload the post table
              if (response == 200) {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Post Deleted Successfully.',
                  'success'
                );
                // Remove the post from data table
                var table = $('#posts').DataTable();
                var row = $('#' + id);
                table.row(row).remove().draw();
              } else if (response == 500) {
                // If the response is 500, show the error alert
                swalWithBootstrapButtons.fire(
                  'Error',
                  'Something went wrong.',
                  'error'
                );
              }
            },
          });
        }
      });
  });

  $(document).on('click', '.delete_product_btn', function (e) {
    // Prevent default behavior of the click event
    e.preventDefault();

    // Get the value (product id) of the clicked button
    var id = $(this).val();

    // Create a custom SweetAlert2 alert with bootstrap styling
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

    // Show the alert to confirm deletion
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: false,
      })
      .then((result) => {
        // If the user confirms deletion
        if (result.isConfirmed) {
          // Make an AJAX call to delete the product
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              product_id: id,
              delete_product_btn: true,
            },
            success: function (response) {
              // Check the response from the server
              if (response == 200) {
                // Remove the product from data table
                var table = $('#products').DataTable();
                var row = $('#' + id);
                table.row(row).remove().draw();
                // Show success alert if product is deleted successfully
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Product Deleted Successfully.',
                  'success'
                );
                // Reload the products table
              } else if (response == 500) {
                // Show error alert if something went wrong
                swalWithBootstrapButtons.fire(
                  'Error',
                  'Something went wrong.',
                  'error'
                );
              }
            },
          });
        }
      });
  });

  $(document).on('click', '.delete_category_btn', function (e) {
    e.preventDefault();

    // Get the value of the clicked button
    var id = $(this).val();

    // Mixin the sweetalert2 library with custom classes for the buttons
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

    // Show a confirmation modal using the mixin
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: false,
      })
      // Handle the result of the user's action on the modal
      .then((result) => {
        // If the user confirmed the deletion
        if (result.isConfirmed) {
          // Make an AJAX request to the "code.php" URL
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              category_id: id,
              delete_category_btn: true,
            },
            // Handle the response from the server
            success: function (response) {
              // If the response from the server is "200"
              if (response == 200) {
                // Show a success message using the mixin
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Product Deleted Successfully.',
                  'success'
                );

                // Remove the post from data table
                var table = $('#category').DataTable();
                var row = $('#' + id);
                table.row(row).remove().draw();
              }
              // If the response from the server is "500"
              else if (response == 500) {
                // Show an error message using the mixin
                swalWithBootstrapButtons.fire(
                  'Error',
                  'Something went wrong.',
                  'error'
                );
              }
            },
          });
        }
      });
  });

  $(document).on('click', '.delete_client_btn', function (e) {
    e.preventDefault();

    // get the value of the clicked button
    var id = $(this).val();

    // create a Swal mixin with custom styles for buttons and HTML container
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

    // display a confirmation dialog using the mixin
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: false,
      })
      .then((result) => {
        // if the confirm button is clicked
        if (result.isConfirmed) {
          // make a POST request to the server
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              user_id: id,
              delete_client_btn: true,
            },
            success: function (response) {
              // if the server returns a success status code
              if (response == 200) {
                // display a success message using the mixin
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Client Deleted Successfully.',
                  'success'
                );
                // refresh the clients table
                $('#clients_table').load(location.href + ' #clients_table');
              } else {
                // if the server returns an error status code
                swalWithBootstrapButtons.fire(
                  'Error',
                  'Something went wrong.',
                  'error'
                );
              }
            },
          });
        }
      });
  });
});
