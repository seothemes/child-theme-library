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

namespace SEOThemes\Library\Functions;

use SEOThemes\Library\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load_scripts', 99 );
/**
 * Enqueue theme scripts and styles.
 *
 * @return void
 */
function load_scripts() {

	// Check if debugging is enabled.
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : 'min.';
	$folder = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : 'min/';

	// Enqueue custom theme scripts.
	wp_enqueue_script( CHILD_TEXT_DOMAIN, CHILD_THEME_URI . '/assets/scripts/' . $folder . 'scripts.' . $suffix . 'js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( 'genesis-menus', CHILD_THEME_URI . '/assets/scripts/' . $folder . 'menus.' . $suffix . 'js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menu script.
	wp_localize_script( CHILD_TEXT_DOMAIN, 'genesis_responsive_menu', array(
		'mainMenu'         => __( 'Menu', CHILD_TEXT_DOMAIN ),
		'subMenu'          => __( 'Menu', CHILD_TEXT_DOMAIN ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	) );
}
