jQuery(function($) {
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

  $('.main-toggle').show();
  
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

  var dropdownLinks = $('.desktop-links .menu > .menu-item-has-children > a');

  dropdownLinks.append('&nbsp;<i class="fa fa-angle-down"></i>');

  $('.mobile-links .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');

  $('.mobile-links .sub-toggle').click(function() {
    $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('fast', 'linear');
    $(this).children('.fa-angle-down').first().removeClass('fa-angle-down').addClass('fa-angle-up');
    $(this).children('.fa-angle-up').first().removeClass('fa-angle-up').addClass('fa-angle-down');
  });
});