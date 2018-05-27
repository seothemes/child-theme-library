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

namespace SEOThemes\Core\Admin;

use SEOThemes\Core\Functions\Utils;
use SEOThemes\Core\Classes\RGBA_Customize_Control;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'customize_register', __NAMESPACE__ . '\customize_register' );
/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @access public
 * @param  object $wp_customize Global customizer object.
 *
 * @return void
 */
function customize_register( $wp_customize ) {

	global $wp_customize;

	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );

	$prefix = str_replace( '-', '_', CHILD_THEME_HANDLE );
	$colors = Utils\get_config( 'colors' );

	/*
	| ------------------------------------------------------------------
	| Logo Size
	| ------------------------------------------------------------------
	*/
	$wp_customize->add_setting(
		$prefix . '_logo_size',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 100,
			'sanitize_callback' => $prefix . '_sanitize_number',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		$prefix . '_logo_size',
		array(
			'label'       => __( 'Logo Size', CHILD_THEME_HANDLE ),
			'description' => __( 'Set the logo size in pixels. Default is 100.', CHILD_THEME_HANDLE ),
			'settings'    => $prefix . '_logo_size',
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
		$prefix . '_fixed_header',
		array(
			'capability' => 'edit_theme_options',
			'default'    => false,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		$prefix . '_fixed_header',
		array(
			'label'    => __( 'Enable fixed header', CHILD_THEME_HANDLE ),
			'settings' => $prefix . '_fixed_header',
			'section'  => 'genesis_layout',
			'type'     => 'checkbox',
		)
	) );

	/*
	| ------------------------------------------------------------------
	| Colors
	| ------------------------------------------------------------------
	*/
	foreach ( $colors as $id => $rgba ) {

		$setting = $prefix . "_{$id}_color";
		$label   = ucwords( str_replace( '_', ' ', $id ) ) . __( ' Color', CHILD_THEME_HANDLE );

		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $rgba,
				'sanitize_callback' => 'sanitize_rgba_color',
			)
		);

		$wp_customize->add_control(
			new RGBA_Customize_Control(
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
