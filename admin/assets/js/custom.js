$(document).ready(function () {
  $(document).on('click', '.delete_post_btn', function (e) {
    e.preventDefault();

    var id = $(this).val();

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

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
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              post_id: id,
              delete_post_btn: true,
            },
            success: function (response) {
              if (response == 200) {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Post Deleted Successfully.',
                  'success'
                );
                $('#post_table').load(location.href + ' #post_table');
              } else if (response == 500) {
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
    e.preventDefault();

    var id = $(this).val();

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

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
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              product_id: id,
              delete_product_btn: true,
            },
            success: function (response) {
              if (response == 200) {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Product Deleted Successfully.',
                  'success'
                );
                $('#products_table').load(location.href + ' #products_table');
              } else if (response == 500) {
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

    var id = $(this).val();

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary shadow',
        cancelButton: 'btn btn-danger shadow mx-3',
        htmlContainer: 'text-center',
      },
      buttonsStyling: false,
    });

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
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: 'code.php',
            data: {
              category_id: id,
              delete_category_btn: true,
            },
            success: function (response) {
              if (response == 200) {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Product Deleted Successfully.',
                  'success'
                );
                $('#category_table').load(location.href + ' #category_table');
              } else if (response == 500) {
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
