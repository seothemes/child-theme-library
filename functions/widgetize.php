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
 * Front page widgets.
 *
 * @since  1.0.0
 *
 * @return void
 */
function front_page_widgets() {

	global $config;

	for ( $i = 1; $i <= $config['front-page-widgets'] ; $i++ ) {

		$args['id']           = 'front-page-' . $i;
		$args['name']         = __( 'Front Page ', CHILD_TEXT_DOMAIN ) . $i;
		$args['description']  = __( 'Front page widget area.', CHILD_TEXT_DOMAIN );

		if ( 1 === $i ) {
			$args['before_title'] = '<h1 itemprop="headline">';
			$args['after_title']  = '</h1>';
		}

		genesis_register_sidebar( $args );

	}

}
