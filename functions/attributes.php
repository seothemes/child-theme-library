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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_filter( 'body_class', 'child_theme_body_class' );
/**
 * Add custom body classes.
 *
 * @since  1.0.0
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

	$classes[] = 'no-js';

	return $classes;

}

add_filter( 'genesis_attr_title-area', 'child_theme_title_area_schema' );
/**
 * Add schema microdata to title-area.
 *
 * @since  1.0.0
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
 * @since  1.0.0
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
 * @since  1.0.0
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
 * @since  1.0.0
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

add_filter( 'genesis_attr_site-container', 'child_theme_primary_nav_id' );
/**
 * Add 'top' ID attribute to site-container.
 *
 * This adds an ID attribute to the site-container by filtering the element
 * attributes so that the "Return to Top" link has something to link to.
 *
 * @since  1.0.0
 *
 * @param  array $atts Navigation attributes.
 *
 * @return array
 */
function child_theme_primary_nav_id( $atts ) {

	$atts['id'] = 'top';

	return $atts;

}
