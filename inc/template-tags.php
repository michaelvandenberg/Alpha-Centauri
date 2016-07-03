<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Alpha_Centauri
 */

if ( ! function_exists( 'alpha_centauri_time_string' ) ) :
/**
 * Returns HTML with meta information for the current post-date/time.
 */
function alpha_centauri_time_string() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	return $time_string;
}
endif;

if ( ! function_exists( 'alpha_centauri_categories' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function alpha_centauri_categories() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$categories_list = get_the_category_list();
		if ( $categories_list && alpha_centauri_categorized_blog() ) {
			echo '<span class="cat-links">';
			echo $categories_list;
			echo '</span>';
		}
	}

}
endif;

if ( ! function_exists( 'alpha_centauri_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function alpha_centauri_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$tags_list = get_the_tag_list();
		if ( $tags_list ) {
			echo '<span class="tags-links">';
			echo $tags_list;
			echo '</span>';
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'alpha-centauri' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function alpha_centauri_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'alpha_centauri_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'alpha_centauri_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so alpha_centauri_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so alpha_centauri_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in alpha_centauri_categorized_blog.
 */
function alpha_centauri_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'alpha_centauri_categories' );
}
add_action( 'edit_category', 'alpha_centauri_category_transient_flusher' );
add_action( 'save_post',     'alpha_centauri_category_transient_flusher' );

if ( ! function_exists( 'alpha_centauri_post_thumbnail' ) ) :
/**
 * Display a fullscreen post thumbnail.
 *
 * @since Alpha-Centauri 1.0.0
 */
function alpha_centauri_post_thumbnail() {
	if ( ! has_post_thumbnail() || is_singular() ) {
		return;
	}

	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );

	echo 'style="background-image: url(' . esc_url( $thumb_url[0] ) . ');"';

}
endif; // alpha_centauri_post_thumbnail

if ( ! function_exists( 'alpha_centauri_fullscreen_image' ) ) :
/**
 * Display a fullscreen post thumbnail.
 *
 * @since Alpha-Centauri 1.0.0
 */
function alpha_centauri_fullscreen_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'alpha-centauri-fullscreen-img' );

	echo 'style="background-image: url(' . esc_url( $thumb_url[0] ) . ');"';

	//echo 'style="background-image: url(' . esc_url( the_post_thumbnail_url() ) . ');"';

}
endif; // alpha_centauri_fullscreen_image
