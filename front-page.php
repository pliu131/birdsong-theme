<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <!-- Need to add in carousel here! -->


    <?php while ( have_posts() ) : the_post();
    get_template_part( 'content', 'page' );
    endwhile;?>

    <!-- About section -->
    <div class="section section--about text--center">
      <div class="section__content">
        <p>
          Birdsong is an emerging fashion brand for people who expect more from their wardrobe.
        </p>

        <p>
          We find the best makers from women's groups and bring them to you, with a promise of no sweatshops &amp; no photoshop.
        </p>
      </div>
    </div>

    <!-- Makers Section -->
    <div class="section section--makers">
      <div class="section__content">
        <div class="section__part section__part--mobile">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/maker-1.jpg" alt="">
          <img class="image-mobile" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/maker-2.jpg" alt="">
        </div>
        <div class="section__part section__part--text">
          <h3>Find out more about our makers</h3>
          <a class="button button--primary" href="<?php site_url( "/about" ); ?>">Discover</a>
        </div>
        <div class="section__part">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/maker-2.jpg" alt="">
        </div>
      </div><!-- .section__content --> 
    </div>

    <div class="section section--press">
      <div class="section__content">
        <h4>As seen in</h4>
        <ul class="press-items">
          <li class="press-item"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-1.png" alt=""></li>
          <li class="press-item"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-2.png" alt=""></li>
          <li class="press-item"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-3.png" alt=""></li>
          <li class="press-item"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-4.png" alt=""></li>
        </ul>
      </div>
    </div>



  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();