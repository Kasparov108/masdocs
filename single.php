<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package masDocs
 */

get_header(); get_sidebar(); ?>

    <div id="primary" class="content-area">
        <div class="content-area-inner has-site-aside">
            <main id="main" class="site-main">
                <div class="site-main-inner">
                <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', get_post_type() );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                ?>
                </div>
            </main><!-- #main -->

            <div class="site-aside">
                <div class="site-aside-inner">
                <?php
                    the_post_navigation( array(
                        'prev_text' => '<span class="aside-title">Previous</span><span class="aside-link">%title</span>',
                        'next_text' => '<span class="aside-title">Next</span><span class="aside-link">%title</span>'
                    ) );
                    masdocs_entry_meta();
                ?>
                </div>
            </div>
        </div><!-- /.content-area-inner -->
    </div><!-- #primary -->

<?php get_footer();