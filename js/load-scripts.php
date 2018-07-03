<?php
/**
 * Child Theme Library
 *
 * WARNING: This file is a part of the core Child Theme Library.
 * DO NOT edit this file under any circumstances. Please use
 * the functions.php file to make any theme modifications.
 *
 * @package   SEOThemes\ChildThemeLibrary\JS
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0-or-later
 */

namespace SEOThemes\ChildThemeLibrary\JS;

use function SEOThemes\ChildThemeLibrary\Utilities\get_config;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die;

}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load', 99 );
/**
 * Enqueue theme scripts.
 *
 * @since  1.0.0
 *
 * @return void
 */
function load() {

	$scripts = get_config( 'scripts' );

	foreach ( $scripts as $script => $params ) {

		wp_enqueue_script( 'child-theme-' . $script, $params['src'], explode( ',', $params['deps'] ), $params['ver'], $params['in_footer'] );

	}

}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\menu_settings', 99 );
/**
 * Localizes the responsive menu script
 *
 * @since 1.0.0
 *
 * @return void
 */
function menu_settings() {

	$menu_settings = get_config( 'responsive-menu' );

	wp_localize_script( 'child-theme-menu', 'genesis_responsive_menu', $menu_settings );

}

add_action( 'genesis_before', __NAMESPACE__ . '\js_nojs', 1 );
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
function js_nojs() {
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
