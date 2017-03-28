<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="order-product">
	<td class="order-product__image"><?php echo $product->get_image(); ?></td>
	
	<td class="order-product__description">
		<span class="order-product__label">Product</span>
		<span class="order-product__name">
			<?php echo $item['name']; ?>
			<?php do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			$order->display_item_meta( $item );
			$order->display_item_downloads( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order ); ?>
		</span>
	</td>

	<td class="order-product__price">
    <span class="order-product__label">Price</span>
    <span class="order-product__amount">
      <?php echo wc_price($product->price); ?>
    </span>
  </td>

	<td class="order-product__quantity">
    <span class="order-product__label">Quantity</span>
    <span class="order-product__count">
      <?php echo $item['qty']; ?>
    </span>
  </td>

  <td class="order-product__subtotal">
    <span class="order-product__label">Subtotal</span>
    <span class="order-product__subtotal-amount">
      <?php echo $order->get_formatted_line_subtotal( $item ); ?>
    </span>
  </td>
</tr>
