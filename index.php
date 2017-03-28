<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div id="masonry-grid">
    <?php echo do_shortcode('[ajax_load_more id="masonry-post-container" container_type="div" css_classes="masonry-posts" post_type="post" posts_per_page="10" button_label="Load More"]'); ?>
    </div>

    <!-- <div id="masonry-post-container"> -->
      <?php 
      // if ( have_posts() ) :

      // get_template_part( 'loop' );

      // else :

      //   get_template_part( 'content', 'none' );

      // endif; 
      ?>

    <!-- </div> -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
