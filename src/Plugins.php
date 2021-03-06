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
 * Adds plugins logic to child theme.
 *
 * @since 1.4.0
 */
class Plugins {

	/**
	 * Child theme object.
	 *
	 * @since 1.4.0
	 *
	 * @var   object
	 */
	public $theme;

	/**
	 * Child theme config.
	 *
	 * @since 1.4.0
	 *
	 * @var   array
	 */
	public $config;

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

		$this->theme  = $theme;
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

		add_action( 'genesis_setup', [ $this, 'activation' ] );
		add_action( 'tgmpa_register', [ $this, 'required' ] );
		add_action( 'wp_head', [ $this, 'remove_simple_social_inline_css' ], 1 );
		add_action( 'wp_head', [ $this, 'add_simple_social_inline_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'remove_plugin_css' ] );
		add_filter( 'simple_social_default_styles', [ $this, 'simple_social_defaults' ] );
		add_filter( 'genesis_widget_column_classes', [ $this, 'add_widget_columns' ] );
		add_filter( 'gsw_settings_defaults', [ $this, 'testimonial_defaults' ] );

	}

	/**
	 * Disable third party CSS that is included in theme.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function remove_plugin_css() {

		add_filter( 'gs_faq_print_styles', '__return_false' );
		add_filter( 'genesis_portfolio_load_default_styles', '__return_false' );

	}

	/**
	 * Checks if TGMPA is available.
	 *
	 * @since  1.4.0
	 *
	 * @return bool
	 */
	public function is_tgmpa_active() {

		$file = $this->theme->dir . '/vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php';

		return ( file_exists( $file ) ? true : false );

	}

	/**
	 * Instantiate the plugin activation class.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function activation() {

		if ( $this->is_tgmpa_active() ) {

			new \TGM_Plugin_Activation();

		}

	}

	/**
	 * Register required plugins.
	 *
	 * The variables passed to the `is_tgmpa_active()` function should be:
	 *
	 * - an array of plugin arrays;
	 * - optionally a configuration array.
	 *
	 * If you are not changing anything in the configuration array, you can
	 * remove the array and remove the variable from the function call: `tgmpa(
	 * $plugins );`. In that case, the TGMPA default settings will be used.
	 *
	 * This function is hooked into `tgmpa_register`, which is fired on the WP
	 * `init` action on priority 10.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function required() {

		if ( ! $this->is_tgmpa_active() ) {

			return;

		}

		$plugins = $this->config['plugins'];

		if ( class_exists( 'WooCommerce' ) ) {

			$plugins[] = array(
				'name'     => 'Genesis Connect WooCommerce',
				'slug'     => 'genesis-connect-woocommerce',
				'required' => true,
			);

		}

		$plugin_config = array(
			'id'           => $this->theme->handle,
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

	/**
	 * Simple Social Icons default settings.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $defaults Default Simple Social Icons settings.
	 *
	 * @return array Custom settings.
	 */
	public function simple_social_defaults( $defaults ) {

		return wp_parse_args( $this->config['simple-social-icons'], $defaults );

	}

	/**
	 * Remove Simple Social Icons inline CSS.
	 *
	 * No longer needed because we are generating custom CSS instead so removing
	 * this means we don't need to use !important rules in the function below.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function remove_simple_social_inline_css() {

		global $wp_widget_factory;

		remove_action( 'wp_head', [ $wp_widget_factory->widgets['Simple_Social_Icons_Widget'], 'css' ] );

	}

	/**
	 * Simple Social Icons multiple instances workaround.
	 *
	 * By default, Simple Social Icons only allows you to create one style for
	 * your icons, even if you have multiple on one page. This function allows
	 * us to output different styles for each widget displayed on the front
	 * end.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function add_simple_social_inline_css() {

		if ( ! class_exists( 'Simple_Social_Icons_Widget' ) ) {

			return;

		}

		$obj = new \Simple_Social_Icons_Widget();

		$all_instances = $obj->get_settings();

		foreach ( $all_instances as $key => $options ) :

			$instance     = wp_parse_args( $all_instances[ $key ] );
			$font_size    = round( (int) $instance['size'] / 2 );
			$icon_padding = round( (int) $font_size / 2 );

			$css = '#' . $obj->id_base . '-' . $key . ' ul li a,
		#' . $obj->id_base . '-' . $key . ' ul li a:hover {
			background-color: ' . $instance['background_color'] . ';
			border-radius: ' . $instance['border_radius'] . 'px;
			color: ' . $instance['icon_color'] . ';
			border: ' . $instance['border_width'] . 'px ' . $instance['border_color'] . ' solid;
			font-size: ' . $font_size . 'px;
			padding: ' . $icon_padding . 'px;
		}

		#' . $obj->id_base . '-' . $key . ' ul li a:hover {
			background-color: ' . $instance['background_color_hover'] . ';
			border-color: ' . $instance['border_color_hover'] . ';
			color: ' . $instance['icon_color_hover'] . ';
		}';

			$css = $this->theme->utilities->minify_css( $css );

			printf( '<style type="text/css" media="screen">%s</style>', $css ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Input is escaped through plugin.

		endforeach;

	}

	/**
	 * Add additional column class to plugin.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $column_classes Array of column classes.
	 *
	 * @return array Modified column classes.
	 */
	public function add_widget_columns( $column_classes ) {

		$column_classes[] = 'one-fifth';
		$column_classes[] = 'two-fifths';
		$column_classes[] = 'three-fifths';
		$column_classes[] = 'four-fifths';
		$column_classes[] = 'full-width';

		return $column_classes;

	}

	/**
	 * Filter the default Genesis Testimonial Slider settings.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $defaults Default plugin settings.
	 *
	 * @return array
	 */
	public function testimonial_defaults( $defaults ) {

		$config = $this->config['testimonial-slider'];

		return ( $config ? $config : $defaults );

	}

}
