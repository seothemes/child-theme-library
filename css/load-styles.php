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
 * @return void
 */
function child_theme_load_styles() {

	// Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );

	// Conditionally load WooCommerce styles.
	if ( child_theme_is_woocommerce_page() ) {

		wp_enqueue_style( CHILD_THEME_HANDLE . '-woocommerce', CHILD_THEME_STYLES . '/woocommerce/woocommerce.css', array(), CHILD_THEME_VERSION );

	}

}
