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

function custom_js() {
  wp_enqueue_script( 'imagesLoaded', 'https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.js', array( 'jquery' ));
  wp_enqueue_script( 'masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js', array( 'jquery' ));
  wp_enqueue_script( 'quantity', get_stylesheet_directory_uri() . '/assets/js/quantity.js', array( 'jquery' ));
  wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ));
  wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array( 'jquery' ));
  wp_enqueue_script( 'ajax_add_to_cart', get_stylesheet_directory_uri() . '/assets/js/ajax_add_to_cart.js', array( 'jquery' ));
  wp_localize_script( 'ajax_add_to_cart', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}

add_action('wp_enqueue_scripts', 'ajax_add_to_cart_js');
add_action('wp_enqueue_scripts', 'custom_js');

function my_wc_add_cart_ajax() {
  $product_id = $_POST['product_id'];
  $variation_id = $_POST['variation_id'];
  $quantity = $_POST['quantity'];

  if ($variation_id) {
    WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
  } else {
    WC()->cart->add_to_cart( $product_id, $quantity);
  }
  ?>

  <span class="cart-item-count">
    <?php echo WC()->cart-> get_cart_contents_count() ?>
  </span>

  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/shopping-bag.png" alt="">

  <div class="navigation-cart">
    <div class="navigation-cart__content">
      <a href="#" class="navigation-cart__close">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/icons/close.svg" alt="">
      </a>
      <div class="widget woocommerce widget_shopping_cart">
        <div class="widget_shopping_cart_content">
          <div class="added-to-cart">Item added to cart</div>

          <?php echo wc_get_template( 'cart/mini-cart.php' ); ?>
        </div>
      </div>
    </div>
  </div>
  <?php  die();
}

add_action('wp_ajax_my_wc_add_cart', 'my_wc_add_cart_ajax');
add_action('wp_ajax_nopriv_my_wc_add_cart', 'my_wc_add_cart_ajax'); 



// Taken from Image Flipper
if ( ! class_exists( 'WC_pif' ) ) {
  class WC_pif {

    public function __construct() {
      add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
      add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
    }


    /*-----------------------------------------------------------------------------------*/
    /* Class Functions */
    /*-----------------------------------------------------------------------------------*/

      // Add pif-has-gallery class to products that have a gallery
    function product_has_gallery( $classes ) {
      global $product;

      $post_type = get_post_type( get_the_ID() );

      if ( ! is_admin() ) {

        if ( $post_type == 'product' ) {

          $attachment_ids = $this->get_gallery_image_ids( $product );

          if ( $attachment_ids ) {
            $classes[] = 'pif-has-gallery';
          }
        }

      }

      return $classes;
    }


    /*-----------------------------------------------------------------------------------*/
    /* Frontend Functions */
    /*-----------------------------------------------------------------------------------*/

      // Display the second thumbnails
    function woocommerce_template_loop_second_product_thumbnail() {
      global $product, $woocommerce;

      $attachment_ids = $this->get_gallery_image_ids( $product );

      if ( $attachment_ids ) {
        $attachment_ids     = array_values( $attachment_ids );
        $secondary_image_id = $attachment_ids['0'];
        echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog wp-post-image' ) );
      }
    }


    /*-----------------------------------------------------------------------------------*/
    /* WooCommerce Compatibility Functions */
    /*-----------------------------------------------------------------------------------*/

      // Get product gallery image IDs
    function get_gallery_image_ids( $product ) {
      if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
      }

      if ( is_callable( 'WC_Product::get_gallery_image_ids' ) ) {
        return $product->get_gallery_image_ids();
      } else {
        return $product->get_gallery_attachment_ids();
      }
    }

  }


  $WC_pif = new WC_pif();
}


