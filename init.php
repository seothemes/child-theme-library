<?php
/**
 * SEOThemes Library
 *
 * This file initializes the SEOThemes Library.
 *
 * @package   SEOThemes\Library
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\Library;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

$child_theme = wp_get_theme();

define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'CHILD_THEME_PREFIX', str_replace( '-', '_', CHILD_TEXT_DOMAIN ) );

$config = require apply_filters( 'child_theme_config', CHILD_THEME_DIR . '/config/theme.php' );

require_once CHILD_THEME_DIR . '/lib/functions/autoload.php';
