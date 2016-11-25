<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alpha_Centauri
 */

$custom_copyright = get_theme_mod( 'alpha_centauri_custom_copyright' );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-inner">
			<?php get_sidebar( 'footer' ); ?>
			<div class="site-info">
				<?php if ( $custom_copyright ) { ?>
					<div class="copyright custom"><?php echo esc_html( $custom_copyright ); ?></div>
				<?php } else { ?>
					<div class="copyright"><span class="symbol">&copy; </span><?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a><span class="sep"> – </span><span class="description"><?php bloginfo( 'description' ); ?>.</span></div>
				<?php } ?>				
				<span class="generator"><?php echo esc_html__( 'Powered by ', 'alpha-centauri' ); ?><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'alpha-centauri' ) ); ?>" rel="generator">WordPress</a></span>
				<span class="sep"> | </span>
				<span class="designer"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'alpha-centauri' ), '<a href="https://michaelvandenberg.com/themes/#alpha-centauri" rel="theme">Alpha Centauri</a>', 'Michael Van Den Berg' ); ?></span>
			</div><!-- .site-info -->
		</div><!-- .footer-inner -->
	</footer><!-- #colophon -->

	<a href="#content" class="back-to-top"><?php echo esc_html_x( 'Top', 'Back to top: four letters max.', 'alpha-centauri' ); ?></a>

</div><!-- #page -->

<?php if ( has_nav_menu( 'social' ) ) { ?>
	<div id="social-right" class="social-navigation">
			<?php get_template_part( 'template-parts/navigation-social' ); ?>
	</div><!-- .social-right -->
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
