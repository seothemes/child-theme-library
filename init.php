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

namespace SEOThemes\Core;

use SEOThemes\Core\Functions;
use SEOThemes\Core\Functions\Utils;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\init', 10 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init() {

	/**
	 * Hooks.
	 *
	 * @hooked SEOThemes\Core\constants - 0
	 * @hooked SEOThemes\Core\autoload  - 5
	 * @hooked SEOThemes\Core\setup     - 10
	 */
	do_action( 'child_theme_init' );

}

add_action( 'child_theme_init', __NAMESPACE__ . '\constants', 0 );
/**
 * Defines the child theme constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function constants() {

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

add_action( 'child_theme_init', __NAMESPACE__ . '\autoload', 5 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @throws \Exception If too many files are loaded.
 *
 * @return void
 */
function autoload() {

	require_once CHILD_THEME_LIB . '/functions/autoload.php';

	Functions\autoload( CHILD_THEME_LIB . '/functions' );
	Functions\autoload( CHILD_THEME_LIB . '/structure' );
	Functions\autoload( CHILD_THEME_LIB . '/admin'     );

}

add_action( 'child_theme_init', __NAMESPACE__ . '\setup', 10 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function setup() {

	require_once CHILD_THEME_LIB . '/functions/setup.php';

	Functions\add_theme_supports(     Utils\get_config( 'theme-support'     ) );
	Functions\add_theme_layouts(      Utils\get_config( 'layouts'           ) );
	Functions\add_theme_widget_areas( Utils\get_config( 'widget-areas'      ) );
	Functions\add_theme_image_sizes(  Utils\get_config( 'image-sizes'       ) );
	Functions\add_post_type_supports( Utils\get_config( 'post-type-support' ) );

}