<?php if ( storefront_is_woocommerce_activated() ) : ?>
  <div class="main-search">
    <div class="main-search__content">
      <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>

      <button class="main-search__close" type="button"><i class="fa fa-close"></i></button>
    </div><!-- .main-search-content --> 
  </div><!-- .main-search --> 
<?php endif; ?>