<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package masDocs
 */

get_header(); get_sidebar(); ?>

	<div id="primary" class="content-area">
		<div class="content-area-inner has-site-aside">
			<main id="main" class="site-main">
				<div class="site-main-inner">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title entry-title">', '</h1>' );
							the_archive_description( '<div class="archive-description entry-subtitle">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

				</div><!-- /.site-main-inner -->
			</main><!-- #main -->
			<?php get_sidebar( 'blog' ); ?>
		</div><!-- /.content-area-inner -->
	</div><!-- #primary -->

<?php get_footer();