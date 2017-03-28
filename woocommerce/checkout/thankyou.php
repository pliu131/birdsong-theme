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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : ?>

<?php if ( $order->has_status( 'failed' ) ) : ?>

	<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

	<p class="woocommerce-thankyou-order-failed-actions">
		<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
		<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
		<?php endif; ?>
	</p>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<h3 class="woocommerce-thankyou-order-received">
		<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?>
	</h3>

	<h4 class="thankyou-order-number">
		Your order number : <?php echo $order->get_order_number(); ?>
	</h4>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

	<div class="order-summary-wrapper">
		<table class="order-summary">
			<tr>
				<th>Subtotal</th>
				<td><?php echo wc_price($order->get_subtotal()); ?></td>
			</tr>

			<tr>
				<th>Shipping</th>
				<td><?php echo wc_price($order->get_total_shipping()); ?></td>
			</tr>

			<tr class="order-summary__total">
				<th><?php _e( 'Total', 'woocommerce' ); ?></th>
				<td><?php echo $order->get_formatted_order_total(); ?></td>
			</tr>

			<?php if ( $order->payment_method_title ) : ?>
				<tr>
					<th><?php _e( 'Payment Method', 'woocommerce' ); ?></th>
					<td><?php echo $order->payment_method_title; ?></td>
				</tr>
			<?php endif; ?>

			<tr>
				<th><?php _e( 'Date', 'woocommerce' ); ?></th>
				<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
			</tr>
		</table>

		<?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
		<a href="<?php echo $shop_page_url ?>" class="button button--primary button--block text--center">Continue Shopping</a>
	</div>

	<?php $show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id(); ?>
<?php if ( $show_customer_details ) : ?>
	<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
<?php endif; ?>

<?php endif; ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
