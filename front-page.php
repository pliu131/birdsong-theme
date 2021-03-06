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

    <?php 
    $image1 = get_field('home_page_image_1');
    $image2 = get_field('home_page_image_2');
    $image3 = get_field('home_page_image_3');
    $image4 = get_field('home_page_image_4');
    $image5 = get_field('home_page_image_5');

    $imagelink1 = get_field('home_page_image_link_1');
    $imagelink2 = get_field('home_page_image_link_2');
    $imagelink3 = get_field('home_page_image_link_3');
    $imagelink4 = get_field('home_page_image_link_4');
    $imagelink5 = get_field('home_page_image_link_5');

    ?>

    <div class="section section--images">
      <div class="section-text-mobile">
        <?php the_field('home_page_content') ?>
      </div>

      <div class="section__part">
        <?php if ($image1): ?>
          <?php if ($imagelink1) : ?>
            <a href="<?php echo $imagelink1 ?>" class="section__image section__image--square" style="background-image: url(<?php echo $image1['url'] ?>)"></a>
          <?php else: ?>  
            <div class="section__image section__image--square" style="background-image: url(<?php echo $image1['url'] ?>)"></div>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($image2): ?>
          <?php if ($imagelink2) : ?>
            <a href="<?php echo $imagelink2 ?>" class="section__image section__image--rectangle" style="background-image: url(<?php echo $image4['url'] ?>)"></a>
          <?php else: ?>  
            <div class="section__image section__image--rectangle" style="background-image: url(<?php echo $image2['url'] ?>)"></div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div class="section__part section__part--desktop">
        <?php if (get_field('home_page_content')): ?>
          <div class="section__text-wrapper">
            <div class="section__text">
              <?php the_field('home_page_content') ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($image3): ?>
          <?php if ($imagelink3) : ?>
            <a href="<?php echo $imagelink4 ?>" class="section__image section__image--rectangle" style="background-image: url(<?php echo $image3['url'] ?>)"></a>
          <?php else: ?>  
            <div class="section__image section__image--rectangle" style="background-image: url(<?php echo $image3['url'] ?>)"></div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div class="section__part">
        <?php if ($image4): ?>
          <?php if ($imagelink4) : ?>
            <a href="<?php echo $imagelink4 ?>" class="section__image section__image--rectangle" style="background-image: url(<?php echo $image4['url'] ?>)"></a>
          <?php else: ?>  
            <div class="section__image section__image--rectangle" style="background-image: url(<?php echo $image4['url'] ?>)"></div>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($image5): ?>
          <?php if ($imagelink5) : ?>
            <a href="<?php echo $imagelink5 ?>" class="section__image section__image--square" style="background-image: url(<?php echo $image5['url'] ?>)"></a>
          <?php else: ?> 
            <div class="section__image section__image--square" style="background-image: url(<?php echo $image5['url'] ?>)"></div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

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
          <a class="button button--primary" href="<?php site_url(); ?>/about">Discover</a>
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
          <li class="press-item"><a href="http://www.teenvogue.com/gallery/feminist-clothing-brands-2016#2"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-1.png" alt=""></a></li>
          <li class="press-item">
            <a href="http://www.theguardian.com/fashion/2015/nov/04/do-your-clothes-pass-the-feminist-test"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-2.png" alt=""></a>
          </li>
          <li class="press-item">
            <a href="https://i-d.vice.com/en_gb/article/support-fashion-against-funding-cuts-on-international-womens-day"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-3.png" alt=""></a>
          </li>
          <li class="press-item">
            <a href="http://www.dazeddigital.com/fashion/article/28443/1/the-feminists-leading-an-ethical-fashion-revolution"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/press-4.png" alt=""></a>
          </li>
        </ul>
      </div>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
