<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
	?>

	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary">
			<div class="summary__content">
				<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
		</div><!-- .summary__content --> 
		
		
		<?php
		$field = get_field_object('sourcing_details');
		$sourcing_details = $field['value'];

		if( $sourcing_details ): ?>

		<ul class="sourcing-details">
			<?php foreach( $sourcing_details as $sourcing_detail ): ?>
				<li class="sourcing-detail">
					<div class="sourcing-detail__icon">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/sourcing-icons/<?php echo $sourcing_detail ?>.png" alt="">
					</div>
					
					<div class="sourcing-detail__text">
						<?php echo $field['choices'][$sourcing_detail]; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	<div class="summary__additional">
		<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div><!-- .summary__additional --> 

</div><!-- .summary -->

<div class="after-single-product">
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
