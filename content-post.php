<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<!-- <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> -->

  <?php
  /**
   * Functions hooked in to storefront_loop_post action.
   *
   * @hooked storefront_post_header          - 10
   * @hooked storefront_post_meta            - 20
   * @hooked storefront_post_content         - 30
   * @hooked storefront_init_structured_data - 40
   */
  // do_action( 'storefront_loop_post' );
  ?>

<!-- </article> -->
<!-- #post-## -->

<article class="masonry-post">
  <?php if (has_post_thumbnail()) : ?>
    <a class="masonry-post__image" href="#">
      <?php the_post_thumbnail('large'); ?>
    </a>
  <?php endif; ?>

  <div class="masonry-post__date"><?php echo get_the_date(); ?></div>
  <h2 class="masonry-post__title">
    <a href="<?php the_permalink(); ?>" class="masonry-post__link"><?php the_title(); ?></a>
  </h2>
</article>
