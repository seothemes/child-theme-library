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

namespace SEOThemes\GenesisStarter;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\setup_theme', 15 );
/**
 * Sets up the theme.
 *
 * @since  2.6.0
 *
 * @return void
 */
function setup_theme() {

	// Get theme config.
	global $child_theme_config;

	// Add theme textdomain.
	add_theme_textdomain();

	// Add theme support.
	add_theme_supports( $child_theme_config['theme-support'] );

	// Add theme layouts.
	add_theme_layouts( $child_theme_config['layouts'] );

	// Add theme image sizes.
	add_theme_image_sizes( $child_theme_config['image-sizes'] );

	// Remove secondary sidebar.
	unregister_sidebar( 'sidebar-alt' );


	// Enable support for page excerpts.
	add_post_type_support( 'page', 'excerpt' );

	// Enable shortcodes in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

	// Do not load deprecated Genesis functions.
	add_filter( 'genesis_load_deprecated', '__return_false' );

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
	load_child_theme_textdomain( CHILD_TEXT_DOMAIN, apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', CHILD_TEXT_DOMAIN ) );

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

		genesis_unregister_layout( $layout );

	}

}

/**
 * Add new image sizes.
 *
 * @since 1.0.0
 *
 * @param array $config Theme image size configuration.
 *
 * @return void
 */
function add_theme_image_sizes( array $config ) {

	foreach ( $config as $name => $args ) {

		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );

	}

}


add_filter( 'genesis_theme_settings_defaults', __NAMESPACE__ . '\set_theme_default_settings' );
/**
 * Update Theme Settings upon reset.
 *
 * @since  1.0.0
 *
 * @param  array $defaults Default theme settings.
 *
 * @return array Custom theme settings.
 */
function set_theme_default_settings( array $defaults ) {

	global $child_theme_config;

	$defaults = wp_parse_args( $child_theme_config['genesis-settings'], $defaults );

	return $defaults;

}

add_action( 'after_switch_theme', __NAMESPACE__ . '\update_theme_settings' );
/**
 * Update Theme Settings upon activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function update_theme_settings() {

	global $child_theme_config;

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( $child_theme_config['genesis-settings'] );

	}

	update_option( 'posts_per_page', $child_theme_config['genesis-settings']['blog_cat_num'] );

}


add_filter( 'simple_social_default_styles', __NAMESPACE__ . '\ssi_default_styles' );
/**
 * Simple Social Icons default settings.
 *
 * @since  1.0.0
 *
 * @param  array $defaults Default Simple Social Icons settings.
 *
 * @return array Custom settings.
 */
function ssi_default_styles( $defaults ) {

	global $child_theme_config;

	$defaults = wp_parse_args( $child_theme_config['simple-social-icons'], $defaults );

	return $defaults;

}
