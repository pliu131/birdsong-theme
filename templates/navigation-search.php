<?php if ( storefront_is_woocommerce_activated() ) : ?>
  <div class="main-search">
    <div class="main-search__content">
      <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>

      <button class="main-search__close" type="button"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/close.svg" alt=""></button>
    </div><!-- .main-search-content --> 
  </div><!-- .main-search --> 
<?php endif; ?>