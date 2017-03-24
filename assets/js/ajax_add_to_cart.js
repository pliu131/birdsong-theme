jQuery(function($) {
  $(".single_add_to_cart_button").click(function(e) {
    e.preventDefault();

    var product_id = $('input[name="add-to-cart"]').val();
    var variation_id = $('input[name="variation_id"]').val();
    var quantity = $('input[name="quantity"]').val();

    $('.site-control--cart').empty();

    if (variation_id != '') {
      $.ajax ({
        url: my_ajax_object.ajax_url,
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,
        success: function(results) {
          $('.site-control--cart').append(results);
          $('.navigation-cart').fadeIn('fast', 'linear').next().delay(3000).fadeOut();
          $('.single_add_to_cart_button').html('Added to bag').next().delay(1000).html('Add to basket');
        }
      });
    } else {
      $.ajax ({
        url: my_ajax_object.ajax_url,  
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&quantity=' + quantity,
        success:function(results) {
          $('.site-control--cart').append(results);
          $('.navigation-cart').fadeIn('fast', 'linear').next().delay(3000).fadeOut('fast', 'linear');
          $('.single_add_to_cart_button').html('Added to bag').next().delay(1000).html('Add to basket');
        }
      });
    }
  })
});