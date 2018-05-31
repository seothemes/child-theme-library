<?php
/**
 * Genesis Starter Theme
 *
 * This file adds extra functions used in the Genesis Starter theme.
 *
 * @package   SEOThemes\Library
 * @link      https://github.com/seothemes/seothemes-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

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

add_action( 'after_switch_theme', 'child_theme_display_excerpt_metabox' );
/**
 * Display excerpt metabox by default.
 *
 * The excerpt metabox is hidden by default on the page edit screen which can cause
 * confusion for some users if they want to edit or remove the excerpt. To make
 * it easier, we want to show the excerpt metabox by default. It only runs
 * after switching theme so the current user's screen options are
 * updated, allowing them to hide the metabox if not used.
 *
 * @since  2.2.1
 *
 * @return void
 */
function child_theme_display_excerpt_metabox() {

	$user_id = get_current_user_id();

	$post_types = array(
		'page',
		'post',
		'portfolio',
	);

	foreach ( $post_types as $post_type ) {

		$meta_key   = 'metaboxhidden_' . $post_type;
		$prev_value = get_user_meta( $user_id, $meta_key, true );

		if ( ! is_array( $prev_value ) ) {

			$prev_value = array(
				'genesis_inpost_seo_box',
				'postcustom',
				'postexcerpt',
				'commentstatusdiv',
				'commentsdiv',
				'slugdiv',
				'authordiv',
				'genesis_inpost_scripts_box',
			);

		}

		$meta_value = array_diff( $prev_value, array( 'postexcerpt' ) );

		update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );

	}

}
