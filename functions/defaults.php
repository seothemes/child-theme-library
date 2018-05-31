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

add_filter( 'genesis_theme_settings_defaults', 'child_theme_set_default_settings' );
/**
 * Update Theme Settings upon reset.
 *
 * @since  1.0.0
 *
 * @param  array $defaults Default theme settings.
 *
 * @throws \Exception If no sub-config found.
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
 * @throws \Exception If no sub-config found.
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
