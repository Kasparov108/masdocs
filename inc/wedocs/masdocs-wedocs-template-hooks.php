<?php
/**
 * WeDocs Template Hooks.
 *
 * @package masdocs
 */

add_filter( 'wedocs_post_type', 'masdocs_add_page_attr_to_args' );

function masdocs_add_page_attr_to_args( $args ) {
	$args['supports'][] = 'page-attributes';
	return $args;
}

/**
 * Sidebar
 */
add_action( 'masdocs_sidebar', 'masdocs_table_of_contents', 10 );
//add_action( 'masdocs_sidebar', 'masdocs_sibling_docs',      20 );

//add_action( 'masdocs_sidebar', 'masdocs_sidebar_nav', 10 );

function masdocs_sidebar_nav() {
	global $post;
	$root_doc_start_level = 2;

	$ancestors = array();
    $root      = $parent = false;

    if ( $post->post_parent ) {
        $ancestors = get_post_ancestors( $post->ID );
        $total_ancestors = count( $ancestors );

        if ( $total_ancestors < $root_doc_start_level ) {
        	return;
        } 
    	$root   = $total_ancestors - $root_doc_start_level;
        $parent = $ancestors[$root];
    } else {
        $parent = $post->ID;
    }

    // var_dump( $parent, $ancestors, $root );
    $walker = new WeDocs_Walker_Docs();
    $children = wp_list_pages( array(
        'title_li'  => '',
        'order'     => 'menu_order',
        'child_of'  => $parent,
        'echo'      => false,
        'post_type' => 'docs',
        'walker'    => $walker
    ) );
    ?>

    <?php if ($children) { ?>
        <div id="table-of-contents" class="bg-light d-block">
        	<h6><?php echo get_post_field( 'post_title', $parent, 'display' ); ?></h6>
        	<hr>
        	<ol class="masdocs-doc-nav-list">
            	<?php echo $children; ?>
        	</ol>
    	</div>
    <?php }
}