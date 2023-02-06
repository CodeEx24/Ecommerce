$(document).ready(function () {
  $(document).on('click', '.addToCart-btn', function (e) {
    // prevent default behavior of the event
    e.preventDefault();

    // get the value of the input field with class 'input-quantity' within the closest parent element with class 'product-data'
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();

    // get the value of the button with class 'addToCart-btn'
    var product_id = $(this).val();

    // convert the quantity to a number and set it to 1 if it's falsy
    quantity = Number(quantity);
    quantity = quantity ? quantity : 1;

    // make an AJAX post request to 'functions/handlecart.php'
    $.ajax({
      type: 'POST',
      url: 'functions/handlecart.php',
      data: {
        // send product_id, quantity, and scope with the request
        product_id: product_id,
        quantity: quantity,
        scope: 'add',
      },

      success: function (response) {
        // check the response and show the corresponding notification
        if (response == 201) {
          // reload the element with id 'cart'
          $('#cart').load(location.href + ' #cart');

          // show success notification
          $.notification(['Product added to cart successfully'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        } else if (response == 'existing') {
          // show warning notification for existing product
          $.notification(['Product already existing in the cart'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'warning',
          });
        } else if (response == 401) {
          // show warning notification for unauthorized access
          $.notification(['You must log in first before adding into cart'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'warning',
          });
        } else if (response == 500) {
          // show warning notification for internal server error
          $.notification(['Something went wrong'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'warning',
          });
        }
      },
    });
  });

  $(document).on('click', '.increment-btn-cart', function (e) {
    e.preventDefault();

    // Get the current quantity value
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();

    // Convert the string quantity to a number
    var value = parseInt(quantity, 10);

    // Get the current product subtotal and product price values
    var pst = $(this).closest('.product-data').find('.subtotal').val();
    var pp = $(this).closest('.product-data').find('.productPrice').val();

    // Get the total input element
    const totalInput = document.querySelector('.total');

    // Convert the product subtotal and product price values to float numbers
    var subtotal = parseFloat(pst);
    var price = parseFloat(pp);

    // If the value is not a number, set it to 0, otherwise keep the value
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      // Increment the value if it's less than 10
      value++;

      // Calculate the new subtotal and total values and round them to 2 decimal places
      var newSubTotal = Number((subtotal + price).toFixed(2));
      var newTotal = Number((parseFloat(totalInput.value) + price).toFixed(2));

      // Update the quantity value
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);

      // Update the product subtotal value
      var pst = $(this)
        .closest('.product-data')
        .find('.subtotal')
        .val(newSubTotal);

      // Update the text display of the subtotal
      $(this).closest('.product-data').find('.subtotal-text').text(newSubTotal);

      // Update the total value
      totalInput.value = newTotal;

      // Update the text display of the total
      $('.total-text').text(newTotal);
    }
  });

  $(document).on('click', '.decrement-btn-cart', function (e) {
    e.preventDefault();

    //get the quantity value from the closest .product-data parent element
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();

    //parse the quantity to integer
    var value = parseInt(quantity, 10);

    // Get the current product subtotal and product price values
    var pst = $(this).closest('.product-data').find('.subtotal').val(); //product subtotal
    var pp = $(this).closest('.product-data').find('.productPrice').val(); //product price

    // Get the total input element
    const totalInput = document.querySelector('.total');

    //parse the product subtotal value and price to float
    var subtotal = parseFloat(pst);
    var price = parseFloat(pp);

    //check if value is not a number, if yes, set value to 0
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      //if value is greater than 1, decrement the value by 1
      value--;

      //calculate the new subtotal and new total value
      var newSubTotal = Number((subtotal - price).toFixed(2));
      var newTotal = Number((parseFloat(totalInput.value) - price).toFixed(2));

      //set the new quantity value
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);

      //set the new subtotal value
      var pst = $(this)
        .closest('.product-data')
        .find('.subtotal')
        .val(newSubTotal);

      //update the subtotal text
      $(this).closest('.product-data').find('.subtotal-text').text(newSubTotal);

      //set the new total value
      totalInput.value = newTotal;

      //update the total text
      $('.total-text').text(newTotal);
    }
  });
  //increment quantity on button click
  $(document).on('click', '.increment-btn', function (e) {
    e.preventDefault();

    //get quantity value and parse it to integer
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);

    //check if value is not a number, set to 0
    value = isNaN(value) ? 0 : value;

    //increment quantity if value is less than 10
    if (value < 10) {
      value++;

      //update the quantity value
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);
    }
  });

  //decrement quantity on button click
  $(document).on('click', '.decrement-btn', function (e) {
    e.preventDefault();

    //get quantity value and parse it to integer
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);

    //check if value is not a number, set to 0
    value = isNaN(value) ? 0 : value;

    //decrement quantity if value is greater than 1
    if (value > 1) {
      value--;

      //update the quantity value
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);
    }
  });

  $(document).on('click', '.updateQty', function (e) {
    // Get the quantity value from input field with class "input-quantity"
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();

    // Get the product id value from hidden field with id "productID"
    var product_id = $(this).closest('.product-data').find('#productID').val();

    // Send an AJAX POST request to "functions/handleCart.php"
    $.ajax({
      type: 'POST',
      url: 'functions/handleCart.php',
      data: {
        product_id, // send product_id as data
        quantity, // send quantity as data
        scope: 'update', // send scope as data
      },
      success: function (response) {
        // If response is 200, do nothing
        if (response == 200) {
        }
      },
    });
  });

  $(document).on('click', '.deleteItem', function (e) {
    // Get the cart id value from the button value
    var cart_id = $(this).val();

    // Send an AJAX POST request to "functions/handleCart.php"
    $.ajax({
      type: 'POST',
      url: 'functions/handleCart.php',
      data: {
        cart_id, // send cart_id as data
        scope: 'delete', // send scope as data
      },
      success: function (response) {
        // If response is 200, show success notification and reload elements with id "mycart" and "cart"
        if (response == 200) {
          $('#mycart').load(location.href + ' #mycart');
          $('#cart').load(location.href + ' #cart');
          $.notification(['Item removed in cart successfully'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        }
        // If response is not 200, show warning notification with response message
        else {
          $.notification([response], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'warning',
          });
        }
      },
    });
  });

  $(document).on('click', '.addToCart-btn', function (e) {
    // prevent the default behavior of the button
    e.preventDefault();

    // get the quantity value from the closest product-data element
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    // get the product id from the button's value
    var product_id = $(this).val();

    // convert the quantity to a number or default to 1 if the value is falsy
    quantity = Number(quantity);
    quantity = quantity ? quantity : 1;

    // send an AJAX request to `handlecart.php` to add the product to the cart
    $.ajax({
      type: 'POST',
      url: 'functions/handlecart.php',
      data: {
        product_id: product_id,
        quantity: quantity,
        scope: 'add',
      },

      success: function (response) {
        // check if the response is 201, meaning the product was added successfully
        if (response == 201) {
          // show a notification to the user that the product was added successfully
          $.notification(['Product added to cart successfully'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        }
      },
    });
  });

  $(document).on('click', '.addToCartWishlist-btn', function (e) {
    // Prevent the default behavior of the event
    e.preventDefault();

    // Get the `product_id` value of the clicked element
    var product_id = $(this).val();

    // Set the default value of `quantity` to 1
    quantity = 1;

    // Send a POST request to the server using jQuery's `$.ajax()` method
    $.ajax({
      type: 'POST',
      // The URL of the server-side script to be called
      url: 'functions/handlecart.php',
      // The data to be sent to the server
      data: {
        product_id: product_id,
        quantity: quantity,
        scope: 'addWishlist',
      },

      // The callback function to be executed if the request is successful
      success: function (response) {
        if (response == 201) {
          // Reload the content of the elements with the ID `wishlist` and `cart`
          $('#wishlist').load(location.href + ' #wishlist');
          $('#cart').load(location.href + ' #cart');
          // Show a notification to the user indicating that the product has been added to the cart
          $.notification(['Product added to cart successfully'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        } else if (response == 'existing') {
          // Reload the content of the element with the ID `wishlist`
          $('#wishlist').load(location.href + ' #wishlist');
          // Show a notification to the user indicating that the product is already in the cart
          $.notification(['Product is already in cart'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        }
      },
    });
  });

  $(document).on('click', '.addToWishlist-btn', function (e) {
    // Preventing the default behavior of an anchor tag
    e.preventDefault();

    // Get the product ID from the button value
    var product_id = $(this).val();

    // Make an AJAX post request
    $.ajax({
      type: 'POST',
      // Specify the URL for the handling of wishlist
      url: 'functions/handlewishlist.php',
      data: {
        product_id: product_id,
        scope: 'addWishlist',
      },

      // Handle the response of the request
      success: function (response) {
        // If product is added to wishlist successfully
        if (response == 201) {
          // Show a success notification
          $.notification(['Product added to your wishlist'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        }
        // If the product is already in the wishlist
        else if (response == 'existing') {
          // Show an error notification
          $.notification(['Product already in your wishlist'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'error',
          });
        }
        // If there's an error in the request
        else {
          // Show an error notification
          $.notification(['Something went wrong'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'error',
          });
        }
      },
    });
  });

  $(document).on('click', '.deleteItemToWishlist-btn', function (e) {
    // Get the wishlist ID from the button value
    var wishlist_id = $(this).val();

    // Make an AJAX post request
    $.ajax({
      type: 'POST',
      // Specify the URL for the handling of wishlist
      url: 'functions/handlewishlist.php',
      data: {
        wishlist_id,
        scope: 'deleteWishlist',
      },

      // Handle the response of the request
      success: function (response) {
        // If item is removed successfully
        if (response == 200) {
          // Reload the wishlist section
          $('#wishlist').load(location.href + ' #wishlist');
          // Show a success notification
          $.notification(['Item removed in wishlist successfully'], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'success',
          });
        }
        // If there's an error in the request
        else {
          // Show a warning notification with the error message
          $.notification([response], {
            position: ['bottom', 'right'],
            timeView: 3000,
            messageType: 'warning',
          });
        }
      },
    });
  });

  $(document).on('click', '.subscribe-btn', function (e) {
    // Prevent default behavior of the button
    e.preventDefault();

    // Get the value of email input field that is a sibling of the button element
    var email = $(this).closest('.subscribe-data').find('.email').val();

    // Regular expression to check if the email address is valid
    var emailRegex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // Check if the email address is valid
    if (
      emailRegex.test(email) &&
      email.indexOf('@gmail.com') !== -1 &&
      email.endsWith('@gmail.com')
    ) {
      // Check if the email field is not empty
      if (email) {
        // Make ajax post request to the server-side script
        $.ajax({
          type: 'POST',
          url: 'functions/subscribe.php',
          data: {
            email: email,
            subs: true,
          },
          success: function (response) {
            // Check if the server-side script returns success status code
            if (response == 200) {
              // Show success notification
              $.notification(['Email subscribed successfully'], {
                position: ['bottom', 'right'],
                timeView: 3000,
                messageType: 'success',
              });
            } else {
              // TODO: Handle other server-side script response
            }
          },
        });
      }
    } else {
      // Show error notification if the email address is not valid
      $.notification(['Please enter a valid email address'], {
        position: ['bottom', 'right'],
        timeView: 3000,
        messageType: 'error',
      });
    }
  });

  $(document).on('click', '.saveDetails-btn', function (e) {
    e.preventDefault();
    // Collect form data as an object
    var formData = {
      user_id: $('#id').val(),
      name: $('#name').val(),
      phone: $('#phone').val(),
      email: $('#email').val(),
      province: $('#province-select').val(),
      street: $('#street').val(),
      city: $('#city').val(),
      pincode: $('#pincode').val(),
      barangay: $('#barangay').val(),
      bldg_houseno: $('#bldg_houseno').val(),
    };

    // Regex pattern to match valid email
    var emailRegex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // Check if there is any empty field or invalid email
    if (Object.values(formData).some((val) => val === '')) {
      // Show error notification for empty field
      $.notification(['All fields are required'], {
        position: ['bottom', 'right'],
        timeView: 3000,
        messageType: 'error',
      });
    } else if (
      !(
        emailRegex.test(formData.email) && formData.email.endsWith('@gmail.com')
      )
    ) {
      // Show error notification for invalid email
      $.notification(['Please enter a valid email'], {
        position: ['bottom', 'right'],
        timeView: 3000,
        messageType: 'error',
      });
    } else {
      // If all data is valid, send ajax request
      $.ajax({
        type: 'POST',
        url: 'functions/savedetails.php',
        data: {
          ...formData,
          updateDetailsBtn: true,
        },
        success: function (response) {
          if (response == 200) {
            // Show success notification
            $.notification(['Details save successfully'], {
              position: ['bottom', 'right'],
              timeView: 3000,
              messageType: 'success',
            });
          } else {
            // Show error notification
            $.notification(['An error occurred'], {
              position: ['bottom', 'right'],
              timeView: 3000,
              messageType: 'error',
            });
          }
        },
      });
    }
  });
});
