<?php
/**
 * Genesis Starter Theme
 *
 * This file adds extra functions used in the Genesis Starter theme.
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

add_filter( 'body_class', 'child_theme_body_class' );
/**
 * Add fixed header class.
 *
 * Checks if theme supports a fixed header and if so, adds a 'fixed-header'
 * class to the body. To enable a fixed header simply add theme support e.g:
 * `add_theme_support( 'fixed-header' );`
 *
 * @since  2.0.0
 *
 * @param  array $classes Body classes.
 *
 * @return array
 */
function child_theme_body_class( $classes ) {

	if ( current_theme_supports( 'fixed-header' ) ) {

		$classes[] = 'has-fixed-header';

	}

	if ( has_nav_menu( 'secondary' ) ) {

		$classes[] = 'has-nav-secondary';

	}

	if ( is_active_sidebar( 'before-header' ) ) {

		$classes[] = 'has-before-header';

	}

	if ( is_page_template( 'page-blog.php' ) ) {

		$classes[] = 'blog';
		$classes = array_diff( $classes, [ 'page' ] );

	}

	$classes[] = str_replace( '.php', '', get_page_template_slug() );

	return $classes;

}

add_filter( 'genesis_attr_title-area', 'child_theme_title_area_schema' );
/**
 * Add schema microdata to title-area.
 *
 * @since  2.2.1
 *
 * @param  array $attr Array of attributes.
 *
 * @return array
 */
function child_theme_title_area_schema( $attr ) {

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/Organization';

	return $attr;

}

add_filter( 'genesis_attr_site-title', 'child_theme_site_title_schema' );
/**
 * Correct site title schema.
 *
 * @since  2.2.1
 *
 * @param  array $attr Array of attributes.
 *
 * @return array
 */
function child_theme_site_title_schema( $attr ) {

	$attr['itemprop'] = 'name';

	return $attr;
}

add_filter( 'genesis_attr_hero-section', 'child_theme_hero_section_attr' );
/**
 * Callback for dynamic Genesis 'genesis_attr_$context' filter.
 *
 * Add custom attributes for the custom filter.
 *
 * @since  3.0.0
 *
 * @param  array $attr The element attributes.
 *
 * @return array
 */
function child_theme_hero_section_attr( $attr ) {

	$attr['id']   = 'hero-section';
	$attr['role'] = 'banner';

	return $attr;

}

add_filter( 'genesis_attr_entry', 'child_theme_entry_attr' );
/**
 * Add itemref attribute to link entry-title.
 *
 * Since the entry-title is repositioned outside of the entry article, we need
 * to add some additional microdata so that it is still picked up as a part
 * of the entry. By adding the itemref attribute, we are telling search
 * engines to check the hero-section element for additional elements.
 *
 * @since  2.2.4
 *
 * @link   https://www.w3.org/TR/microdata/#dfn-itemref
 * @param  array $atts Entry attributes.
 *
 * @return array
 */
function child_theme_entry_attr( $atts ) {

	$atts['itemref'] = 'hero-section';

	return $atts;

}
