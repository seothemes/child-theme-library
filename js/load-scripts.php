<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\Library\Functions
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', 'child_theme_load_scripts', 99 );
/**
 * Enqueue theme scripts and styles.
 *
 * @since  1.0.0
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_load_scripts() {

	$scripts = child_theme_get_config( 'scripts' );

	foreach ( $scripts as $script ) {

		wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );

	}

}

add_action( 'wp_enqueue_scripts', 'child_theme_menu_settings', 99 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_menu_settings() {

	$menu_settings = child_theme_get_config( 'menu-settings' );

	wp_localize_script( CHILD_THEME_HANDLE . '-menu', 'genesis_responsive_menu', $menu_settings );

}
