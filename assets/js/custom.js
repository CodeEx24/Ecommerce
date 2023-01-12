$(document).ready(function () {
  $('.increment-btn').click(function (e) {
    e.preventDefault();

    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);
    }
  });

  $('.decrement-btn').click(function (e) {
    e.preventDefault();

    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);
    }
  });

  $('.addToCart-btn').click(function (e) {
    e.preventDefault();
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var product_id = $(this).val();

    $.ajax({
      type: 'POST',
      url: 'functions/handlecart.php',
      data: {
        product_id: product_id,
        quantity: quantity,
        scope: 'add',
      },

      success: function (response) {
        if (response == 201) {
          alertify.success('Product Added To Cart');
        } else if (response == 'wew') {
          alertify.success('Product already in cart');
        } else if (response == 401) {
          alertify.error('Login To Continue');
        } else if (response == 500) {
          alertify.error('Something went wrong');
        }
      },
    });
  });
});
