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
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>

            <div class="wedocs-single-wrap">

                <?php masdocs_wedocs_breadcrumb(); ?>

                <div class="wedocs-single-content <?php if ( masdocs_has_sidebar() ) : ?>has-sidebar row<?php endif; ?>">

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

                        <!--<footer class="entry-footer wedocs-entry-footer">
                            <?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ): ?>
                                <span class="wedocs-help-link wedocs-hide-print wedocs-hide-mobile">
                                    <i class="wedocs-icon wedocs-icon-envelope"></i>
                                    <?php printf( '%s <a id="wedocs-stuck-modal" href="%s">%s</a>', __( 'Still stuck?', 'wedocs' ), '#', __( 'How can we help?', 'wedocs' ) ); ?>
                                </span>
                            <?php endif; ?>

                            <div class="wedocs-article-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <meta itemprop="name" content="<?php echo get_the_author(); ?>" />
                                <meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
                            </div>

                            <meta itemprop="datePublished" content="<?php echo get_the_time( 'c' ); ?>"/>
                            <time itemprop="dateModified" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php printf( __( 'Updated on %s', 'wedocs' ), get_the_modified_date() ); ?></time>
                        </footer> -->

                        <?php //wedocs_doc_nav(); ?>

                        <?php if ( wedocs_get_option( 'helpful', 'wedocs_settings', 'on' ) == 'on' ): ?>
                            <?php //wedocs_get_template_part( 'content', 'feedback' ); ?>
                        <?php endif; ?>

                        <?php if ( wedocs_get_option( 'email', 'wedocs_settings', 'on' ) == 'on' ): ?>
                            <?php //wedocs_get_template_part( 'content', 'modal' ); ?>
                        <?php endif; ?>

                    </article><!-- #post-## -->
                    
                    <?php if ( masdocs_has_sidebar() ) : ?>

                    <div class="sidebar">
                        <div id="table-of-contents" class="bg-light"><h6><?php echo esc_html__( 'Table of Contents', 'wedocs' ); ?></h6><hr/></div>
                    </div>

                    <?php endif; ?>

                </div><!-- .wedocs-single-content -->
            </div><!-- .wedocs-single-wrap -->

        <?php endwhile; ?>

    </main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
