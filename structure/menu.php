<?php
/**
 * Child Theme Library
 *
 * WARNING: This file is a part of the core Child Theme Library.
 * DO NOT edit this file under any circumstances. Please use
 * the functions.php file to make any theme modifications.
 *
 * @package   SEOThemes\ChildThemeLibrary\Functions
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die;

}


add_action( 'genesis_setup', 'child_theme_reposition_nav_menus' );
/**
 * Reposition navigation menus.
 *
 * @since  1.0.0
 *
 * @return void
 */
function child_theme_reposition_nav_menus() {

	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_after_title_area', 'genesis_do_nav' );
	add_action( 'genesis_after_header_wrap', 'genesis_do_subnav' );

}
