<?php
/**
 * Genesis Starter Theme
 *
 * This file adds customizer settings to the Genesis Starter theme.
 *
 * @package   SEOThemes\Library
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'customize_register', 'child_theme_customize_register' );
/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 *
 * @access public
 * @param  object $wp_customize Global customizer object.
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_customize_register( $wp_customize ) {

	global $wp_customize;

	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );

	$colors = child_theme_get_config( 'colors' );

	/*
	| ------------------------------------------------------------------
	| Logo Size
	| ------------------------------------------------------------------
	*/
	$wp_customize->add_setting(
		'child_theme_logo_size',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 100,
			'sanitize_callback' => 'child_theme_sanitize_number',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'child_theme_logo_size',
		array(
			'label'       => __( 'Logo Size', CHILD_THEME_HANDLE ),
			'description' => __( 'Set the logo size in pixels. Default is 100.', CHILD_THEME_HANDLE ),
			'settings'    => 'child_theme_logo_size',
			'section'     => 'title_tagline',
			'type'        => 'number',
			'priority'    => 8,
		)
	) );

	/*
	| ------------------------------------------------------------------
	| Sticky Header
	| ------------------------------------------------------------------
	*/
	$wp_customize->add_setting(
		'child_theme_fixed_header',
		array(
			'capability' => 'edit_theme_options',
			'default'    => false,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'child_theme_fixed_header',
		array(
			'label'    => __( 'Enable fixed header', CHILD_THEME_HANDLE ),
			'settings' => 'child_theme_fixed_header',
			'section'  => 'genesis_layout',
			'type'     => 'checkbox',
		)
	) );

	/*
	| ------------------------------------------------------------------
	| Colors
	| ------------------------------------------------------------------
	*/
	foreach ( $colors as $color => $settings ) {

		$setting = "child_theme_{$color}_color";
		$label   = ucwords( str_replace( '_', ' ', $color ) ) . __( ' Color', CHILD_THEME_HANDLE );

		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $settings['value'],
				'sanitize_callback' => 'child_theme_sanitize_rgba_color',
			)
		);

		$wp_customize->add_control(
			new Child_Theme_RGBA_Customizer_Control(
				$wp_customize,
				$setting,
				array(
					'section'      => 'colors',
					'label'        => $label,
					'settings'     => $setting,
					'show_opacity' => true,
					'palette'      => true,
				)
			)
		);
	}
}
