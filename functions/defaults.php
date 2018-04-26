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

namespace SEOThemes\Library;

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

	update_option( 'posts_per_page', $child_theme_config['blog_cat_num'] );

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
