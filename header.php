<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package masDocs
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#table-of-contents" data-offset="0" style="position:relative">
<div id="page" class="site">
    <a class="skip-link sr-only screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'masdocs' ); ?></a>
    
    <header id="masthead" class="site-header">
        <nav class="navbar navbar-expand-lg masdocs-navbar">
            <div class="container">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">
                    <?php echo get_bloginfo( 'name' ); ?>
                </a>
                <?php
                    wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 2,
                        'container'         => false,
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'            => new WP_Bootstrap_Navwalker()
                    ) );
                ?>
            </div>
        </nav>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <div class="container">
            <div class="site-content-inner">