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