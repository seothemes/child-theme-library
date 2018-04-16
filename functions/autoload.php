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

namespace SEOThemes\ChildThemeLibrary\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

/**
 * Load theme files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload() {

	$files     = glob( CHILD_THEME_DIR . '/lib/**/*.php' );

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
