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

    <div class="shipping">
      <div class="shipping__info">
        <h2 class="shipping__location">FREE SHIPPING FOR UK ORDERS</h2>
        <div class="shipping__price">£0</div>
        <div class="shipping__service">MyHermes courier service</div>
        <div class="shipping__time">Up to 4 working days from the date of shipping.</div>
      </div>

      <div class="shipping__info">
        <h2 class="shipping__location">Europe</h2>
        <div class="shipping__price">£5</div>
        <div class="shipping__service">Royal Mail</div>
        <div class="shipping__time">Up to 7 working days from the date of shipping. Customs charges may apply.</div>
      </div>

      <div class="shipping__info">
        <h2 class="shipping__location">Rest of World</h2>
        <div class="shipping__price">£9</div>
        <div class="shipping__service">Royal Mail</div>
        <div class="shipping__time">Up to 14 working days from the date of shipping. Customs charges may apply.</div>
      </div>
    </div>


    <p>We aim to ship all orders within two working days. If your item has been backordered, it will be shipped within two working days of your piece being made.</p>

    <p>Some of our items are shipped from Birdsong HQ in London, but many are shipped directly from the makers. Please be aware that if you are ordering multiple items they may arrive separately as they might be shipped from different locations. You will not be charged extra for shipping.</p>

    <p>If you have any problems receiving your order please contact support@birdsong.london.</p>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
