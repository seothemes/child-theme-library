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

/**
 * Adds default settings logic to child theme.
 *
 * @since 1.4.0
 */
class Defaults {

	/**
	 * Child theme config.
	 *
	 * @since 1.4.0
	 *
	 * @var   array
	 */
	public $config;

	/**
	 * Defaults constructor.
	 *
	 * @since  1.4.0
	 *
	 * @param  object $theme Child theme object.
	 *
	 * @return void
	 */
	public function __construct( $theme ) {

		$this->config = $theme->config;

	}

	/**
	 * Initialize class.
	 *
	 * @since  1.5.0
	 *
	 * @return void
	 */
	public function init() {

		add_filter( 'genesis_theme_settings_defaults', [ $this, 'set' ] );
		add_action( 'after_switch_theme', [ $this, 'update' ] );

	}

	/**
	 * Set default theme settings.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $defaults Default theme settings.
	 *
	 * @return array
	 */
	public function set( array $defaults ) {

		$defaults = wp_parse_args( $this->config['genesis-settings'], $defaults );

		return $defaults;

	}

	/**
	 * Update theme settings upon activation.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function update() {

		if ( function_exists( 'genesis_update_settings' ) ) {

			genesis_update_settings( $this->config['genesis-settings'] );

		}

		if ( $this->config['genesis-settings']['blog_cat_num'] ) {

			update_option( 'posts_per_page', $this->config['genesis-settings']['blog_cat_num'] );

		}

	}

}
