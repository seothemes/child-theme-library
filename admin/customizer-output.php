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

	$css       = '';
	$colors    = child_theme_get_config( 'colors' );
	$logo_size = get_theme_mod( 'child_theme_logo_size', '170' );

	$css .= ( '170' !== $logo_size ) ? sprintf( '
		.wp-custom-logo .title-area {
			width: %1$spx;
		}
	', $logo_size ) : '';

	foreach ( $colors as $color => $settings ) {

		$custom_color = get_theme_mod( "child_theme_{$color}_color", $settings['value'] );

		if ( $color !== $custom_color ) {

			foreach ( $settings['css'] as $rule ) {

				$counter = 0;

				foreach ( $rule['selectors'] as $selector ) {

					$comma = ( $counter++ === 0 ? '' : ',' );
					$css  .= $comma . $selector;

				}

				$css .= '{';

				foreach ( $rule['properties'] as $property ) {

					$css .= $property . ':' . $custom_color . ';';

				}

				$css .= '}';

			}

		}

	}

	if ( ! empty( $css ) ) {

		wp_add_inline_style( sanitize_title_with_dashes( CHILD_THEME_NAME ), child_theme_minify_css( $css ) );

	}

}
