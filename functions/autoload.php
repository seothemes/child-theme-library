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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

spl_autoload_register( 'child_theme_spl_autoload_register' );
/**
 * Register class autoloader.
 *
 * @since  1.0.0
 *
 * @param  string $class Class to load.
 *
 * @return void
 */
function child_theme_spl_autoload_register( $class ) {

	$file = CHILD_THEME_LIB . "/classes/{$class}.class.php";

	if ( stream_resolve_include_path( $file ) ) {

		include $file;

	}
}

/**
 * Recursively loads all php files in all subdirectories of the given path.
 *
 * @since  1.0.0
 *
 * @param  string $directory Directory of files to autoload.
 *
 * @throws \Exception If too many files are loaded.
 */
function child_theme_autoloader( $directory ) {

	// Get a listing of the current directory.
	$scanned_dir = scandir( $directory );

	if ( empty( $scanned_dir ) ) {
		return;
	}

	if ( count( $scanned_dir ) > 100 ) {
		throw new \Exception( 'Too many files attempted to load via autoload' );
	}

	// Ignore these items from scandir.
	$ignore = [
		'.',
		'..',
	];

	// Remove the ignored items.
	$scanned_dir = array_diff( $scanned_dir, $ignore );

	foreach ( $scanned_dir as $item ) {

		$filename  = $directory . '/' . $item;
		$real_path = realpath( $filename );

		if ( false === $real_path ) {
			continue;
		}

		$filetype = filetype( $real_path );

		if ( empty( $filetype ) ) {
			continue;
		}

		// If it's a directory then recursively load it.
		if ( 'dir' === $filetype ) {

			child_theme_autoload( $real_path );

		} elseif ( 'file' === $filetype ) {

			// Don't allow files that have been uploaded.
			if ( is_uploaded_file( $real_path ) ) {
				continue;
			}

			$filesize = filesize( $real_path );

			// Don't include empty or negative sized files.
			if ( $filesize <= 0 ) {
				continue;
			}

			// Don't include files that are greater than 300kb.
			if ( $filesize > 300000 ) {
				continue;
			}

			$pathinfo = pathinfo( $real_path );

			// An empty filename wouldn't be a good idea.
			if ( empty( $pathinfo['filename'] ) ) {
				continue;
			}

			// Sorry, need an extension.
			if ( empty( $pathinfo['extension'] ) ) {
				continue;
			}

			// Actually, we want just a PHP extension!
			if ( 'php' !== $pathinfo['extension'] ) {
				continue;
			}

			// Only for files that really exist.
			if ( true !== file_exists( $real_path ) ) {
				continue;
			}

			if ( true !== is_readable( $real_path ) ) {
				continue;
			}

			require_once $real_path;
		}
	}
}
