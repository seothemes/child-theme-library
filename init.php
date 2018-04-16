<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\GenesisStarter
 * @link      https://seothemes.com/themes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\GenesisStarter;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

// Store the theme object.
$child_theme = wp_get_theme();

// Initialize the theme's constants.
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'CHILD_ASSETS_DIR', CHILD_THEME_DIR . '/assets/' );
define( 'CHILD_CONFIG_DIR', CHILD_THEME_DIR . '/config/' );
define( 'CHILD_LIB_DIR', CHILD_THEME_DIR . '/lib/' );
define( 'CHILD_THEME_PREFIX', str_replace( '-', '_', CHILD_TEXT_DOMAIN ) );

// Store the theme config.
$child_theme_config = require_once( CHILD_THEME_DIR . '/config/theme.php' );

// Get the autoload class.
require_once CHILD_THEME_DIR . '/lib/functions/autoload.php';
