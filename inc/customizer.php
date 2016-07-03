<?php
/**
 * Alpha Centauri Theme Customizer.
 *
 * @package Alpha_Centauri
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alpha_centauri_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Theme options panel */
	$wp_customize->add_panel( 'alpha_centauri_theme_options', array(
		'priority'       => 900,
		'title'          => esc_html__( 'Theme Options', 'alpha-centauri' ),
		'description'    => esc_html__( 'This theme supports a number of options which you can set using this panel.', 'alpha-centauri' ),
	) );

	/* Theme options slider section */
	$wp_customize->add_section( 'alpha_centauri_slider_options', array(
		'title'				=> esc_html__( 'Slider Options', 'alpha-centauri' ),
		'priority'			=> 10,
		'panel'				=> 'alpha_centauri_theme_options',
		'description'		=> esc_html__( 'Enable (default) or disable autoplay for the full screen slider.', 'alpha-centauri' ),
	) );

	/* Theme options footer section */
	$wp_customize->add_section( 'alpha_centauri_footer_options', array(
		'title'				=> esc_html__( 'Footer Options', 'alpha-centauri' ),
		'priority'			=> 20,
		'panel'				=> 'alpha_centauri_theme_options',
		'description'		=> esc_html__( 'Replace the default copyright text.', 'alpha-centauri' ),
	) );

	/* Slider autoplay. */
	$wp_customize->add_setting( 'alpha_centauri_slider_autoplay', array(
		'default'           => '8000',
		'sanitize_callback' => 'alpha_centauri_sanitize_slider_autoplay',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'alpha_centauri_slider_autoplay', array(
		'label'             => esc_html__( 'Autoplay: ', 'alpha-centauri' ),
		'section'           => 'alpha_centauri_slider_options',
		'priority'          => 10,
		'type'              => 'radio',
		'choices'           => array(
			'true'			=> esc_html__( 'Enabled', 'alpha-centauri' ),
			'8000'			=> esc_html__( 'Enabled (Slow)', 'alpha-centauri' ),
			'false'			=> esc_html__( 'Disabled', 'alpha-centauri' ),
		),
	) );

	/* Custom copyright text. */
	$wp_customize->add_setting( 'alpha_centauri_custom_copyright', array(
		'default'			=> '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'alpha_centauri_custom_copyright', array(
		'label'				=> esc_html__( 'Your custom copyright text: ', 'alpha-centauri' ),
		'section'			=> 'alpha_centauri_footer_options',
		'priority'			=> 1,
	) );
}
add_action( 'customize_register', 'alpha_centauri_customize_register' );

/**
 * Sanitize slider slideshow.
 *
 * @param string $input.
 * @return string (true|false).
 */
function alpha_centauri_sanitize_slider_autoplay( $input ) {
	if ( ! in_array( $input, array( 'true', 'false', '8000' ) ) ) {
		$input = '8000';
	}
	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alpha_centauri_customize_preview_js() {
	wp_enqueue_script( 'alpha_centauri_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'alpha_centauri_customize_preview_js' );
