<?php
/**
 * Genesis Starter Theme
 *
 * This file adds extra functions used in the Genesis Starter theme.
 *
 * @package   SEOThemes\GenesisStarter
 * @link      https://seothemes.com/themes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\ThemeLibrary\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_head', __NAMESPACE__ . '\remove_ssi_inline_styles', 1 );
/**
 * Remove Simple Social Icons inline CSS.
 *
 * No longer needed because we are generating custom CSS instead so removing this
 * means that we don't need to use !important rules in the function below.
 *
 * @since  2.0.0
 *
 * @return void
 */
function remove_ssi_inline_styles() {

	global $wp_widget_factory;

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['Simple_Social_Icons_Widget'], 'css' ) );

}

add_action( 'wp_head', __NAMESPACE__ . '\simple_social_icons_css' );
/**
 * Simple Social Icons multiple instances workaround.
 *
 * By default, Simple Social Icons only allows you to create one style for your
 * icons, even if you have multiple on one page. This function allows us to
 * output different styles for each widget displayed on the front end.
 *
 * @since  2.0.0
 *
 * @return void
 */
function simple_social_icons_css() {

	if ( ! class_exists( 'Simple_Social_Icons_Widget' ) ) {

		return;

	}

	$obj = new \Simple_Social_Icons_Widget();

	// Get widget settings.
	$all_instances = $obj->get_settings();

	// Loop through instances.
	foreach ( $all_instances as $key => $options ) :

		$instance = wp_parse_args( $all_instances[ $key ] );
		$font_size = round( (int) $instance['size'] / 2 );
		$icon_padding = round( (int) $font_size / 2 );

		// CSS to output.
		$css = '#' . $obj->id_base . '-' . $key . ' ul li a,
		#' . $obj->id_base . '-' . $key . ' ul li a:hover {
			background-color: ' . $instance['background_color'] . ';
			border-radius: ' . $instance['border_radius'] . 'px;
			color: ' . $instance['icon_color'] . ';
			border: ' . $instance['border_width'] . 'px ' . $instance['border_color'] . ' solid;
			font-size: ' . $font_size . 'px;
			padding: ' . $icon_padding . 'px;
		}
		
		#' . $obj->id_base . '-' . $key . ' ul li a:hover {
			background-color: ' . $instance['background_color_hover'] . ';
			border-color: ' . $instance['border_color_hover'] . ';
			color: ' . $instance['icon_color_hover'] . ';
		}';

		// Minify.
		$css = \SEOThemes\GenesisStarter\Functions\minify_css( $css );

		// Output.
		printf( '<style type="text/css" media="screen">%s</style>', $css );

	endforeach;

}
