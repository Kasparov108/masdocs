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
			$grand_children = get_children( array( 'post_parent' => $child->ID, 'post_type' => 'docs' ) );
			$grand_children_count = count( $grand_children );

			$classes    = 'docs-subcategory-item';
			$span_count = '';

			if ( $grand_children_count > 0 ) {
				$classes .= ' has-children';
				$span_count = '<span class="count badge badge-secondary">' . esc_html( $grand_children_count ) . '</span>';
			}

			$output .= '<li class="' . esc_attr( $classes ) . '"><h4><a href="' . get_permalink( $child->ID ) . '">' . get_the_title( $child->ID ) . $span_count . '</a></h4></li>';
		}

		$output = '<ul class="docs-subcategories">' . $output . '</ul>';

		echo $output;
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

        ?><div class="heading-search bg-light border border-left-0 border-right-0 border-top-0 p-4">
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