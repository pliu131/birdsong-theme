jQuery(function($) {
  function loadingButton() {
    $('.single_add_to_cart_button').html("Adding to bag...").css({
      "background-color" : "black",
      "border-color" : "black",
      "color": "white"
    });
  }

  function changeBagButton(callback) {
    $(".single_add_to_cart_button").html('Added to bag').css({
      "background-color" : "black",
      "border-color" : "black",
      "color": "white"
    });

    if (callback) {
      callback();
    }
  }

  function changeBagButtonBack() {
    setTimeout(function(){
      $(".single_add_to_cart_button").html('Add to bag').css({
        "background-color" : "#fa6560",
        "border-color" : "#fa6560",
        "color": "white"
      });
    }, 3000);
  }

  function attachCloseButton() {
    $('.navigation-cart__close').click(function(e) {
      e.preventDefault();
      $('.navigation-cart').removeAttr( "style" );
      $('.added-to-cart').remove();
      $(this).remove();
    });
  }

  $(".single_add_to_cart_button").click(function(e) {
    e.preventDefault();
    loadingButton();

    var product_id = $('input[name="add-to-cart"]').val();
    var variation_id = $('input[name="variation_id"]').val();
    var quantity = $('input[name="quantity"]').val();

    $('#cart-button').empty();
    $('#cart-button-mobile').empty();

    // For testing
    // changeBagButton(changeBagButtonBack);
    // $('.navigation-cart').fadeIn('fast', 'linear');
    // attachCloseButton();
    

    if (variation_id != '') {
      $.ajax ({
        url: my_ajax_object.ajax_url,
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,
        success: function(results) {
          changeBagButton(changeBagButtonBack);
          $('#cart-button').append(results);
          $('#cart-button-mobile').append(results);
          $('.navigation-cart').fadeIn('fast', 'linear');
          attachCloseButton()
        }
      });
    } else {
      $.ajax ({
        url: my_ajax_object.ajax_url,  
        type:'POST',
        data:'action=my_wc_add_cart&product_id=' + product_id + '&quantity=' + quantity,
        success:function(results) {
          changeBagButton(changeBagButtonBack);
          $('#cart-button').append(results);
          $('#cart-button-mobile').append(results);
          $('.navigation-cart').fadeIn('fast', 'linear');
          attachCloseButton()
        }
      });
    }
  });
});