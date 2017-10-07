<?php
/**
 * Shortcodes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Masdocs_Shortcodes {
	
	/**
	 * Init Shortcodes
	 */
	public static function init() {
		$shortcodes = array(
			'helpdesk'          => __CLASS__ . '::helpdesk',
			'masdocs_featured'  => __CLASS__ . '::masdocs_featured'
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
	}

	/**
	 * Show docs
	 */
	public static function masdocs_featured( $atts ) {
		$atts = shortcode_atts( array(
			'id'      => 'none',
			'include' => 'none',
			'columns' => 'col-md-4'
		), $atts, 'masdocs_featured' );

		if ( 'none' === $atts['include'] || 'none' === $atts['id'] ) {
			return;
		}

		$args = array(
			'post_type'   => 'docs',
            'parent'      => 0,
            'sort_column' => 'menu_order',
            'include'     => $atts['include']
		);

		$docs = get_pages( $args );
		$featured_docs_html = '';
		$featured = get_post( $atts['id'] ); 

		if ( $docs ) {
			ob_start();
			?><h2 class="text-center"><?php echo $featured->post_title; ?></h2>
			<div class="masdocs-featured row justify-content-md-center"><?php
			foreach( $docs as $doc ) : ?>
				<div class="masdocs-featured-item <?php echo esc_attr( $atts['columns'] ); ?>">
					<a href="<?php echo get_permalink( $doc->ID ); ?>" class="masdocs-featured-item-link">
						<div class="masdocs-featured-item-image"><?php echo get_the_post_thumbnail( $doc->ID, 'full' ); ?></div>
						<h4 class="text-dark"><?php echo $doc->post_title; ?></h4>
					</a>
				</div><?php
			endforeach; ?>
				<div class="col-md-4" style="text-align: center;"><a href="<?php echo esc_url( get_permalink( $featured->ID ) ); ?>" class=""><?php echo esc_html__( 'Browse all theme documents', 'masdocs' ); ?> &rarr;</a></div>
			</div><?php
			$featured_docs_html = ob_get_clean();
		}

		return $featured_docs_html;
	}

	/**
	 * Helpdesk URL
	 */
	public static function helpdesk( $atts ) {
		$atts = shortcode_atts( array( 
			'text' => '<strong>' . esc_html__( 'help center', 'masdocs' ) . '</strong>',
			'attr' => array(
				'class'  => 'helpcenter-link',
				'target' => '_blank'
			),
		), $atts, 'helpdesk' );

		$attribute_str = '';

		$helpdesk_url = apply_filters( 'masdocs_helpdesk_url', 'https://madrasthemes.freshdesk.com/' );

		foreach( $atts['attr'] as $key => $attribute ) {
			$attribute_str .= ' ' . $key . '="' . esc_attr( $attribute ) . '"';
		}

		return '<a href="' . esc_url( $helpdesk_url ) . '" ' . $attribute_str . '>' . wp_kses_post( $atts['text'] ) . '</a>';
	}
}