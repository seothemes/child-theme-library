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

add_action( 'after_setup_theme', 'child_theme_register_default_headers' );
/**
 * Register default header image.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_register_default_headers() {

	register_default_headers( array(
		'child' => array(
			'url' => '%2$s/assets/images/hero.jpg',
			'thumbnail_url' => '%2$s/assets/images/hero.jpg',
			'description' => __( 'Hero Image', CHILD_THEME_HANDLE ),
		),
	) );

}

add_filter( 'genesis_theme_settings_defaults', 'child_theme_set_default_settings' );
/**
 * Update Theme Settings upon reset.
 *
 * @since  1.0.0
 *
 * @param  array $defaults Default theme settings.
 *
 * @return array Custom theme settings.
 */
function child_theme_set_default_settings( array $defaults ) {

	$child_theme_config = child_theme_get_config();

	$defaults = wp_parse_args( $child_theme_config['genesis-settings'], $defaults );

	return $defaults;

}

add_action( 'after_switch_theme', 'child_theme_update_settings' );
/**
 * Update Theme Settings upon activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function child_theme_update_settings() {

	$child_theme_config = child_theme_get_config();

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( $child_theme_config['genesis-settings'] );

	}

	update_option( 'posts_per_page', $child_theme_config['blog_cat_num'] );

}


add_filter( 'simple_social_default_styles', 'child_theme_ssi_default_styles' );
/**
 * Simple Social Icons default settings.
 *
 * @since  1.0.0
 *
 * @param  array $defaults Default Simple Social Icons settings.
 *
 * @return array Custom settings.
 */
function child_theme_ssi_default_styles( $defaults ) {

	$child_theme_config = child_theme_get_config();

	$defaults = wp_parse_args( $child_theme_config['simple-social-icons'], $defaults );

	return $defaults;

}
