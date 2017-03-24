jQuery(function($) {
  $(".single_add_to_cart_button").click(function(e) {
    e.preventDefault();

    var product_id = $('input[name="add-to-cart"]').val();
    var variation_id = $('input[name="variation_id"]').val();
    var quantity = $('input[name="quantity"]').val();

    $('.widget_shopping_cart_content').empty();

    if (variation_id != '') {
      $.ajax ({
        url: my_ajax_object.ajax_url,
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,
        success: function(results) {
          $('.navigation-cart').fadeIn('fast', 'linear');
          $('.widget_shopping_cart_content').append(results);

       }
     });
    } else {
      $.ajax ({
        url: my_ajax_object.ajax_url,  
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&quantity=' + quantity,
        success:function(results) {
          $('.navigation-cart').fadeIn('fast', 'linear');
          $('.widget_shopping_cart_content').append(results);
        }
      });
    }
  })
});