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
?>