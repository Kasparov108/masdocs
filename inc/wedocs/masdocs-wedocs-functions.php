<?php
/**
 * WeDocs Functions.
 *
 * @package masdocs
 */
if ( ! function_exists( 'masdocs_wedocs_breadcrumb' ) ) :

/**
 * Docs breadcrumb
 *
 * @return void
 */
function masdocs_wedocs_breadcrumb() {
    global $post;

    $html = '';
    $args = apply_filters( 'masdocs_wedocs_breadcrumb', array(
        'delimiter' => '',
        'home'      => __( 'Home', 'wedocs' ),
        'before'    => '<li class="breadcrumb-item"><span class="current">',
        'after'     => '</span></li>'
    ) );

    $breadcrumb_position = 1;

    $html .= '<ul class="wedocs-breadcrumb breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
    $html .= masdocs_wedocs_get_breadcrumb_item( $args['home'], home_url( '/' ), $breadcrumb_position );
    $html .= $args['delimiter'];

    $docs_home = wedocs_get_option( 'docs_home', 'wedocs_settings' );

    if ( $docs_home ) {
        $breadcrumb_position++;

        $html .= masdocs_wedocs_get_breadcrumb_item( __( 'Docs', 'wedocs' ), get_permalink( $docs_home ), $breadcrumb_position );
        $html .= $args['delimiter'];
    }

    if ( $post->post_type == 'docs' && $post->post_parent ) {
        $parent_id   = $post->post_parent;
        $breadcrumbs = array();

        while ($parent_id) {
            $breadcrumb_position++;

            $page          = get_post($parent_id);
            $breadcrumbs[] = masdocs_wedocs_get_breadcrumb_item( get_the_title( $page->ID ), get_permalink( $page->ID ), $breadcrumb_position );
            $parent_id     = $page->post_parent;
        }

        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            $html .= $breadcrumbs[$i];
            $html .= ' ' . $args['delimiter'] . ' ';
        }

    }

    $html .= ' ' . $args['before'] . get_the_title() . $args['after'];

    $html .= '</ul>';

    echo apply_filters( 'masdocs_wedocs_breadcrumb_html', $html, $args );
}

endif;

if ( ! function_exists( 'masdocs_wedocs_get_breadcrumb_item' ) ) :

/**
 * Schema.org breadcrumb item wrapper for a link
 *
 * @param  string  $label
 * @param  string  $permalink
 * @param  integer $position
 *
 * @return string
 */
function masdocs_wedocs_get_breadcrumb_item( $label, $permalink, $position = 1 ) {
    return '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="' . esc_attr( $permalink ) . '">
        <span itemprop="name">' . esc_html( $label ) . '</span></a>
        <meta itemprop="position" content="' . $position . '" />
    </li>';
}

endif;

if ( ! function_exists( 'masdocs_has_sidebar' ) ) {
    function masdocs_has_sidebar() {
        global $post;
        return ! empty( get_the_content( $post->ID ) );
    }
}