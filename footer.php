<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action( 'storefront_before_footer' ); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="col-full">

    <?php
      /**
       * Functions hooked in to storefront_footer action
       *
       * @hooked storefront_footer_widgets - 10
       * @hooked storefront_credit         - 20
       */
      do_action( 'storefront_footer' ); ?>

    </div><!-- .col-full -->
  </footer><!-- #colophon -->

  <?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>


<script>
   jQuery(document).ready(function($) {
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
    
    $('.site-control--cart')
    .mouseover(function() {
      $(".navigation-cart").show();
    })
    .mouseout(function() {
      $(".navigation-cart").hide();
    });

    $('.site-control--search').click(function(e) {
      e.preventDefault();
      $('.main-search').slideToggle('fast', 'linear');
      $('.mobile-links').slideUp('fast', 'linear');
      $('.site-toggle').removeClass('menu-open');
    });

    $('.main-search__close').click(function(e) {
      e.preventDefault();
      $('.main-search').slideUp('fast', 'linear');
    })

    $('.site-toggle').click(function() {
      $(this).toggleClass('menu-open');
      $('.mobile-links').slideToggle();
      $('.main-search').slideUp('fast', 'linear');
    });

    var dropdownLinks = $('.desktop-links .menu > .menu-item-has-children > a');

    dropdownLinks.append('&nbsp;<i class="fa fa-angle-down"></i>');

    $('.mobile-links .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');

    $('.mobile-links .sub-toggle').click(function() {
      $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('fast', 'linear');
      $(this).children('.fa-angle-down').first().toggleClass('fa-angle-down fa-angle-up');
    });
  });
</script>
</body>
</html>
