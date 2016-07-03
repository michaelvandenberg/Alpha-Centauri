<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alpha_Centauri
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alpha-centauri' ); ?></a>

	<div id="hidden-header" class="hidden" style="display:none;">
		<nav id="primary-navigation" class="main-navigation" role="navigation">
			<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>

			<?php if ( has_nav_menu( 'social' ) ) { get_template_part( 'template-parts/navigation-social' ); } ?>

			<div id="primary-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #primary-search -->
		</nav><!-- #primary-navigation -->
	</div><!-- #hidden-header -->

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php 
			if ( has_site_icon() ) : ?>
				<?php $site_icon = esc_url( get_site_icon_url( 108 ) ); ?>
				<div class="site-icon" aria-hidden="true">
					<img class="site-icon-img" src="<?php echo $site_icon; ?>" alt="" >
				</div>
			<?php 
			else : ?>
				<?php $site_title = get_bloginfo( 'name' ); ?>
				<div class="site-first-letter" aria-hidden="true">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo substr($site_title, 0, 1); ?></a>
				</div>
			<?php 
			endif; ?>

			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<button class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'alpha-centauri' ); ?></span>
			<span class="toggle-lines" aria-hidden="true"></span>
		</button>
	</header><!-- #masthead -->

	<?php if ( is_front_page() && alpha_centauri_has_featured_posts( 1 ) ) : ?>
		<?php get_template_part( 'template-parts/header-featured' ); ?>
	<?php elseif ( is_singular() && has_post_thumbnail() ) : ?>
		<?php get_template_part( 'template-parts/header-single' ); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/header-none' ); ?>
	<?php endif; ?>

	<div id="content" class="site-content">
