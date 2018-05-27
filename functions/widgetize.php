<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
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

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );
