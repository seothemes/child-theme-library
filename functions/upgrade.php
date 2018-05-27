<?php
/**
 * Genesis Starter Theme
 *
 * This file adds extra functions used in the Genesis Starter theme.
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

add_filter( 'http_request_args', 'child_theme_dont_update_theme', 5, 2 );
/**
 * Don't Update Theme.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @since  2.0.0
 *
 * @param  array  $request Request arguments.
 * @param  string $url     Request url.
 *
 * @return array  request arguments
 */
function child_theme_dont_update_theme( $request, $url ) {

	 // Not a theme update request. Bail immediately.
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) ) {
		return $request;
	}

	$themes = unserialize( $request['body']['themes'] );

	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );

	$request['body']['themes'] = serialize( $themes );

	return $request;

}
