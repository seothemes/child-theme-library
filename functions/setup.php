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

/**
 * Add theme text domain.
 *
 * @since  1.0.0
 *
 * @param  array      $config Config to consume.
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_textdomain( $config ) {

	// Set Localization (do not remove).
	load_child_theme_textdomain( $config['domain'], $config['path'] );

}

/**
 * Add theme supports.
 *
 * @since  1.0.0
 *
 * @param  array      $config Config to consume.
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_theme_supports( $config ) {

	foreach ( $config as $feature => $args ) {

		add_theme_support( $feature, $args );

	}

}

/**
 * Add theme layouts.
 *
 * @since  1.0.0
 *
 * @param  array      $config Config to consume.
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_layouts( $config ) {

	foreach ( $config as $layout ) {

		genesis_register_layout( $layout );

	}

}

/**
 * Add new image sizes.
 *
 * @since  1.0.0
 *
 * @param  array      $config Config to consume.
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_image_sizes( $config ) {

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
 * @param  array      $config Config to consume.
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_post_type_supports( $config ) {

	foreach ( $config as $post_type => $support ) {

		add_post_type_support( $post_type, $support );

	}

}

/**
 * Add default header image.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_add_default_headers( $config ) {

	register_default_headers( $config );

}