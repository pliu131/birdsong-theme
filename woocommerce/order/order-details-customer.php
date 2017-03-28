<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
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
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

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

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

		<tr>
			<th><?php _e( 'Billing Address', 'woocommerce' ); ?></th>
			<td><?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?></td>
		</tr>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
			<tr>
				<th><?php _e( 'Shipping Address', 'woocommerce' ); ?></th>
				<td><?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?></td
					>
				</tr>
			<?php endif; ?>
		</table>

		<?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
		<a href="<?php echo $shop_page_url ?>" class="button button--primary button--block text--center">Continue Shopping</a>
	</div>
