<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php
  // do_action( 'storefront_single_post_top' );

  /**
   * Functions hooked into storefront_single_post add_action
   *
   * @hooked storefront_post_header          - 10
   * @hooked storefront_post_meta            - 20
   * @hooked storefront_post_content         - 30
   * @hooked storefront_init_structured_data - 40
   */
  // do_action( 'storefront_single_post' );

  /**
   * Functions hooked in to storefront_single_post_bottom action
   *
   * @hooked storefront_post_nav         - 10
   * @hooked storefront_display_comments - 20
   */
  // do_action( 'storefront_single_post_bottom' );
  ?>

  <header class="entry-header">
    <div class="entry-date"><?php echo get_the_date(); ?></div>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header>

  <div class="entry-content">
    <?php the_content(); ?>
  </div>

  <?php 
    $author_email = get_the_author_meta('user_email');
    $author_image = get_avatar($author_email);
    $author_name = get_the_author_meta('display_name');
  ?>
  <div class="author-info">
    <div class="author__image">
      <?php echo $author_image; ?>
    </div>
    <div class="author__description">
      <p class="author__name"><?php echo $author_name; ?></p>
      <p class="author__email"><?php echo $author_email; ?></p>
    </div>
  </div>

  <?php do_action( 'storefront_post_meta' ); ?>

  <?php 
  /**
   * Functions hooked in to storefront_single_post_bottom action
   *
   * @hooked storefront_post_nav         - 10
   * @hooked storefront_display_comments - 20
   */
  do_action( 'storefront_single_post_bottom' );
  ?>

</div><!-- #post-## -->
