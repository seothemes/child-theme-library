<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\ChildThemeLibrary
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\ChildThemeLibrary;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

// Store the theme object.
$child_theme = wp_get_theme();

// Initialize the theme's constants.
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'CHILD_ASSETS_DIR', CHILD_THEME_DIR . '/assets/' );
define( 'CHILD_CONFIG_DIR', CHILD_THEME_DIR . '/config/' );
define( 'CHILD_LIB_DIR', CHILD_THEME_DIR . '/lib/' );
define( 'CHILD_THEME_PREFIX', str_replace( '-', '_', CHILD_TEXT_DOMAIN ) );

// Store the theme config globally.
$config = require_once( CHILD_THEME_DIR . '/config/theme.php' );

/**
 * Load theme files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload() {

	global $config;

	$all   = glob( CHILD_THEME_DIR . '/lib/**/*.php' );

	$files = array_diff( $all, $config['autoload'] );

	// $backend   = '';
	// $backend  .= CHILD_THEME_DIR . '/lib/admin/*.php';
	// $backend  .= CHILD_THEME_DIR . '/lib/classes/*.php';
	// $backend  .= CHILD_THEME_DIR . '/lib/widgets/*.php';
	// $backend   = glob( $backend, GLOB_BRACE );

	// $frontend  = '';
	// $frontend  = array_diff( $files, $backend );

	foreach ( $files as $file ) {

		if ( file_exists( $file ) ) {

			require_once $file;

		}
	}

}

autoload();
