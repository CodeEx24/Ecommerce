$(document).ready(function () {
  $(document).on('click', '.addToCart-btn', function (e) {
    e.preventDefault();
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var product_id = $(this).val();

    quantity = Number(quantity);
    quantity = quantity ? quantity : 1;

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
        } else if (response == 'existing') {
          alertify.error('Product already in cart');
        } else if (response == 401) {
          alertify.error('Login To Continue');
        } else if (response == 500) {
          alertify.error('Something went wrong');
        }
      },
    });
  });

  $(document).on('click', '.increment-btn-cart', function (e) {
    e.preventDefault();

    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);

    var pst = $(this).closest('.product-data').find('.subtotal').val(); //product subtotal
    var pp = $(this).closest('.product-data').find('.productPrice').val(); //product price
    const totalInput = document.querySelector('.total');

    var subtotal = parseFloat(pst);
    var price = parseFloat(pp);

    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      var newSubTotal = Number((subtotal + price).toFixed(2));
      var newTotal = Number((parseFloat(totalInput.value) + price).toFixed(2));

      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);

      var pst = $(this)
        .closest('.product-data')
        .find('.subtotal')
        .val(newSubTotal);
      totalInput.value = newTotal;
    }
  });

  $(document).on('click', '.decrement-btn-cart', function (e) {
    e.preventDefault();

    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();
    var value = parseInt(quantity, 10);

    var pst = $(this).closest('.product-data').find('.subtotal').val(); //product subtotal
    var pp = $(this).closest('.product-data').find('.productPrice').val(); //product price
    const totalInput = document.querySelector('.total');

    var subtotal = parseFloat(pst);
    var price = parseFloat(pp);

    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      var newSubTotal = Number((subtotal - price).toFixed(2));
      var newTotal = Number((parseFloat(totalInput.value) - price).toFixed(2));

      var quantity = $(this)
        .closest('.product-data')
        .find('.input-quantity')
        .val(value);
      var pst = $(this)
        .closest('.product-data')
        .find('.subtotal')
        .val(newSubTotal);
      totalInput.value = newTotal;
    }
  });

  $(document).on('click', '.increment-btn', function (e) {
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

  $(document).on('click', '.decrement-btn', function (e) {
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

  $(document).on('click', '.updateQty', function () {
    var quantity = $(this)
      .closest('.product-data')
      .find('.input-quantity')
      .val();

    var product_id = $(this).closest('.product-data').find('#productID').val();

    $.ajax({
      type: 'POST',
      url: 'functions/handleCart.php',
      data: {
        product_id,
        quantity,
        scope: 'update',
      },
      success: function (response) {
        if (response == 200) {
        }
      },
    });
  });

  $(document).on('click', '.deleteItem', function () {
    var cart_id = $(this).val();

    $.ajax({
      type: 'POST',
      url: 'functions/handleCart.php',
      data: {
        cart_id,
        scope: 'delete',
      },
      success: function (response) {
        if (response == 200) {
          alertify.success('Item removed in cart successfully.');
          $('#mycart').load(location.href + ' #mycart');
        } else {
          alertify.error(response);
        }
      },
    });
  });
});
