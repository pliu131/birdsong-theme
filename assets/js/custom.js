jQuery(function($) {
  var masonryInit = true; // set Masonry init flag

  $.fn.almComplete = function(alm){ // Ajax Load More callback function
    var container = $('#masonry-grid .masonry-posts');
    if(masonryInit){ // initialize Masonry only once
      masonryInit = false;
    
      container.masonry({
        itemSelector: '.masonry-post',
        columnWidth: '.masonry-post',
        percentPosition: true,
        fitWidth: true               
      });
    } else {
      container.masonry('reloadItems'); // Reload masonry items after callback
    }
    
    container.imagesLoaded( function() { // When images are loaded, fire masonry again.
      container.masonry();
    });
  }
});

// $(function() {
//   var masonryInit = true; // set Masonry init flag
//   $.fn.almComplete = function(alm){ // Ajax Load More callback function
//     if($('#masonry-grid').length){
//       var $container = $('#masonry-grid .masonry-posts'); // our container
//       if(masonryInit){
//         // initialize Masonry only once
//         masonryInit = false;
//         $container.masonry({
//           itemSelector: '.masonry-post',
//           columnWidth: '.masonry-post',
//           percentPosition: true,
//           fitWidth: true
//         });         
//       }else{
//           $container.masonry('reloadItems'); // Reload masonry items after callback
//         }
//       $container.imagesLoaded( function() { // When images are loaded, fire masonry again.
//         $container.masonry();
//       });
//     }
//   };
// })(jQuery);

jQuery(function($) {
  // Checkout Page
  $('.customer-details-open').click(function(e) {
    e.preventDefault();
    $(this).parent('.customer-details-wrapper').children('.customer-details').slideToggle('fast', 'linear');
    $("i", this).toggleClass("fa-angle-down fa-angle-up");
  });

  // Breadcrumb Replacement
  $('.single-product .yoast-breadcrumb span').each(function() {
    var text = $(this).text();
    $(this).text(text.replace('Products', 'Shop')); 
  });

  // Product Filters JS
  $('.berocket_aapf_widget_update_button').click(function() {
    $(this).parents('.product-filter').slideUp('fast', 'linear');
  });

  $('.product-filter__open').click(function() {
    $('.product-filter').slideToggle('fast', 'linear');
  });

  $('.product-filter__close').click(function() {
    $('.product-filter').slideToggle('fast', 'linear');
  });

  $('.product-filter__clear').click(function() {
    $('.product-filter').find('input[type=checkbox]:checked').removeAttr('checked');
  });

  // For whatever reason, this keeps getting hidden
  $('.main-toggle').show();
  
  // Product Thumbnails
  $('.product-images').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    asNavFor: '.product-thumbnails'
  });

  $('.product-thumbnails').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.product-images',
    focusOnSelect: true
  });

  $('.site-control--search').click(function(e) {
    e.preventDefault();
    $('.main-search').slideToggle('fast', 'linear');
    $('.mobile-links').slideUp('fast', 'linear');
    $('.main-toggle').removeClass('menu-open');
  });

  $('.main-search__close').click(function(e) {
    e.preventDefault();
    $('.main-search').slideUp('fast', 'linear');
  })

  $('.main-toggle').click(function() {
    $(this).toggleClass('menu-open');
    $('.mobile-links').slideToggle();
    $('.main-search').slideUp('fast', 'linear');
  });

  $('.mobile-links .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');

  
  $('.mobile-links .sub-toggle').click(function() {
    $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('fast', 'linear');
    $("i", this).toggleClass("fa-angle-down fa-angle-up");
  });
});