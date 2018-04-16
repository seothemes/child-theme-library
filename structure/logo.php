<?php
/**
 * Genesis Starter Theme
 *
 * This file adds the hero section to the Genesis Starter theme.
 *
 * @package   SEOThemes\GenesisStarter
 * @link      https://seothemes.com/themes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\GenesisStarter\Structure;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

// Display custom logo in site title area.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );
