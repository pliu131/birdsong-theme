<div class="mobile-navigation-wrapper">
  <nav id="site-navigation" class="site-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
    <div class="mobile-navigation-header">
      <div class="site-toggle">
        <button class="site-toggle" aria-controls="site-navigation" aria-expanded="false">
          <span>
          </span>
        </button>
      </div><!-- .site-toggle --> 

      <div class="site-branding">
        <a href="<?php echo get_home_url() ?>"><img class="site-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-mobile.svg" alt="">
        </a>
      </div>
      
      <?php 
        global $woocommerce; 
        $cart_url = $woocommerce->cart->get_cart_url();
      ?>
      <div class="site-controls">
        <a href="<?php echo $cart_url ?>" class="site-control"><i class="fa fa-shopping-bag"></i></a>

        <a class="site-control site-control--search" href="#"><i class="fa fa-search"></i></a>
      </div>
    </div><!-- .mobile-navigation-header --> 
  </nav>
</div>

<?php 
wp_nav_menu(
  array(
    'theme_location'  => 'handheld',
    'container_class' => 'mobile-links',
    )
  ); 
  ?>