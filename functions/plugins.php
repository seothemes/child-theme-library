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

namespace SEOThemes\Library;

add_action( 'tgmpa_register', __NAMESPACE__ . '\required_plugins' );
/**
 * Register required plugins.
 *
 * The variables passed to the `tgmpa()` function should be:
 *
 * - an array of plugin arrays;
 * - optionally a configuration array.
 *
 * If you are not changing anything in the configuration array, you can remove the
 * array and remove the variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init`
 * action on priority 10.
 *
 * @since  1.0.0
 *
 * @return void
 */
function required_plugins() {

	global $child_theme_config;

	$plugins = $child_theme_config['plugins'];

	if ( class_exists( 'WooCommerce' ) ) {

		$plugins[] = array(
			'name'     => 'Genesis Connect WooCommerce',
			'slug'     => 'genesis-connect-woocommerce',
			'required' => true,
		);

	}

	$plugin_config = array(
		'id'           => CHILD_THEME_HANDLE,
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $plugin_config );

}
