<?php
/**
 * SEOThemes Library
 *
 * This file initializes the SEOThemes Library.
 *
 * @package   SEOThemes\Core
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'after_setup_theme', 'child_theme_init', 10 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_init() {

	/**
	 * Hooks.
	 *
	 * @hooked child_theme_constants - 0
	 * @hooked child_theme_autoload  - 5
	 * @hooked child_theme_setup     - 10
	 */
	do_action( 'child_theme_init' );

}

add_action( 'child_theme_init', 'child_theme_constants', 0 );
/**
 * Defines the child theme constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_constants() {

	define( 'CHILD_THEME_NAME',    wp_get_theme()->get( 'Name' )         );
	define( 'CHILD_THEME_URL',     wp_get_theme()->get( 'ThemeURI' )     );
	define( 'CHILD_THEME_VERSION', wp_get_theme()->get( 'Version' )      );
	define( 'CHILD_THEME_HANDLE',  wp_get_theme()->get( 'TextDomain' )   );
	define( 'CHILD_THEME_AUTHOR',  wp_get_theme()->get( 'Author' )       );
	define( 'CHILD_THEME_DIR',     get_stylesheet_directory()            );
	define( 'CHILD_THEME_URI',     get_stylesheet_directory_uri()        );
	define( 'CHILD_THEME_LIB',     CHILD_THEME_DIR . '/lib'              );
	define( 'CHILD_THEME_VIEWS',   CHILD_THEME_LIB . '/views'            );
	define( 'CHILD_THEME_VENDOR',  CHILD_THEME_DIR . '/vendor'           );
	define( 'CHILD_THEME_ASSETS',  CHILD_THEME_URI . '/assets'           );
	define( 'CHILD_THEME_CONFIG',  CHILD_THEME_DIR . '/config/theme.php' );

}

add_action( 'child_theme_init', 'child_theme_autoload', 5 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @throws \Exception If too many files are loaded.
 *
 * @return void
 */
function child_theme_autoload() {

	require_once CHILD_THEME_LIB . '/functions/autoload.php';

	$dirs = array(
		'/functions',
		'/structure',
		'/admin',
		'/css',
		'/js',
	);

	foreach ( $dirs as $dir ) {

		child_theme_autoloader( CHILD_THEME_LIB . $dir );

	}

}

add_action( 'child_theme_init', 'child_theme_setup', 10 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_setup() {

	child_theme_add_textdomain();
	child_theme_add_theme_supports( child_theme_get_config( 'theme-support' ) );
	child_theme_add_layouts( child_theme_get_config( 'layouts' ) );
	child_theme_add_widget_areas( child_theme_get_config( 'widget-areas' ) );
	child_theme_add_image_sizes( child_theme_get_config( 'image-sizes' ) );
	child_theme_add_post_type_supports( child_theme_get_config( 'post-type-support' ) );

}