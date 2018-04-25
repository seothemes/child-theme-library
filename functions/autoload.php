<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\Library
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\Library\Functions;

use SEOThemes\Library\Functions\Utils;

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

	global $config;

	$files = $config['autoload'];

	//$all = glob( CHILD_THEME_DIR . '/lib/**/*.php' );

	// $backend   = '';
	// $backend  .= CHILD_THEME_DIR . '/lib/admin/*.php';
	// $backend  .= CHILD_THEME_DIR . '/lib/classes/*.php';
	// $backend  .= CHILD_THEME_DIR . '/lib/widgets/*.php';
	// $backend   = glob( $backend, GLOB_BRACE );

	// $frontend  = '';
	// $frontend  = array_diff( $ok, $backend );

	foreach ( (array) $files as $file ) {

		$filename = CHILD_THEME_DIR . '/lib/' . $file . '.php';

		if ( file_exists( $filename ) ) {

			require_once $filename;

		}
	}

}

autoload();
