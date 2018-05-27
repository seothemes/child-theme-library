<?php
/**
 * Genesis Starter Theme
 *
 * This file adds extra functions used in the Genesis Starter theme.
 *
 * @package   SEOThemes\Core
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', 'child_theme_customizer_output', 100 );
/**
 * Output customizer styles.
 *
 * Checks the settings for the colors defined in the settings.
 * If any of these value are set the appropriate CSS is output.
 *
 * @var array $colors Global theme colors.
 */
function child_theme_customizer_output() {

	$colors = child_theme_get_config( 'colors' );

	/**
	 * Loop though each color in the global array of theme colors and create a new
	 * variable for each. This is just a shorthand way of creating multiple
	 * variables that we can reuse. The benefit of using a foreach loop
	 * over creating each variable manually is that we can just
	 * declare the colors once in the `$colors` array, and
	 * they can be used in multiple ways.
	 */
	foreach ( $colors as $id => $hex ) {

		${"$id"} = get_theme_mod( str_replace( '-', '_', CHILD_THEME_HANDLE ) . "_{$id}_color",  $hex );

	}

	// Ensure $css var is empty.
	$css = '';

	/**
	 * Build the CSS.
	 *
	 * We need to concatenate each one of our colors to the $css variable, but first
	 * check if the color has been changed by the user from the theme customizer.
	 * If the theme mod is not equal to the default color then the string is
	 * appended to $css.
	 */
	$css .= ( $colors['primary'] !== $primary ) ? sprintf( '

		.button:hover,
		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.button.secondary,
		button.secondary,
		.archive-pagination a:hover,
		.archive-pagination .active a,
		.sidebar-primary .widget:first-of-type input[type="button"],
		.sidebar-primary .widget:first-of-type input[type="submit"] {
			background-color: %1$s;
		}

		a,
		.entry-title a:hover,
		.menu-item a:hover,
		.menu-item.current-menu-item > a {
			color: %1$s;
		}

		', $primary ) : '';

	$css .= ( $colors['secondary'] !== $secondary ) ? sprintf( '

		.hero-section:before {
			background-color: %1$s;
		}

		', $secondary ) : '';

	// Style handle is the name of the theme.
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	// Output CSS if not empty.
	if ( ! empty( $css ) ) {

		// Add the inline styles, also minify CSS first.
		wp_add_inline_style( $handle, child_theme_minify_css( $css ) );

	}

}
