<?php
/**
 * Child Theme Library
 *
 * WARNING: This file is a part of the core Child Theme Library.
 * DO NOT edit this file under any circumstances. Please use
 * the functions.php file to make any theme modifications.
 *
 * @package   SEOThemes\ChildThemeLibrary
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0-or-later
 */

namespace SEOThemes\ChildThemeLibrary;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die;

}

/**
 * Adds enqueueing logic to child theme.
 *
 * @since 1.4.0
 */
class Enqueue {

	/**
	 * Child theme object.
	 *
	 * @since 1.4.0
	 *
	 * @var   object
	 */
	public $theme;

	/**
	 * Constructor.
	 *
	 * @since  1.4.0
	 *
	 * @param  object $theme Child theme object.
	 *
	 * @return void
	 */
	public function __construct( $theme ) {

		$this->theme = $theme;

		add_action( 'genesis_meta', [
			$this,
			'style_trump'
		], 0 );
		add_action( 'wp_enqueue_scripts', [
			$this,
			'load_css'
		], 10 );
		add_action( 'wp_enqueue_scripts', [
			$this,
			'load_js'
		], 99 );
		add_action( 'wp_enqueue_scripts', [
			$this,
			'menu_settings'
		], 99 );
		add_action( 'genesis_before', [
			$this,
			'js_nojs'
		], 1 );

	}

	/**
	 * Loads child theme style sheet after plugin style sheets.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function style_trump() {

		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
		add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

	}

	/**
	 * Enqueue theme styles.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function load_css() {

		$config = $this->theme->config;

		foreach ( $config['styles'] as $style => $params ) {

			wp_enqueue_style( 'child-theme-' . $style, $params['src'], $params['deps'], $params['ver'], $params['media'] );

		}

		foreach ( $config['google-fonts'] as $google_font ) {

			$google_fonts[] = $google_font;

		}

		wp_enqueue_style( 'child-theme-google-fonts', '//fonts.googleapis.com/css?family=' . implode( '|', $google_fonts ), array(), $this->theme->version );

	}

	/**
	 * Enqueue theme scripts.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function load_js() {

		$scripts = $this->theme->config['scripts'];

		foreach ( $scripts as $script => $params ) {

			wp_enqueue_script( 'child-theme-' . $script, $params['src'], explode( ',', $params['deps'] ), $params['ver'], $params['in_footer'] );

		}

	}

	/**
	 * Localizes the responsive menu script
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function menu_settings() {

		$menu_settings = $this->theme->config['responsive-menu'];

		wp_localize_script( 'child-theme-menu', 'genesis_responsive_menu', $menu_settings );

	}

	/**
	 * Echo out the script that changes 'no-js' class to 'js'.
	 *
	 * Adds a script on the genesis_before hook which immediately changes the
	 * class to js if JavaScript is enabled. This is how WP does things on
	 * the back end, to allow different styles for the same elements
	 * depending if JavaScript is active or not.
	 *
	 * Outputting the script immediately also reduces a flash of incorrectly
	 * styled content, as the page does not load with no-js styles, then
	 * switch to js once everything has finished loading.
	 *
	 * @since  1.0.0
	 *
	 * @author Gary Jones
	 * @link   https://github.com/GaryJones/genesis-js-no-js
	 *
	 * @return void
	 */
	public function js_nojs() {

		?>
		<script>
			//<![CDATA[
			(function () {
				var c = document.body.classList;
				c.remove('no-js');
				c.add('js');
			})();
			//]]>
		</script>
		<?php

	}

}
