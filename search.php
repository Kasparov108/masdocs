<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
                        <h1 class="page-title entry-title"><?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'masdocs' ), '<span>' . get_search_query() . '</span>' );
                        ?></h1>
                    </header><!-- .page-header -->

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );

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