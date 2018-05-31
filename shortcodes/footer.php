<?php
/**
 * Description.
 *
 * @package   ${NAMESPACE}
 * @since     1.0.0
 * @link      https://github.com/seothemes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

add_shortcode( 'footer_backtotop', 'child_theme_footer_backtotop' );
/**
 * Produces the "Return to Top" link.
 *
 * Supported shortcode attributes are:
 * - after (output after link, default is empty string),
 * - before (output before link, default is empty string),
 * - href (link url, default is fragment identifier '#wrap'),
 * - nofollow (boolean for whether to include rel="nofollow", default is true),
 * - text (Link text, default is 'Return to top of page').
 *
 * Output passes through `child_theme_footer_backtotop` filter before returning.
 *
 * @since  1.0.0
 *
 * @param  array|string $atts Shortcode attributes. Empty string if no attributes.
 *
 * @return string Output for `footer_backtotop` shortcode.
 */
function child_theme_footer_backtotop( $atts ) {

	$defaults = array(
		'after'    => '',
		'before'   => '',
		'href'     => '#top',
		'nofollow' => true,
		'text'     => __( 'Return to top', 'genesis' ),
	);

	$atts     = shortcode_atts( $defaults, $atts, 'footer_backtotop' );
	$nofollow = $atts['nofollow'] ? 'rel="nofollow"' : '';
	$output   = sprintf( '%s<a href="%s" %s>%s</a>%s', $atts['before'], esc_url( $atts['href'] ), $nofollow, $atts['text'], $atts['after'] );

	return apply_filters( 'child_theme_footer_backtotop', $output, $atts );

}
