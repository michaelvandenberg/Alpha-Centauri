<?php
/**
 * The single post section of the header.
 *
 * Displays the header if there is no post-thumbnail to display.
 *
 * @package Alpha Centauri
 */

?>

<div id="default-header" class="no-featured-img" <?php alpha_centauri_header_image(); ?>>

	<?php
		if ( is_archive() ) :
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		elseif ( is_search() && have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'alpha-centauri' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
		<?php
		elseif ( ( is_search() && ! have_posts() ) || ( ! have_posts() && ! is_404() ) ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'alpha-centauri' ); ?></h1>
			</header><!-- .page-header -->
		<?php
		elseif ( is_404() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'alpha-centauri' ); ?></h1>
			</header><!-- .page-header 404 page can't be found -->
		<?php
		elseif ( is_home() ) : ?>
			<?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) { ?>
				<div class="single-header"><p class="site-description-big"><?php echo $description; ?></p></div>
			<?php } ?>
		<?php
		else :
			the_title( '<div class="single-header"><h1 class="single-title">', '</h1></div>' );
		endif;
	?>

</div>