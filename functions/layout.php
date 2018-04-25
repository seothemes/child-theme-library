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

namespace SEOThemes\Library\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'init', __NAMESPACE__ . '\structural_wrap_hooks' );
/**
 * Add hooks immediately before and after Genesis structural wraps.
 *
 * @since   2.3.0
 *
 * @version 1.1.0
 * @author  Tim Jensen
 * @link    https://timjensen.us/add-hooks-before-genesis-structural-wraps
 *
 * @return void
 */
function structural_wrap_hooks() {

	$wraps = get_theme_support( 'genesis-structural-wraps' );

	foreach ( $wraps[0] as $context ) {

		/**
		 * Inserts an action hook before the opening div and after the closing div
		 * for each of the structural wraps.
		 *
		 * @param string $output   HTML for opening or closing the structural wrap.
		 * @param string $original Either 'open' or 'close'.
		 *
		 * @return string
		 */
		add_filter( "genesis_structural_wrap-{$context}", function ( $output, $original ) use ( $context ) {

			$position = ( 'open' === $original ) ? 'before' : 'after';

			ob_start();

			do_action( "genesis_{$position}_{$context}_wrap" );

			if ( 'open' === $original ) {

				return ob_get_clean() . $output;

			} else {

				return $output . ob_get_clean();

			}

		}, 10, 2 );

	}

}

add_filter( 'genesis_site_layout', __NAMESPACE__ . '\search_page_layout' );
/**
 * Gets a custom page layout for the search results page.
 *
 * @since 2.2.7
 *
 * @return string
 */
function search_page_layout() {

	if ( is_search() ) {

		$page   = get_page_by_path( 'search' );
		$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
		$layout = $field ? $field : genesis_get_option( 'site_layout' );

		return $layout;

	}

}

add_filter( 'genesis_site_layout', __NAMESPACE__ . '\error_404_page_layout' );
/**
 * Gets a custom page layout for the error 404 page.
 *
 * @since 2.2.7
 *
 * @return string
 */
function error_404_page_layout() {

	if ( is_404() ) {

		$page   = get_page_by_path( 'error-404' );
		$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
		$layout = $field ? $field : genesis_get_option( 'site_layout' );

		return $layout;

	}

}
