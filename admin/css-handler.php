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
 * Logic to output customizer styles.
 *
 * @since  1.0.0
 *
 * @return void
 */
function child_theme_customizer_output() {

	$colors = child_theme_get_config( 'colors' );
	$css    = '';

	foreach ( $colors as $color => $values ) {

		$custom_color = get_theme_mod( str_replace( '-', '_', CHILD_THEME_HANDLE ) . "_{$color}_color", $values['hex'] );

		if ( $color !== $custom_color ) {

			foreach ( $values['css'] as $rule ) {

				$counter = 0;

				foreach ( $rule['selectors'] as $selector ) {

					$comma = ( $counter++ === 0 ? '' : ',' );
					$css  .= $comma . $selector;

				}

				$css .= '{';

				foreach ( $rule['properties'] as $property ) {

					$css .= $property . ':' . $values['hex'] . ';';

				}

				$css .= '}';

			}

		}

	}

	if ( ! empty( $css ) ) {

		wp_add_inline_style( CHILD_THEME_HANDLE, child_theme_minify_css( $css ) );

	}

}
