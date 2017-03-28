<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

$order = wc_get_order( $order_id );
$order_items = $order->get_items();
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();

if ( $order ) : ?>

<?php if ( ! $order->has_status( 'failed' ) ) : ?>
  <!-- Start else for if order doesn't fail -->
  <h3 class="woocommerce-thankyou-order-received">
    <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you for supporting Women. Your order has been received.', 'woocommerce' ), $order ); ?>
  </h3>

  <h4 class="thankyou-order-number">
    Your order number : <?php echo $order->get_order_number(); ?>
  </h4>

  




  <!-- begin order products -->
  <div class="order-products-wrapper">
    <table class="order-products">

      <!-- Start Loop Here -->
      <!-- Taken from order-details page -->
      <?php
      foreach( $order_items as $item_id => $item ) :
        $product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
      $product_image = $product->get_image();
      $product_price = $product->get_price();
      $product_name = $item['name'];
      $item_quantity = $order->get_item_meta($item_id, '_qty', true);
      $item_total = $order->get_item_meta($item_id, '_line_total', true);
      ?>

      <!-- Work on this first -->
      <tr class="order-product">
        <td class="order-product__image">
          <?php echo $product_image; ?>
        </td>

        <td class="order-product__description">
          <span class="order-product__label">Product</span>
          <span class="order-product__description">
            <?php echo $product_name ?><br>
            <!-- How do I get product variations? -->
            <?php do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

            $order->display_item_meta( $item );
            $order->display_item_downloads( $item );

            do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order ); ?>
          </span>
        </td>

        <td class="order-product__price">
          <span class="order-product__label">Price</span>
          <span class="order-product__amount">
            <?php echo $product_price; ?>
          </span>
        </td>

        <td class="order-product__quantity">
          <span class="order-product__label">Quantity</span>
          <span class="order-product__count">
            <?php echo $item_quantity; ?>
          </span>
        </td>

        <td class="order-product__subtotal">
          <span class="order-product__label">Subtotal</span>
          <span class="order-product__subtotal-amount">
            <?php echo $item_total; ?>
          </span>
        </td>
      </tr>
      <!-- Work on this individual item first -->


    <?php endforeach; ?>
    <!-- end products loop --> 


  </table><!-- .order-products --> 
</div><!-- .order-products-wrapper --> 
<!-- end order details -->




<!-- begin order summary wrapper -->
<div class="order-summary-wrapper">
  <table class="order-summary">
    <tr>
      <th>Subtotal</th>
      <td><?php echo $order->get_subtotal(); ?></td>
    </tr>

    <tr>
      <th>Shipping</th>
      <td><?php echo wc_price($order->get_total_shipping()); ?></td>
    </tr>

    <tr class="order-summary__total">
      <th>Total</th>
      <td><?php echo $order->get_total(); ?></td>
    </tr>

    <?php if ( $order->payment_method_title ) : ?>
      <tr>
        <th>Payment Method</th>
        <td><?php echo $order->payment_method_title; ?></td>
      </tr>
    <?php endif; ?>

    <tr>
      <th>Date</th>
      <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
    </tr>
  </table>

  <a href="<?php echo $shop_page_url ?>" class="button button--primary button--block text--center">Continue Shopping</a>
</div>
<!-- end order summary wrapper -->





<!-- if customer details -->
<?php if ( $show_customer_details ) : ?>
  <div class="customer-details-wrapper">
    <a class="customer-details-open" href="#">
      Your Details <i class="fa fa-angle-down"></i>
    </a>
    <table class="customer-details">
      <?php if ( $order->customer_note ) : ?>
        <tr>
          <th><?php _e( 'Note', 'woocommerce' ); ?></th>
          <td><?php echo wptexturize( $order->customer_note ); ?></td>
        </tr>
      <?php endif; ?>

      <?php if ( $order->billing_email ) : ?>
        <tr>
          <th><?php _e( 'Email', 'woocommerce' ); ?></th>
          <td><?php echo esc_html( $order->billing_email ); ?></td>
        </tr>
      <?php endif; ?>

      <?php if ( $order->billing_phone ) : ?>
        <tr>
          <th><?php _e( 'Telephone', 'woocommerce' ); ?></th>
          <td><?php echo esc_html( $order->billing_phone ); ?></td>
        </tr>
      <?php endif; ?>

      <tr>
        <th>Billing Address</th>
        <td><?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
        </td>
      </tr>

      <tr>
        <th>Shipping Address</th>
        <td><?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?></td>
      </tr>
    </table>

    <a href="<?php echo $shop_page_url ?>" class="button button--primary button--block text--center">Continue Shopping</a>
  </div>
<?php endif; ?>
<!-- endif customer details -->







<!-- else for order has not failed -->
<?php elseif ( $order->has_status( 'failed' ) ) : ?>

  <p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

  <p class="woocommerce-thankyou-order-failed-actions">
    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
    <?php if ( is_user_logged_in() ) : ?>
      <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
    <?php endif; ?>
  </p>

<?php endif; ?>

<?php else : ?>

  <h3 class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you for supporting Women. Your order has been received.', 'woocommerce' ), null ); ?></h3>

<?php endif; ?>
<!-- endif for if $order -->

