<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Alpha_Centauri
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 * See: https://jetpack.me/support/featured-content/
 * See: https://jetpack.me/support/custom-content-types/
 */
function alpha_centauri_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'scroll',
		'container' => 'main',
		'render'    => 'alpha_centauri_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Portfolio Custom Post Type.
	add_theme_support( 'jetpack-portfolio' );

	// Add theme support for Logo upload.
	add_theme_support( 'site-logo' );

	// Add theme support for Featured Content.
	add_theme_support( 'featured-content', array(
		'filter'     => 'alpha_centauri_get_featured_posts',
		'max_posts'  => 5,
		'post_types' => array( 'post', 'page', 'portfolio' ),
	) );

} // end function alpha_centauri_jetpack_setup
add_action( 'after_setup_theme', 'alpha_centauri_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function alpha_centauri_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Return early if Site Logo is not available.
 */
function alpha_centauri_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return false;
	} else {
		jetpack_the_site_logo();
	}
} // end function alpha_centauri_the_site_logo

/**
 * Get the featured posts function.
 */
function alpha_centauri_get_featured_posts() {
	return apply_filters( 'alpha_centauri_get_featured_posts', array() );
} // end function alpha_centauri_get_featured_posts

/**
 * Check the number of featured posts.
 */
function alpha_centauri_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'alpha_centauri_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
} // end function alpha_centauri_has_featured_posts
