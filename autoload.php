<?php
/**
 * Child Theme Library
 *
 * WARNING: This file is a part of the core Child Theme Library.
 * DO NOT edit this file under any circumstances. Please use
 * the functions.php file to make any theme modifications.
 *
 * @package   SEOThemes\ChildThemeLibrary
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die;

}

spl_autoload_register( 'child_theme_autoload_classes' );
/**
 * Register class autoloader.
 *
 * @since  1.0.0
 *
 * @param  string $class Class to load.
 *
 * @return void
 */
function child_theme_autoload_classes( $class ) {

	$file_name = str_replace( '_', '-', strtolower( $class ) );

	$file = CHILD_THEME_LIB . "/classes/class-{$file_name}.php";

	if ( stream_resolve_include_path( $file ) ) {

		require_once $file;

	}
}

add_action( 'genesis_setup', 'child_theme_autoload_composer' );
/**
 * Includes the composer autoloader.
 *
 * @since  1.0.0
 *
 * @return void
 */
function child_theme_autoload_composer() {

	if ( file_exists( CHILD_THEME_DIR . '/vendor/autoload.php' ) ) {

		require_once CHILD_THEME_DIR . '/vendor/autoload.php';

	}

}

add_action( 'genesis_setup', 'child_theme_autoload_files', 6 );
/**
 * Autoload files.
 *
 * @since  1.1.0
 *
 * @return void
 */
function child_theme_autoload_files() {

	$config = require_once CHILD_THEME_CONFIG;

	foreach ( $config['autoload'] as $file ) {

		$file_name = CHILD_THEME_DIR . '/' . $file . '.php';

		if ( file_exists( $file_name ) ) {

			require_once $file_name;

		}
	}
}
