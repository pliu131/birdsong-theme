<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>

<script>
	$(document).ready(function() {
		$('.product-images').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  dots: true,
		  arrows: true,
		  asNavFor: '.product-thumbnails'
		});

		$('.product-thumbnails').slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  asNavFor: '.product-images',
		  focusOnSelect: true
		});
	});
</script>


<div class="product-images-wrapper">
	<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	global $post, $product, $woocommerce;

	$attachment_ids = $product->get_gallery_attachment_ids();
	?>

	<?php if ( $attachment_ids ) : ?>

	<!-- Big Images -->
	<div class="product-images">
	<?php
		foreach ( $attachment_ids as $attachment_id ) :
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) :
				continue;
			endif;
		?>

		<div class="product-image">
			<?php 
				echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $props );
			?>
		</div>
 
		<?php endforeach; ?>
	</div><!-- .main-images --> 


	<!-- Thumbnail Images Navigation -->
	<div class="product-thumbnails">
	<?php
		foreach ( $attachment_ids as $attachment_id ) :
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) :
				continue;
			endif;
		?>

		<div class="product-thumbnail">
		<?php 
			echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props );
		?>
		</div>

		<?php endforeach; ?>
	</div><!-- .thumbnails --> 

	<?php endif; ?>


</div><!-- .images-wrapper --> 


<!-- Add this code as a backup -->
<?php 
	// if ( has_post_thumbnail() ) {
	// 	$attachment_count = count( $product->get_gallery_attachment_ids() );
	// 	$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
	// 	$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
	// 	$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
	// 		'title'	 => $props['title'],
	// 		'alt'    => $props['alt'],
	// 		) );
	// 	echo apply_filters(
	// 		'woocommerce_single_product_image_html',
	// 		sprintf(
	// 			'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
	// 			esc_url( $props['url'] ),
	// 			esc_attr( $props['caption'] ),
	// 			$gallery,
	// 			$image
	// 			),
	// 		$post->ID
	// 		);
	// } else {
	// 	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
	// }
	?>