// Add Custom Fields
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_products',
    'title' => 'Products',
    'fields' => array (
      array (
        'key' => 'field_58d06c4e12a9a',
        'label' => 'Sourcing Details',
        'name' => 'sourcing_details',
        'type' => 'checkbox',
        'choices' => array (
          'made-in-the-uk' => 'Made in the UK',
          'organic' => 'Organic',
          'sustainable-fabric' => 'Sustainable Fabric',
          'vegan' => 'Vegan',
          'limited-edition' => 'Limited Edition',
          ),
        'default_value' => '',
        'layout' => 'vertical',
        ),
      ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'product',
          'order_no' => 0,
          'group_no' => 0,
          ),
        ),
      ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        ),
      ),
    'menu_order' => 0,
    ));
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +

function woo_custom_single_add_to_cart_text() {
  return __( 'Add to Bag', 'woocommerce' );
}

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +

function woo_custom_product_add_to_cart_text() {  
  return __( 'Add to Bag', 'woocommerce' );
}

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_home-page',
    'title' => 'Home Page',
    'fields' => array (
      array (
        'key' => 'field_58d483e450ae0',
        'label' => 'Home Page Image 1',
        'name' => 'home_page_image_1',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'full',
        'library' => 'all',
        ),
      array (
        'key' => 'field_58d484f150ae6',
        'label' => 'Home Page Image 2',
        'name' => 'home_page_image_2',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'full',
        'library' => 'all',
        ),
      array (
        'key' => 'field_58d484f050ae5',
        'label' => 'Home Page Image 3',
        'name' => 'home_page_image_3',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'full',
        'library' => 'all',
        ),
      array (
        'key' => 'field_58d484ee50ae4',
        'label' => 'Home Page Image 4',
        'name' => 'home_page_image_4',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'full',
        'library' => 'all',
        ),
      array (
        'key' => 'field_58d484ec50ae3',
        'label' => 'Home Page Image 5',
        'name' => 'home_page_image_5',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'full',
        'library' => 'all',
        ),
      array (
        'key' => 'field_58d4853f68c72',
        'label' => 'Home Page Content',
        'name' => 'home_page_content',
        'type' => 'wysiwyg',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
        ),
      array (
        'key' => 'field_58d486a33a85b',
        'label' => 'Home Page Image Link 1',
        'name' => 'home_page_image_link_1',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
      array (
        'key' => 'field_58d486c23a85c',
        'label' => 'Home Page Image Link 2',
        'name' => 'home_page_image_link_2',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
      array (
        'key' => 'field_58d486c33a85d',
        'label' => 'Home Page Image Link 3',
        'name' => 'home_page_image_link_3',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
      array (
        'key' => 'field_58d486c53a85e',
        'label' => 'Home Page Image Link 4',
        'name' => 'home_page_image_link_4',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
      array (
        'key' => 'field_58d486c73a85f',
        'label' => 'Home Page Image Link 5',
        'name' => 'home_page_image_link_5',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
        ),
      ),
    'location' => array (
      array (
        array (
          'param' => 'page_type',
          'operator' => '==',
          'value' => 'front_page',
          'order_no' => 0,
          'group_no' => 0,
          ),
        ),
      ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        ),
      ),
    'menu_order' => 0,
    ));
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

  $tabs['description']['title'] = __( 'Makers' );   // Rename the description tab
  // $tabs['reviews']['title'] = __( 'Ratings' );        // Rename the reviews tab
  // $tabs['additional_information']['title'] = __( 'Product Data' );  // Rename the additional information tab

  return $tabs;

}


// Adjust Product Breadcrumbs to use Primary Breadcrumb
// Add product categories to the "Product" breadcrumb in WooCommerce.
 
// Get breadcrumbs on product pages that read: Home > Shop > Product category > Product Name
add_filter( 'woo_breadcrumbs_trail', 'woo_custom_breadcrumbs_trail_add_product_categories', 20 );
 
