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

// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

$child_theme = wp_get_theme();

// Child theme constants.
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_THEME_HANDLE', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_AUTHOR', $child_theme->get( 'Author' ) );
define( 'CHILD_THEME_PREFIX', str_replace( '-', '_', CHILD_THEME_HANDLE ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'CHILD_THEME_LIB', CHILD_THEME_DIR . '/lib' );
define( 'CHILD_THEME_CONFIG', CHILD_THEME_DIR . '/config/theme.php' );
define( 'CHILD_THEME_VENDOR', CHILD_THEME_DIR . '/vendor' );
define( 'CHILD_THEME_SCRIPTS', CHILD_THEME_URI . '/assets/scripts' );
define( 'CHILD_THEME_STYLES', CHILD_THEME_URI . '/assets/styles' );
define( 'CHILD_THEME_IMAGES', CHILD_THEME_URI . '/assets/images' );

$child_theme_config = require apply_filters( 'child_theme_config', CHILD_THEME_CONFIG );

require_once CHILD_THEME_LIB . '/functions/autoload.php';
