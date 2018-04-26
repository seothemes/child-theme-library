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

	// Enqueue custom theme scripts.
	wp_enqueue_script( CHILD_THEME_HANDLE, CHILD_THEME_SCRIPTS . '/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( 'genesis-menus', CHILD_THEME_SCRIPTS . '/menus.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menu script.
	wp_localize_script( CHILD_THEME_HANDLE, 'genesis_responsive_menu', array(
		'mainMenu'         => __( 'Menu', CHILD_THEME_HANDLE ),
		'subMenu'          => __( 'Menu', CHILD_THEME_HANDLE ),
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