function woo_custom_breadcrumbs_trail_add_product_categories ( $trail ) {
  if ( ( get_post_type() == 'product' ) && is_singular() ) {
    global $post;
    
    $taxonomy = 'product_cat';
    
    $terms = get_the_terms( $post->ID, $taxonomy );
    $links = array();
 
    if ( $terms && ! is_wp_error( $terms ) ) {
    $count = 0;
      foreach ( $terms as $c ) {
        $count++;
        if ( $count > 1 ) { continue; }
        $parents = woo_get_term_parents( $c->term_id, $taxonomy, true, ', ', $c->name, array() );
 
        if ( $parents != '' && ! is_wp_error( $parents ) ) {
          $parents_arr = explode( ', ', $parents );
          
          foreach ( $parents_arr as $p ) {
            if ( $p != '' ) { $links[] = $p; }
          }
        }
      }
      
      // Add the trail back on to the end.
      // $links[] = $trail['trail_end'];
      $trail_end = get_the_title($post->ID);
 
      // Add the new links, and the original trail's end, back into the trail.
      array_splice( $trail, 2, count( $trail ) - 1, $links );
      
      $trail['trail_end'] = $trail_end;
    }
  }
 
  return $trail;
} // End woo_custom_breadcrumbs_trail_add_product_categories()
 
/**
 * Retrieve term parents with separator.
 *
 * @param int $id Term ID.
 * @param string $taxonomy.
 * @param bool $link Optional, default is false. Whether to format with link.
 * @param string $separator Optional, default is '/'. How to separate terms.
 * @param bool $nicename Optional, default is false. Whether to use nice name for display.
 * @param array $visited Optional. Already linked to terms to prevent duplicates.
 * @return string
 */
 
if ( ! function_exists( 'woo_get_term_parents' ) ) {
function woo_get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
  $chain = '';
  $parent = &get_term( $id, $taxonomy );
  if ( is_wp_error( $parent ) )
    return $parent;
 
  if ( $nicename ) {
    $name = $parent->slug;
  } else {
    $name = $parent->name;
  }
 
  if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
    $visited[] = $parent->parent;
    $chain .= woo_get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
  }
 
  if ( $link ) {
    $chain .= '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $parent->name ) ) . '">'.$parent->name.'</a>' . $separator;
  } else {
    $chain .= $name.$separator;
  }
  return $chain;
} // End woo_get_term_parents()
}

