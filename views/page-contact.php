<?php
/**
 * Child Theme Library
 *
 * WARNING: This file is a part of the core Child Theme Library.
 * DO NOT edit this file under any circumstances. Please use
 * the functions.php file to make any theme modifications.
 *
 * Template Name: Contact Page
 *
 * @package   SEOThemes\ChildThemeLibrary\Views
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0-or-later
 */

namespace SEOThemes\ChildThemeLibrary\Views;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die;

}

add_filter( 'body_class', __NAMESPACE__ . '\add_contact_body_class' );
/**
 * Add contact page body class to the head.
 *
 * @since  1.0.0
 *
 * @param  array $classes Array of body classes.
 *
 * @return array
 */
function add_contact_body_class( $classes ) {

	$classes[] = 'contact-page';

	return $classes;

}

add_filter( 'genesis_markup_hero-section_open', __NAMESPACE__ . '\contact_page_map' );
/**
 * Display Google map shortcode.
 *
 * @since  1.0.0
 *
 * @return void
 */
function contact_page_map( $markup ) {

	$markup = str_replace( '<div', do_shortcode( '[ank_google_map]' ) . '<div', $markup );

	return $markup;

}

// Add entry title back inside content.
add_action( 'genesis_entry_header', 'genesis_do_post_title', 2 );

// Run the Genesis loop.
genesis();
