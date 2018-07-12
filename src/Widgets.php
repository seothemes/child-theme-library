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
 * Adds widgets logic to child theme.
 *
 * @since 1.4.0
 */
class Widgets {

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

		$this->enable_shortcodes();

		add_action( 'widgets_init', [
			$this,
			'unregister'
		] );

	}

	/**
	 * Unregister widgets defined in the config.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function unregister() {

		$config = $this->theme->config['widgets'];

		foreach ( $config as $widget ) {

			unregister_widget( $widget );

		}

	}

	/**
	 * Enables shortcodes in text widgets.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function enable_shortcodes() {

		add_filter( 'widget_text', 'do_shortcode' );

	}

}
