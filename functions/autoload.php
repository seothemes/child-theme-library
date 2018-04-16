<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\GenesisStarter
 * @link      https://seothemes.com/themes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\GenesisStarter\Functions;

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

	$files = glob( CHILD_THEME_DIR . '/lib/**/*.php' );

	foreach ( $files as $file ) {

		if ( file_exists( $file ) ) {

			require_once $file;

		}
	}

}

autoload();
