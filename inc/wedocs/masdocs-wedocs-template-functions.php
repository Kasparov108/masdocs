<?php
/**
 * WeDocs Template Functions.
 *
 * @package masdocs
 */

if ( ! function_exists( 'masdocs_list_docs_subcategories' ) ) {
	function masdocs_list_docs_subcategories() {
		global $post;

		$args = array(
			'post_parent' => $post->ID,
			'post_type'   => 'docs',
			'orderby'     => 'menu_order',
            'order'       => 'ASC'
		);

		$children = get_children( $args );

		$output = '';

		foreach( $children as $child ) {
			$grand_children = get_children( array( 'post_parent' => $child->ID, 'post_type' => 'docs', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
			$grand_children_count = count( $grand_children );

			$classes    = 'docs-subcategory-item';
			$span_count = '';

			if ( $grand_children_count > 0 ) {
				$classes .= ' has-children';
				$span_count = '<span class="count badge badge-secondary">' . esc_html( $grand_children_count ) . '</span>';
			}

			$output .= '<li class="' . esc_attr( $classes ) . '"><h4><a href="' . get_permalink( $child->ID ) . '">' . get_the_title( $child->ID ) . $span_count . '</a></h4></li>';
		}

        if ( ! empty( $output ) ) {
            $output = '<ul class="docs-subcategories">' . $output . '</ul>';
            $block_title = '<h2>' . esc_html__( 'Topics in this section', 'masdocs' ) . '</h2>';
            echo '<div class="docs-subcategories-wrapper">' . wp_kses_post( $block_title . $output ) . '</div>';
        }
	}
}

if ( ! function_exists( 'masdocs_heading_search' ) ) {
    function masdocs_heading_search() {
        
        $dropdown_args = array(
            'post_type'         => 'docs',
            'echo'              => 0,
            'depth'             => 2,
            'show_option_none'  => __( 'All Docs', 'wedocs' ),
            'option_none_value' => 'all',
            'name'              => 'search_in_doc',
            'class'             => 'form-control search-in-docs custom-select form-control-lg',
        );

        if ( isset( $_GET['search_in_doc'] ) && 'all' != $_GET['search_in_doc'] ) {
            $dropdown_args['selected'] = (int) $_GET['search_in_doc'];
        }

        ?><div class="heading-search bg-light border border-left-0 border-right-0 border-top-0 p-5">
            <div class="container">
                <form role="search" method="get" class="form-heading-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="form-row justify-content-md-center">
                        <div class="form-group col-md-6">
                            <label for="docs-search" class="sr-only"></label>
                            <input id="docs-search" type="search" class="form-control form-control-lg" placeholder="<?php echo esc_attr_x( 'Documentation Search &hellip;', 'masdocs' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
                            <input type="hidden" name="post_type" value="docs" />
                        </div>
                        <div class="form-group col-md-3">
                            <?php echo wp_dropdown_pages( $dropdown_args ); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo esc_html__( 'Search', 'masdocs' ); ?></button>  
                        </div>
                    </div>
                </form>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'masdocs_table_of_contents' ) ) {
    function masdocs_table_of_contents() {
        ?><div id="table-of-contents" class="site-aside-inner"><h6><?php echo esc_html__( 'Contents', 'masdocs' ); ?></h6></div><?php
    }
}

if ( ! function_exists( 'masdocs_sibling_docs' ) ) {
    function masdocs_sibling_docs() {
        global $post;

        $list_pages_args = array(
            'title_li'  => '',
            'order'     => 'menu_order',
            'orderby'   => 'DESC',
            'child_of'  => $post->post_parent, 
            'post_type' => 'docs'
        );

        ?><div class="sibling-navigation">
            <ul>
                <li>
                    <h4><?php echo get_the_title( $post->post_parent ); ?></h4>
                    <ul class="list-sibling-pages list-unstyled"><?php wp_list_pages( $list_pages_args ); ?></ul>
                </li>
            </ul>
        </div><?php
    }
}