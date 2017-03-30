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
    <header>
      <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/the-nest-banner.png" alt="">
    </header>

    <?php 
    if ( have_posts() ) : ?>
    <!-- create a widgetized area? -->
    <?php
      if( $terms = get_terms( 'category', 'orderby=name' ) ) :
    ?>
    <ul class="post-filters">
      <li class="post-filter post-filter--title"><span>Sort Blog:</span></li>
      <li class="post-filter active">
        <a href="#" 
          data-post-type="post" 
          data-posts-per-page="10" 
          data-scroll="false" 
          data-button-label="Load More"
          data-id="masonry-post-container"
          data-container-type="div" 
          css-classes="masonry-posts" 
          post-type="post" 
          posts_per_page="10" 
          button_label="Load More" 
          scroll="false">All</a>
      </li>

    <?php foreach ( $terms as $term ) : ?>
      <?php 
        $post_category = $term->name;
        $post_category_filter = $term->slug;

       ?>
      <li class="post-filter">
        <a href="#" 
          data-category="<?php echo $post_category_filter ?>"
          data-post-type="post" 
          data-posts-per-page="10" 
          data-scroll="false" 
          data-button-label="Load More"
          data-id="masonry-post-container"
          data-container-type="div" 
          css-classes="masonry-posts" 
          post-type="post" 
          posts_per_page="10" 
          button_label="Load More" 
          scroll="false"
        ><?php echo $post_category ?></a>
      </li>
    <?php endforeach; ?>

    </ul>
    <?php endif; ?>


    <div id="masonry-grid">
      <?php echo do_shortcode('[ajax_load_more id="masonry-post-container" container_type="div" css_classes="masonry-posts" post_type="post" posts_per_page="10" button_label="Load More" scroll="false"]'); ?>
    </div>

    <?php 
      else :
        get_template_part( 'content', 'none' );
      endif; 
    ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
