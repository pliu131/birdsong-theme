<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <div id="page" class="hfeed site">
    <?php
    do_action( 'storefront_before_header' ); ?>

    <header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
      <div class="col-full">
        <?php get_template_part('templates/mobile-navigation') ?>

        <?php get_template_part('templates/desktop-navigation') ?> 

        <?php get_template_part('templates/navigation-search') ?>
      </div>
    </header><!-- #masthead -->



    <?php
  /**
   * Functions hooked in to storefront_before_content
   *
   * @hooked storefront_header_widget_region - 10
   */
  do_action( 'storefront_before_content' ); ?>

  <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">

      <?php
    /**
     * Functions hooked in to storefront_content_top
     *
     * @hooked woocommerce_breadcrumb - 10
     */
    do_action( 'storefront_content_top' );
