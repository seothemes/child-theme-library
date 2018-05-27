<?php
/**
 * Description.
 *
 * @package   SEOThemes\Core\Classes
 * @since     1.0.0
 * @link      https://github.com/seothemes/genesis-starter
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\Core\Classes;

class Demo_Import {

	public function __construct() {

		add_filter( 'pt-ocdi/import_files', array( $this, 'demo_import_settings' ) );
		add_filter( 'pt-ocdi/after_all_import_execution', array( $this, 'after_demo_import' ), 99 );

	}

	/**
	 * One click demo import settings.
	 *
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public function demo_import_settings() {

		return array(
			array(
				'local_import_file'            => CHILD_THEME_DIR . '/sample.xml',
				'local_import_widget_file'     => CHILD_THEME_DIR . '/widgets.wie',
				'local_import_customizer_file' => CHILD_THEME_DIR . '/customizer.dat',
				'import_file_name'             => 'Demo Import',
				'categories'                   => false,
				'local_import_redux'           => false,
				'import_preview_image_url'     => false,
				'import_notice'                => false,
			),
		);

	}

	/**
	 * Set default pages after demo import.
	 *
	 * Automatically creates and sets the Static Front Page and the Page for Posts
	 * upon theme activation, only if these pages don't already exist and only
	 * if the site does not already display a static page on the homepage.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function after_import() {

		// Assign menus to their locations.
		$menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );
		$home = get_page_by_title( 'Home' );
		$blog = get_page_by_title( 'Blog' );
		$shop = get_page_by_title( 'Shop' );

		if ( $menu ) {

			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $menu->term_id,
			) );

		}

		if ( $home && $blog ) {

			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front',  $home->ID );
			update_option( 'page_for_posts', $blog->ID );

		}

		if ( $shop ) {

			update_option( 'woocommerce_shop_page_id', $shop->ID );

		}

		// Trash "Hello World" post.
		wp_delete_post( 1 );

		// Update permalink structure.
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$wp_rewrite->flush_rules();

	}

}