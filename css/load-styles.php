<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\Library\Functions
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', 'child_theme_load_styles', 99 );
/**
 * Enqueue theme scripts and styles.
 *
 * @since  1.0.0
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_load_styles() {

	$config = child_theme_get_config();

	foreach ( $config['styles'] as $style => $params ) {

		if ( ! strpos( $style, 'woocommerce' ) ) {

			wp_enqueue_style( 'child-theme-' . $style, $params['src'], $params['deps'], $params['ver'], $params['media'] );

		} else {

			if ( child_theme_is_woocommerce_page() ) {

				wp_enqueue_style( 'child-theme-' . $style, $params['src'], $params['deps'], $params['ver'], $params['media'] );

			}

		}

	}

	foreach ( $config['google-fonts'] as $google_font ) {

		$google_fonts[] = $google_font;

	}

	wp_enqueue_style( 'child-theme-google-fonts', '//fonts.googleapis.com/css?family=' . implode( '|', $google_fonts ), array(), CHILD_THEME_VERSION );

}
