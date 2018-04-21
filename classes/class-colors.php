<?php
/**
 * Genesis Starter Theme
 *
 * This file adds the color library to the Genesis Starter theme.
 *
 * @package   SEOThemes\ChildThemeLibrary
 * @link      https://github.com/seothemes/child-theme-library
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

namespace SEOThemes\ChildThemeLibrary\Classes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

/**
 * Corporate Pro Color Class
 *
 * A color utility that helps manipulate HEX colors.
 *
 * @author  Arlo Carreon <http://arlocarreon.com>
 * @link    http://mexitek.github.io/phpColors/
 * @license http://arlo.mit-license.org/
 */
class Color {

	/**
	 * HEX color.
	 *
	 * @var string
	 */
	private $_hex;

	/**
	 * HSL color.
	 *
	 * @var string
	 */
	private $_hsl;

	/**
	 * RGBA color.
	 *
	 * @var string
	 */
	private $_rgb;

	/**
	 * Auto darkens/lightens by 10% for sexily-subtle gradients.
	 * Set this to FALSE to adjust automatic shade to be between given color
	 * and black (for darken) or white (for lighten)
	 */
	const DEFAULT_ADJUST = 10;

	/**
	 * Instantiates the class with a HEX value
	 *
	 * @param  string $hex Hex color.
	 *
	 * @throws Exception   Bad color format.
	 *
	 * @return void
	 */
	function __construct( $hex ) {

		// Strip # sign is present.
		$color = str_replace( '#', '', $hex );

		// Make sure it's 6 digits.
		if ( strlen( $color ) === 3 ) {

			$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];

		} elseif ( strlen( $color ) !== 6 ) {

			throw new Exception( 'HEX color needs to be 6 or 3 digits long' );

		}

