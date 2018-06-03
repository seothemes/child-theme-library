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

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'widgets_init', 'child_theme_unregister_widgets' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @throws \Exception If no sub-config found.
 *
 * @return void
 */
function child_theme_unregister_widgets() {

	$config = child_theme_get_config( 'widgets' );

	foreach ( $config as $widget ) {

		unregister_widget( $widget );

	}

}

add_action( 'after_setup_theme', 'child_theme_add_widget_areas', 11 );
/**
 * Add custom widget areas.
 *
 * @since  1.0.0
 *
 * @throws \Exception if no sub-config found.
 *
 * @return void
 */
function child_theme_add_widget_areas() {

	$config         = child_theme_get_config( 'widget-areas' );
	$footer_widgets = 1;

	unregister_sidebar( 'after-entry' );
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar' );
	unregister_sidebar( 'sidebar-alt' );

	foreach ( $config as $id => $location ) {

		if ( is_numeric( str_replace( 'footer-', '', $id ) ) ) {

			add_theme_support( 'genesis-footer-widgets', $footer_widgets++ );

		} else {

			$name        = ucwords( str_replace( '-', ' ', $id ) );
			$description = $name . ' widget area';

			genesis_register_sidebar( array(
				'name'        => $name,
				'description' => $description,
				'id'          => $id,
			) );

			if ( ! empty( $location ) ) {

				add_action( $location, function() use ($id) {
					genesis_widget_area( $id, array(
						'before' => '<div class="' . $id . ' widget-area"><div class="wrap">',
						'after'  => '</div></div>',
					) );
				} );

			}

		}

	}

}
