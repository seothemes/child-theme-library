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

add_filter( 'genesis_site_layout', 'child_theme_search_page_layout' );
/**
 * Gets a custom page layout for the search results page.
 *
 * @since  1.0.0
 *
 * @return string
 */
function child_theme_search_page_layout() {

	if ( is_search() ) {

		$page   = get_page_by_path( 'search' );
		$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
		$layout = $field ? $field : genesis_get_option( 'site_layout' );

		return $layout;

	}

}

add_filter( 'genesis_site_layout', 'child_theme_error_404_page_layout' );
/**
 * Gets a custom page layout for the error 404 page.
 *
 * @since  1.0.0
 *
 * @return string
 */
function child_theme_error_404_page_layout() {

	if ( is_404() ) {

		$page   = get_page_by_path( 'error-404' );
		$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
		$layout = $field ? $field : genesis_get_option( 'site_layout' );

		return $layout;

	}

}
