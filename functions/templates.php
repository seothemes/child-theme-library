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

namespace SEOThemes\Library\Functions;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_filter( 'theme_page_templates', __NAMESPACE__ . '\add_page_templates' );
/**
 * Add page templates.
 *
 * Removes default Genesis templates then loads library templates defined in
 * the child theme's config file.
 *
 * @since  1.0.0
 *
 * @param  array $page_templates The existing page templates.
 *
 * @return array
 */
function add_page_templates( $page_templates ) {

	global $child_theme_config;

	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );

	$page_templates = array_merge( $page_templates, $child_theme_config['page-templates'] );

	return $page_templates;

}

add_filter( 'template_include', __NAMESPACE__ . '\set_page_template' );
/**
 * Modify page based on selected page template.
 *
 * @since  1.0.0
 *
 * @param  string $template The path to the template being included.
 *
 * @return string
 */
function set_page_template( $template ) {

	global $child_theme_config;

	$page_templates = $child_theme_config['page-templates'];

	if ( ! is_singular( 'page' ) ) {

		return $template;

	}

	$current_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

	if ( ! array_key_exists( $current_template, $page_templates ) ) {

		return $template;

	}

	$template_override = CHILD_THEME_DIR . '/templates/' . $current_template;

	if ( file_exists( $template_override ) ) {

		$template = $template_override;

	} else {

		$template_path = CHILD_THEME_LIB . '/templates/' . $current_template;

		if ( file_exists( $template_path ) ) {

			$template = $template_path;

		}
	}

	return $template;

}
