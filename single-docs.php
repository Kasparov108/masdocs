<?php
/**
 * The template for displaying a single doc
 *
 * To customize this template, create a folder in your current theme named "wedocs" and copy it there.
 *
 * @package weDocs
 */

$skip_sidebar = ( get_post_meta( $post->ID, 'skip_sidebar', true ) == 'yes' ) ? true : false;

get_header(); ?>

<div id="primary" class="content-area">
    <div class="content-area-inner">
        <main id="main" class="site-main" role="main">
            <div class="site-main-inner">
                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="wedocs-single-wrap">

                        <div class="wedocs-single-content has-sidebar">

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                                <header class="entry-header">
                                    <?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

                                    <?php if ( wedocs_get_option( 'print', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                        <a href="#" class="wedocs-print-article wedocs-hide-print wedocs-hide-mobile" title="<?php echo esc_attr( __( 'Print this article', 'wedocs' ) ); ?>"><i class="wedocs-icon wedocs-icon-print"></i></a>
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <div id="entry-content" class="entry-content" itemprop="articleBody">
                                    <?php
                                        the_content( sprintf(
                                            /* translators: %s: Name of current post. */
                                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wedocs' ), array( 'span' => array( 'class' => array() ) ) ),
                                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                        ) );

                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Docs:', 'wedocs' ),
                                            'after'  => '</div>',
                                        ) );

                                        $tags_list = wedocs_get_the_doc_tags( $post->ID, '', ', ' );

                                        if ( $tags_list ) {
                                            printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                                                _x( 'Tags', 'Used before tag names.', 'wedocs' ),
                                                $tags_list
                                            );
                                        }
                                    ?>
                                </div><!-- .entry-content -->

                                <?php masdocs_list_docs_subcategories(); ?>

                                <footer class="entry-footer wedocs-entry-footer bg-light text-center p-3">
                                    <?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                        <span class="wedocs-help-link wedocs-hide-print wedocs-hide-mobile">
                                            <?php printf( '%s <a class="btn btn-primary" rel="no-follow" href="%s">%s</a>', __( 'Not quite what you are looking for ?', 'wedocs' ), 'https://madrasthemes.freshdesk.com/', __( 'Get Help', 'wedocs' ) ); ?>
                                        </span>
                                    <?php endif; ?>

                                    <div class="wedocs-article-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        <meta itemprop="name" content="<?php echo get_the_author(); ?>" />
                                        <meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
                                    </div>

                                    <meta itemprop="datePublished" content="<?php echo get_the_time( 'c' ); ?>"/>
                                    <time class="d-none" itemprop="dateModified" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php printf( __( 'Updated on %s', 'wedocs' ), get_the_modified_date() ); ?></time>
                                </footer>

                            </article><!-- #post-## -->

                        </div><!-- .wedocs-single-content -->
                    </div><!-- .wedocs-single-wrap -->

                <?php endwhile; ?>
            </div><!-- /.site-main-inner -->
        </main><!-- .site-main -->

        <div class="site-aside">
            <?php do_action( 'masdocs_sidebar' ); ?>
        </div>
    </div>
</div><!-- .content-area -->

<?php get_sidebar(); get_footer();