function get_order_details($order_id){

    // 1) Get the Order object
    $order = wc_get_order( $order_id );

    // OUTPUT
    echo '<h3>RAW OUTPUT OF THE ORDER OBJECT: </h3>';
    print_r($order);
    echo '<br><br>';
    echo '<h3>THE ORDER OBJECT (Using the object syntax notation):</h3>';
    echo '$order->order_type: ' . $order->order_type . '<br>';
    echo '$order->id: ' . $order->id . '<br>';
    echo '<h4>THE POST OBJECT:</h4>';
    echo '$order->post->ID: ' . $order->post->ID . '<br>';
    echo '$order->post->post_author: ' . $order->post->post_author . '<br>';
    echo '$order->post->post_date: ' . $order->post->post_date . '<br>';
    echo '$order->post->post_date_gmt: ' . $order->post->post_date_gmt . '<br>';
    echo '$order->post->post_content: ' . $order->post->post_content . '<br>';
    echo '$order->post->post_title: ' . $order->post->post_title . '<br>';
    echo '$order->post->post_excerpt: ' . $order->post->post_excerpt . '<br>';
    echo '$order->post->post_status: ' . $order->post->post_status . '<br>';
    echo '$order->post->comment_status: ' . $order->post->comment_status . '<br>';
    echo '$order->post->ping_status: ' . $order->post->ping_status . '<br>';
    echo '$order->post->post_password: ' . $order->post->post_password . '<br>';
    echo '$order->post->post_name: ' . $order->post->post_name . '<br>';
    echo '$order->post->to_ping: ' . $order->post->to_ping . '<br>';
    echo '$order->post->pinged: ' . $order->post->pinged . '<br>';
    echo '$order->post->post_modified: ' . $order->post->post_modified . '<br>';
    echo '$order->post->post_modified_gtm: ' . $order->post->post_modified_gtm . '<br>';
    echo '$order->post->post_content_filtered: ' . $order->post->post_content_filtered . '<br>';
    echo '$order->post->post_parent: ' . $order->post->post_parent . '<br>';
    echo '$order->post->guid: ' . $order->post->guid . '<br>';
    echo '$order->post->menu_order: ' . $order->post->menu_order . '<br>';
    echo '$order->post->post_type: ' . $order->post->post_type . '<br>';
    echo '$order->post->post_mime_type: ' . $order->post->post_mime_type . '<br>';
    echo '$order->post->comment_count: ' . $order->post->comment_count . '<br>';
    echo '$order->post->filter: ' . $order->post->filter . '<br>';
    echo '<h4>THE ORDER OBJECT (again):</h4>';
    echo '$order->order_date: ' . $order->order_date . '<br>';
    echo '$order->modified_date: ' . $order->modified_date . '<br>';
    echo '$order->customer_message: ' . $order->customer_message . '<br>';
    echo '$order->customer_note: ' . $order->customer_note . '<br>';
    echo '$order->post_status: ' . $order->post_status . '<br>';
    echo '$order->prices_include_tax: ' . $order->prices_include_tax . '<br>';
    echo '$order->tax_display_cart: ' . $order->tax_display_cart . '<br>';
    echo '$order->display_totals_ex_tax: ' . $order->display_totals_ex_tax . '<br>';
    echo '$order->display_cart_ex_tax: ' . $order->display_cart_ex_tax . '<br>';
    echo '$order->formatted_billing_address->protected: ' . $order->formatted_billing_address->protected . '<br>';
    echo '$order->formatted_shipping_address->protected: ' . $order->formatted_shipping_address->protected . '<br><br>';
    echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br><br>';

    // 2) Get the Order meta data
    $order_meta = get_post_meta($order_id);

    echo '<h3>RAW OUTPUT OF THE ORDER META DATA (ARRAY): </h3>';
    print_r($order_meta);
    echo '<br><br>';
    echo '<h3>THE ORDER META DATA (Using the array syntax notation):</h3>';
    echo '$order_meta[_order_key][0]: ' . $order_meta[_order_key][0] . '<br>';
    echo '$order_meta[_order_currency][0]: ' . $order_meta[_order_currency][0] . '<br>';
    echo '$order_meta[_prices_include_tax][0]: ' . $order_meta[_prices_include_tax][0] . '<br>';
    echo '$order_meta[_customer_user][0]: ' . $order_meta[_customer_user][0] . '<br>';
    echo '$order_meta[_billing_first_name][0]: ' . $order_meta[_billing_first_name][0] . '<br><br>';
    echo 'And so on ……… <br><br>';
    echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br><br>';

    // 3) Get the order items
    $items = $order->get_items();

    echo '<h3>RAW OUTPUT OF THE ORDER ITEMS DATA (ARRAY): </h3>';

    foreach ( $items as $item_id => $item_data ) {

        echo '<h4>RAW OUTPUT OF THE ORDER ITEM NUMBER: '. $item_id .'): </h4>';
        print_r($item);
        echo '<br><br>';
        echo 'Item ID: ' . $item_id. '<br>';
        echo '$item["product_id"] <i>(product ID)</i>: ' . $item['product_id'] . '<br>';
        echo '$item["name"] <i>(product Name)</i>: ' . $item['name'] . '<br>';

        // Using get_item_meta() method
        echo 'Item quantity <i>(product quantity)</i>: ' . $order->get_item_meta($item_id, '_qty', true) . '<br><br>';
        echo 'Item line total <i>(product quantity)</i>: ' . $order->get_item_meta($item_id, '_line_total', true) . '<br><br>';
        echo 'And so on ……… <br><br>';
        echo '- - - - - - - - - - - - - <br><br>';
    }
    echo '- - - - - - E N D - - - - - <br><br>';
}
?>