		$this->_hsl = self::hex_to_hsl( $color );
		$this->_hex = $color;
		$this->_rgb = self::hex_to_rgb( $color );
	}

	/*
    |--------------------------------------------------------------------------
    | Public interface
    |--------------------------------------------------------------------------
    */

	/**
	 * Given a HEX string returns a HSL array equivalent.
	 *
	 * @param  string $color Color to convert.
	 *
	 * @return array HSL associative array
	 */
	public static function hex_to_hsl( $color ) {

		// Sanity check.
		$color = self::_check_hex( $color );

		// Convert HEX to DEC.
		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

		$hsl = array();

		$var_r = ( $r / 255 );
		$var_g = ( $g / 255 );
		$var_b = ( $b / 255 );

		$var_min = min( $var_r, $var_g, $var_b );
		$var_max = max( $var_r, $var_g, $var_b );
		$del_max = $var_max - $var_min;

		$l = ( $var_max + $var_min ) / 2;

		if ( 0 === $del_max ) {
			$h = 0;
			$s = 0;
		} else {
			if ( $l < 0.5 ) {
				$s = $del_max / ( $var_max + $var_min );
			} else {
				$s = $del_max / ( 2 - $var_max - $var_min );
			}

			$del_r = ( ( ( $var_max - $var_r ) / 6 ) + ( $del_max / 2 ) ) / $del_max;
			$del_g = ( ( ( $var_max - $var_g ) / 6 ) + ( $del_max / 2 ) ) / $del_max;
			$del_b = ( ( ( $var_max - $var_b ) / 6 ) + ( $del_max / 2 ) ) / $del_max;

			if ( $var_r === $var_max ) {
				$h = $del_b - $del_g;
			} elseif ( $var_g === $var_max ) {
				$h = ( 1 / 3 ) + $del_r - $del_b;
			} elseif ( $var_b === $var_max ) {
				$h = ( 2 / 3 ) + $del_g - $del_r;
			}

			if ( $h < 0 ) {
				$h ++;
			}
			if ( $h > 1 ) {
				$h --;
			}
		}

		$hsl['H'] = ( $h * 360 );
		$hsl['S'] = $s;
		$hsl['L'] = $l;

		return $hsl;
	}

	/**
	 *  Given a HSL associative array returns the equivalent HEX string
	 *
	 * @param  array $hsl HSL color to check.
	 *
	 * @throws Exception Bad HSL Array.
	 *
	 * @return string HEX string
	 */
	public static function hsl_to_hex( $hsl = array() ) {

		// Make sure it's HSL.
		if ( empty( $hsl ) || ! isset( $hsl['H'] ) || ! isset( $hsl['S'] ) || ! isset( $hsl['L'] ) ) {
			throw new Exception( 'Param was not an HSL array' );
		}

		list( $h, $s, $l ) = array( $hsl['H'] / 360, $hsl['S'], $hsl['L'] );

		if ( 0 === $s ) {

			$r = $l * 255;
			$g = $l * 255;
			$b = $l * 255;

		} else {

			if ( $l < 0.5 ) {

				$var_2 = $l * ( 1 + $s );

			} else {

				$var_2 = ( $l + $s ) - ( $s * $l );

			}

			$var_1 = 2 * $l - $var_2;

			$r = round( 255 * self::_huetorgb( $var_1, $var_2, $h + ( 1 / 3 ) ) );
			$g = round( 255 * self::_huetorgb( $var_1, $var_2, $h ) );
			$b = round( 255 * self::_huetorgb( $var_1, $var_2, $h - ( 1 / 3 ) ) );

		}

		// Convert to hex.
		$r = dechex( $r );
		$g = dechex( $g );
		$b = dechex( $b );

		// Make sure we get 2 digits for decimals.
		$r = ( strlen( '' . $r ) === 1 ) ? '0' . $r : $r;
		$g = ( strlen( '' . $g ) === 1 ) ? '0' . $g : $g;
		$b = ( strlen( '' . $b ) === 1 ) ? '0' . $b : $b;

		return $r . $g . $b;

	}

	/**
	 * Given a HEX string returns a RGB array equivalent.
	 *
	 * @param string $color Hex color to check.
	 *
	 * @return array RGB associative array
	 */
	public static function hex_to_rgb( $color ) {

		// Sanity check.
		$color = self::_check_hex( $color );

		// Convert HEX to DEC.
		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

		$rgb['R'] = $r;
		$rgb['G'] = $g;
		$rgb['B'] = $b;

		return $rgb;

	}

	/**
	 *  Given an RGB associative array returns the equivalent HEX string
	 *
	 * @param  array $rgb RGB color to check.
	 *
	 * @return string RGB string
	 * @throws Exception Bad RGB Array.
	 */
	public static function rgb_to_hex( $rgb = array() ) {

		// Make sure it's RGB.
		if ( empty( $rgb ) || ! isset( $rgb['R'] ) || ! isset( $rgb['G'] ) || ! isset( $rgb['B'] ) ) {

			throw new Exception( 'Param was not an RGB array' );

		}

		/*
		 * Convert RGB to HEX.
		 * @link https://github.com/mexitek/phpColors/issues/25#issuecomment-88354815.
		 */
		$hex[0] = str_pad( dechex( $rgb['R'] ), 2, '0', STR_PAD_LEFT );
		$hex[1] = str_pad( dechex( $rgb['G'] ), 2, '0', STR_PAD_LEFT );
		$hex[2] = str_pad( dechex( $rgb['B'] ), 2, '0', STR_PAD_LEFT );

		return implode( '', $hex );

	}

	/**
	 * Given a HEX value, returns a darker color. If no desired amount provided,
	 * then the color halfway between given HEX and black will be returned.
	 *
	 * @param  int $amount Amount to darken.
	 *
	 * @return string Darker HEX value
	 */
	public function darken( $amount = self::DEFAULT_ADJUST ) {

		// Darken.
		$darker_hsl = $this->_darken( $this->_hsl, $amount );

		// Return as HEX.
		return self::hsl_to_hex( $darker_hsl );

	}

	/**
	 * Given a HEX value, returns a lighter color. If no desired amount provided, then the color halfway between
	 * given HEX and white will be returned.
	 *
	 * @param  int $amount Amount to lighten.
	 *
	 * @return string Lighter HEX value
	 */
	public function lighten( $amount = self::DEFAULT_ADJUST ) {

		// Lighten.
		$lighter_hsl = $this->_lighten( $this->_hsl, $amount );

		// Return as HEX.
		return self::hsl_to_hex( $lighter_hsl );

	}

	/**
	 * Given a HEX value, returns a mixed color. If no desired amount
	 * provided, then the color mixed by this ratio.
	 *
	 * @param string $hex2 Secondary HEX value to mix with.
	 * @param int    $amount = -100..0..+100.
	 *
	 * @return string mixed HEX value
	 */
	public function mix( $hex2, $amount = 0 ) {

		$rgb2  = self::hex_to_rgb( $hex2 );
		$mixed = $this->_mix( $this->_rgb, $rgb2, $amount );

		// Return as HEX.
		return self::rgb_to_hex( $mixed );

	}

	/**
	 * Creates an array with two shades that can be used to make a gradient.
	 *
	 * @param  int $amount Optional percentage amount you want your contrast color.
	 *
	 * @return array An array with a 'light' and 'dark' index
	 */
	public function make_gradient( $amount = self::DEFAULT_ADJUST ) {

		// Decide which color needs to be made.
		if ( $this->is_light() ) {

			$light_color = $this->_hex;
			$dark_color  = $this->darken( $amount );

		} else {

			$light_color = $this->lighten( $amount );
			$dark_color  = $this->_hex;

		}

		// Return our gradient array.
		return array(
			'light' => $light_color,
			'dark'  => $dark_color,
		);
	}

	/**
	 * Returns whether or not given color is considered "light"
	 *
	 * @param string|Boolean $color Color to check.
	 * @param int            $lighter_than Light amount.
	 *
	 * @return boolean
	 */
	public function is_light( $color = false, $lighter_than = 130 ) {
		// Get our color.
		$color = ( $color ) ? $color : $this->_hex;

		// Calculate straight from rbg.
		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

		return ( ( $r * 299 + $g * 587 + $b * 114 ) / 1000 > $lighter_than );
	}

	/**
	 * Returns whether or not a given color is considered "dark"
	 *
	 * @param string|Boolean $color       Color to check.
	 * @param int            $darker_than Darkness.
	 *
	 * @return boolean
	 */
	public function is_dark( $color = false, $darker_than = 130 ) {
		// Get our color.
		$color = ( $color ) ? $color : $this->_hex;

		// Calculate straight from rbg.
		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

		return ( ( $r * 299 + $g * 587 + $b * 114 ) / 1000 <= $darker_than );
	}

	/**
	 * Returns the complimentary color.
	 *
	 * @return string Complementary hex color
	 */
	public function complementary() {

		// Get our HSL.
		$hsl = $this->_hsl;

		// Adjust Hue 180 degrees.
		$hsl['H'] += ( $hsl['H'] > 180 ) ? - 180 : 180;

		// Return the new value in HEX.
		return self::hsl_to_hex( $hsl );

	}

	/**
	 * Returns your color's HSL array
	 */
	public function get_hsl() {

		return $this->_hsl;

	}

	/**
	 * Returns your original color
	 */
	public function get_hex() {

		return $this->_hex;

	}

	/**
	 * Returns your color's RGB array
	 */
	public function get_rgb() {

		return $this->_rgb;

	}

	/**
	 * Returns the cross browser CSS3 gradient
	 *
	 * @param int     $amount Optional: percentage amount to light/darken the gradient.
	 * @param boolean $vintage_browsers Optional: include vendor prefixes for browsers that almost died out already.
	 * @param string  $suffix Optional: suffix for every lines.
	 * @param string  $prefix Optional: prefix for every lines.
	 *
	 * @link  http://caniuse.com/css-gradients Resource for the browser support
	 *
	 * @return string CSS3 gradient for chrome, safari, firefox, opera and IE10
	 */
	public function get_css_gradient( $amount = self::DEFAULT_ADJUST, $vintage_browsers = false, $suffix = '', $prefix = '' ) {

		// Get the recommended gradient.
		$g = $this->make_gradient( $amount );

		$css = '';

		// Fallback/image non-cover color.
		$css .= "{$prefix}background-color: #" . $this->_hex . ";{$suffix}";

		// IE Browsers.
		$css .= "{$prefix}filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#" . $g['light'] . "', endColorstr='#" . $g['dark'] . "');{$suffix}";

		// Safari 4+, Chrome 1-9.
		if ( $vintage_browsers ) {
			$css .= "{$prefix}background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#" . $g['light'] . '), to(#' . $g['dark'] . "));{$suffix}";
		}

		// Safari 5.1+, Mobile Safari, Chrome 10+.
		$css .= "{$prefix}background-image: -webkit-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

		// Firefox 3.6+.
		if ( $vintage_browsers ) {
			$css .= "{$prefix}background-image: -moz-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";
		}

		// Opera 11.10+.
		if ( $vintage_browsers ) {
			$css .= "{$prefix}background-image: -o-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";
		}

		// Unprefixed version (standards): FF 16+, IE10+, Chrome 26+, Safari 7+, Opera 12.1+.
		$css .= "{$prefix}background-image: linear-gradient(to bottom, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

		// Return our CSS.
		return $css;
	}

	/*
    |--------------------------------------------------------------------------
    | Private functions.
    |--------------------------------------------------------------------------
    */

	/**
	 * Darkens a given HSL array
	 *
	 * @param  array $hsl    HSL color to check.
	 * @param  int   $amount Amount to darken.
	 *
	 * @return array $hsl
	 */
	private function _darken( $hsl, $amount = self::DEFAULT_ADJUST ) {

		// Check if we were provided a number.
		if ( $amount ) {

			$hsl['L'] = ( $hsl['L'] * 100 ) - $amount;
			$hsl['L'] = ( $hsl['L'] < 0 ) ? 0 : $hsl['L'] / 100;

		} else {

			// We need to find out how much to darken.
			$hsl['L'] = $hsl['L'] / 2;

		}

		return $hsl;

	}

	/**
	 * Lightens a given HSL array
	 *
	 * @param array $hsl    HSL color to check.
	 * @param int   $amount Amount to darken.
	 *
	 * @return array $hsl
	 */
	private function _lighten( $hsl, $amount = self::DEFAULT_ADJUST ) {

		// Check if we were provided a number.
		if ( $amount ) {

			$hsl['L'] = ( $hsl['L'] * 100 ) + $amount;
			$hsl['L'] = ( $hsl['L'] > 100 ) ? 1 : $hsl['L'] / 100;

		} else {

			// We need to find out how much to lighten.
			$hsl['L'] += ( 1 - $hsl['L'] ) / 2;

		}

		return $hsl;
	}

	/**
	 * Mix 2 rgb colors and return an rgb color
	 *
	 * @param array $rgb1 First RGBA color.
	 * @param array $rgb2 Second RGBA color.
	 * @param int   $amount ranged -100..0..+100.
	 *
	 * @link http://phpxref.pagelines.com/nav.html?includes/class.colors.php.source.html
	 *
	 * @return array $rgb
	 */
	private function _mix( $rgb1, $rgb2, $amount = 0 ) {

		$r1 = ( $amount + 100 ) / 100;
		$r2 = 2 - $r1;

		$rmix = ( ( $rgb1['R'] * $r1 ) + ( $rgb2['R'] * $r2 ) ) / 2;
		$gmix = ( ( $rgb1['G'] * $r1 ) + ( $rgb2['G'] * $r2 ) ) / 2;
		$bmix = ( ( $rgb1['B'] * $r1 ) + ( $rgb2['B'] * $r2 ) ) / 2;

		return array(
			'R' => $rmix,
			'G' => $gmix,
			'B' => $bmix,
		);

	}

	/**
	 * Given a Hue, returns corresponding RGB value
	 *
	 * @param int $v1 First value.
	 * @param int $v2 Second value.
	 * @param int $vh Third value.
	 *
	 * @return int
	 */
	private static function _huetorgb( $v1, $v2, $vh ) {

		if ( $vh < 0 ) {

			$vh++;

		}

		if ( $vh > 1 ) {

			$vh--;

		}

		if ( ( 6 * $vh ) < 1 ) {

			return ( $v1 + ( $v2 - $v1 ) * 6 * $vh );

		}

		if ( ( 2 * $vh ) < 1 ) {

			return $v2;

		}

		if ( ( 3 * $vh ) < 2 ) {

			return ( $v1 + ( $v2 - $v1 ) * ( ( 2 / 3 ) - $vh ) * 6 );

		}

		return $v1;

	}

	/**
	 * You need to check if you were given a good hex string
	 *
	 * @param  string $hex Hex color.
	 *
	 * @throws Exception "Bad color format".
	 *
	 * @return string Color
	 */
	private static function _check_hex( $hex ) {

		// Strip # sign is present.
		$color = str_replace( '#', '', $hex );

		// Make sure it's 6 digits.
		if ( strlen( $color ) === 3 ) {

			$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];

		} elseif ( strlen( $color ) !== 6 ) {

			throw new Exception( 'HEX color needs to be 6 or 3 digits long' );

		}

		return $color;

	}

	/**
	 * Converts object into its string representation
	 *
	 * @return string Color
	 */
	public function __toString() {

		return '#' . $this->get_hex();

	}

}
