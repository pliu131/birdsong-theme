jQuery(document).ready(function($){
        // This button will increment the value
        $('.qty-button--plus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment only if value is < 20
                if (currentVal < 20)
                {
                  $('input[name='+fieldName+']').val(currentVal + 1);
                  $('.qty-button--minus').val("-").removeAttr('style');
                }
                else
                {
                  $('.qty-button--plus').val("+").css('color','#aaa');
                  $('.qty-button--plus').val("+").css('cursor','not-allowed');
                }
              } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(1);

              }
            });
    // This button will decrement the value till 0
    $(".qty-button--minus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one only if value is > 1
            $('input[name='+fieldName+']').val(currentVal - 1);
            $('.qty-button--plus').val("+").removeAttr('style');
          } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
            $('.qty-button--minus').val("-").css('color','#aaa');
            $('.qty-button--minus').val("-").css('cursor','not-allowed');
          }
        });
  });



