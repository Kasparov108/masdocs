<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package masDocs
 */

get_header(); get_sidebar(); ?>

	<div id="primary" class="content-area">
		<div class="content-area-inner has-site-aside">
			<main id="main" class="site-main">
				<div class="site-main-inner">

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'masdocs' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content entry-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'masdocs' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->

				</div><!-- /.site-main-inner -->
			</main><!-- #main -->
			<?php get_sidebar( 'blog' ); ?>
		</div><!-- /.content-area-inner -->
	</div><!-- #primary -->

<?php get_footer();