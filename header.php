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

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'masdocs' ); ?></a>

	<?php if(0): ?><header id="masthead" class="site-header">
		<div class="container">

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'masdocs' ); ?></button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead --><?php endif; ?>

	<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">MadrasThemes Docs</a>
			<ul class="navbar-nav">
				<li class="nav-item"><a href="#" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Plugins</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Themes</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Support</a></li>
			</ul>
		</div>
	</nav>

	<?php masdocs_heading_search() ; ?>

	<div id="content" class="site-content">
		<div class="container">