<?php
/**
 * Genesis Starter Theme
 *
 * This file contains the core functionality for the Genesis Starter theme.
 *
 * @package   SEOThemes\Library\Functions
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', 'child_theme_load_scripts', 99 );
/**
 * Enqueue theme scripts and styles.
 *
 * @since  1.0.0
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_load_scripts() {

	$scripts = child_theme_get_config( 'scripts' );

	foreach ( $scripts as $script => $params ) {

		wp_enqueue_script( 'child-theme-' . $script, $params['src'], $params['deps'], $params['ver'], $params['in_footer'] );

	}

}

add_action( 'wp_enqueue_scripts', 'child_theme_menu_settings', 99 );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @throws \Exception If no sub-config is found.
 *
 * @return void
 */
function child_theme_menu_settings() {

	$menu_settings = child_theme_get_config( 'responsive-menu' );

	wp_localize_script( CHILD_THEME_HANDLE . '-menu', 'genesis_responsive_menu', $menu_settings );

}

add_action( 'genesis_before', 'child_theme_js_nojs_script', 1 );
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
function child_theme_js_nojs_script() {
	?>
	<script>
        //<![CDATA[
        (function(){
            var c = document.body.classList;
            c.remove( 'no-js' );
            c.add( 'js' );
        })();
        //]]>
	</script>
	<?php
}
