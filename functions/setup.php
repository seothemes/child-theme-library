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

namespace SEOThemes\Core\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

/**
 * Sets up the theme.
 *
 * @since  2.6.0
 *
 * @return void
 */
function setup_theme() {

	// Enable shortcodes in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

}

/**
 * Add theme textdomain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_theme_textdomain() {

	// Set Localization (do not remove).
	load_child_theme_textdomain( CHILD_THEME_HANDLE, apply_filters( 'child_theme_textdomain', CHILD_THEME_LIB . '/languages', CHILD_THEME_HANDLE ) );

}

/**
 * Adds theme supports.
 *
 * @since  2.6.0
 *
 * @param  array $config Theme supports configuration.
 *
 * @return void
 */
function add_theme_supports( array $config ) {

	foreach ( $config as $feature => $args ) {

		add_theme_support( $feature, $args );

	}

}

/**
 * Register theme layouts.
 *
 * @since 1.0.0
 *
 * @param array $config Theme layouts configuration.
 *
 * @return void
 */
function add_theme_layouts( array $config ) {

	foreach ( $config as $layout ) {

		genesis_register_layout( $layout );

	}

}

/**
 * Register widget areas.
 *
 * @since  1.0.0
 *
 * @param  array $config Theme widget areas configuration.
 *
 * @return void
 */
function add_theme_widget_areas( $config ) {

	unregister_sidebar( 'after-entry' );
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar' );
	unregister_sidebar( 'sidebar-alt' );

	foreach ( $config as $widget_area ) {

		$name        = ucwords( str_replace( '-', ' ', $widget_area ) );
		$description = $name . ' widget area';

		genesis_register_sidebar( array(
			'name'        => $name,
			'description' => $description,
			'id'          => $widget_area,
		));

	}

}

/**
 * Add new image sizes.
 *
 * @since  1.0.0
 *
 * @param  array $config Theme image size configuration.
 *
 * @return void
 */
function add_theme_image_sizes( array $config ) {

	foreach ( $config as $name => $args ) {

		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );

	}

}

/**
 * Add post type supports.
 *
 * @since  1.0.0
 *
 * @param  array $config Theme image size configuration.
 *
 * @return void
 */
function add_post_type_supports( array $config ) {

	foreach ( $config as $post_type => $support ) {

		add_post_type_support( $post_type, $support );

	}

}
