<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alpha_Centauri
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); alpha_centauri_post_thumbnail(); ?>>
	<?php 
	if ( ! is_single() ) : ?>
		<a class="overlay" href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
			<div class="article-inner">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-read-more">
					<span class="read-more-link"><?php esc_html_e( 'Read More', 'alpha-centauri' ); ?></span>
				</div><!-- .entry-read-more -->
			</div><!-- .article-inner -->
		</a><!-- .overlay -->
	<?php 
	endif; ?>

	<?php 
	if ( is_single() ) : ?>
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav" aria-hidden="true">&rarr;</span>', 'alpha-centauri' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				), true );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alpha-centauri' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php alpha_centauri_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php 
	endif; ?>
</article><!-- #post-## -->
