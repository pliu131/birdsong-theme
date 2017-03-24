<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
  wp_dequeue_style( 'storefront-style' );
  wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

// Remove Default Sorting
add_action('init','delay_remove');

function delay_remove() {
  remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}

// Remove Sidebar
add_action( 'get_header', 'remove_storefront_sidebar' );
function remove_storefront_sidebar() {
  remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
}

// Display 6 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

// Add widget area for product filters
function product_filters_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Product Filters', 'product_filters' ),
    'id' => 'product-filters',
    'before_widget' => '<div class="product-filter__section">',
    'after_widget' => '</div>',
    'before_title' => '<h1>',
    'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'product_filters_widgets_init' );


/**
------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
/**
 * @snippet       WooCommerce/Storefront Change Number of Related Products
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=17473
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 2.5.3, Storefront 1.6.1
 */

// Change number related products for Storefront theme

add_filter( 'woocommerce_output_related_products_args', 'bbloomer_change_number_related_products_storefront', 11 );

function bbloomer_change_number_related_products_storefront( $args ) {

 $args['posts_per_page'] = 4; // # of related products
 $args['columns'] = 4; // # of columns per row
 return $args;
}

// https://wppatrickk.com/woocommerce-add-cart-ajax-single-product-page/
// Ajax Single Product Add to Cart
// Enqueue Script
function ajax_add_to_cart_js() {
  wp_enqueue_script( 'ajax_add_to_cart', get_stylesheet_directory_uri() . '/assets/js/ajax_add_to_cart.js', array( 'jquery' ), '1.0', true );

  wp_localize_script( 'ajax_add_to_cart', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('wp_enqueue_scripts', 'ajax_add_to_cart_js');

function my_wc_add_cart_ajax() {
  $product_id = $_POST['product_id'];
  $variation_id = $_POST['variation_id'];
  $quantity = $_POST['quantity'];

  if ($variation_id) {
    WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
  } else {
    WC()->cart->add_to_cart( $product_id, $quantity);
  }

  $items = WC()->cart->get_cart(); ?>

  <h4>Shopping Bag</h4>

  <?php foreach($items as $item => $values) { 
    $_product = $values['data']->post; ?>

    <div class="dropdown-cart-wrap">
      <div class="dropdown-cart-left">
        <?php echo get_the_post_thumbnail( $values['product_id'], 'thumbnail' ); ?>
      </div>

      <div class="dropdown-cart-right">
        <h5><?php echo $_product->post_title; ?></h5>
        <p>Quantity: <?php echo $values['quantity']; ?></p>
        <p>Price: £ <?php echo get_post_meta($values['product_id'] , '_price', true); ?></p>
      </div>

      <div class="clear"></div>
    </div>
    <?php } ?>

    <div class="dropdown-cart-wrap">
      <div class="dropdown-cart-left">
        <h6>Subtotal</h6>
      </div>

      <div class="dropdown-cart-right">
        <h6><?php echo WC()->cart->get_cart_total(); ?></h6>
      </div>

      <div class="clear"></div>
    </div>

    <div class="dropdown-cart-wrap dropdown-cart-last">
      <div class="dropdown-cart-left dropdown-cart-link">
        <a href="/cart/">View Basket</a>
      </div>

      <div class="dropdown-cart-right dropdown-checkout-link">
        <a href="/checkout/">Checkout</a>
      </div>

      <div class="clear"></div>
    </div>

    <?php die();
  }

  add_action('wp_ajax_my_wc_add_cart', 'my_wc_add_cart_ajax');
  add_action('wp_ajax_nopriv_my_wc_add_cart', 'my_wc_add_cart_ajax'); 

  ?>