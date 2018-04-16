<?php
/**
 * Genesis Starter Theme
 *
 * This file adds customizer settings to the Genesis Starter theme.
 *
 * @package   SEOThemes\ChildThemeLibrary
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\ChildThemeLibrary\Admin;

use \SEOThemes\ChildThemeLibrary\Classes\RGBA_Customize_Control;

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

	// Globals.
	global $wp_customize;

	// Load default theme colors.
	$colors = require_once CHILD_THEME_DIR . '/config/theme.php';

	/**
	 * Custom colors.
	 *
	 * Loop through the global variable array of colors and
	 * register a customizer setting and control for each.
	 * To add additional color settings, do not modify this
	 * function, instead add your color name and hex value to
	 * the $colors` array at the start of this file.
	 */
	foreach ( $colors['colors'] as $id => $rgba ) {

		// Format ID and label.
		$setting = CHILD_THEME_PREFIX . "_{$id}_color";
		$label   = ucwords( str_replace( '_', ' ', $id ) ) . __( ' Color', CHILD_TEXT_DOMAIN );

		// Add color setting.
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $rgba,
				'sanitize_callback' => 'sanitize_rgba_color',
			)
		);

		// Add color control.
		$wp_customize->add_control(
			new RGBA_Customize_Control(
				$wp_customize,
				$setting,
				array(
					'section'      => 'colors',
					'label'        => $label,
					'settings'     => $setting,
					'show_opacity' => true,
					'palette'      => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					),
				)
			)
		);
	}
}
