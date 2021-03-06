<div class="desktop-navigation-wrapper">
  <?php do_action( 'storefront_skip_links' ); ?>

  <div class="site-branding">    
    <a href="<?php echo get_home_url() ?>"><img class="site-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-desktop.svg" alt=""></a>
  </div>      

  <nav id="site-navigation" class="site-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
    <?php
    wp_nav_menu(
      array(
        'theme_location'  => 'primary',
        'container_class' => 'desktop-links',
        )
      );
      ?>
    </nav><!-- #site-navigation -->

    <?php 
    global $woocommerce; 
    $cart_url = $woocommerce->cart->get_cart_url();
    ?>

    <?php // get_template_part('templates/dropdown-cart') ?>

    <div class="site-controls">
      <!-- Still want to update this -->
      <a id="cart-button" class="site-control site-control--cart" href="<?php echo $cart_url ?>" title="Checkout">
        <?php $cart_item_count = WC()->cart-> get_cart_contents_count() ?>
        <?php if ($cart_item_count > 0) : ?>
          <span class="cart-item-count">
            <?php echo $cart_item_count; ?>
          </span>
        <?php endif; ?>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/shopping-bag.svg" alt="">

        <div class="navigation-cart">
          <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
        </div>
      </a>

      <a class="site-control site-control--search" href="#" title="Search"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/search.svg" alt=""></a>

    </div>
</div><!-- .desktop-navigation -->