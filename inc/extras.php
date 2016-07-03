<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Alpha_Centauri
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function alpha_centauri_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class if is frontpage and at least one featured post.
	if ( is_front_page() && alpha_centauri_has_featured_posts( 1 ) )  {
		$classes[] = 'has-slider-img';
	}

	// Adds a class if is frontpage and at least two featured posts.
	if ( is_front_page() && alpha_centauri_has_featured_posts( 2 ) )  {
		$classes[] = 'flickity-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'alpha_centauri_body_classes' );

/**
 * Adds custom classes to the array of posts classes.
 *
 * @param array $classes Classes for the post element.
 * @return array.
 */
function alpha_centauri_post_classes( $classes ) {
	// Adds a class of no-thumbnail to blog posts without a post thumbnail.
	if ( ! has_post_thumbnail() ) {
		array_push( $classes, 'no-thumbnail' );
	}

	return $classes;
}
add_filter( 'post_class', 'alpha_centauri_post_classes' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function alpha_centauri_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'alpha-centauri-navigation-img' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevThumb[0] ) . '); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'alpha-centauri-navigation-img' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextThumb[0] ) . '); }
		';
	}

	wp_add_inline_style( 'alpha-centauri-style', $css );
}
add_action( 'wp_enqueue_scripts', 'alpha_centauri_post_nav_background' );

/**
 * Make all the tags in the tag cloud widget the same size.
 */
function alpha_centauri_same_size_tags( $args ) {
	$args['largest'] = 16; //largest tag
	$args['smallest'] = 16; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'alpha_centauri_same_size_tags' );