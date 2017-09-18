<?php
/**
 * Suffice Template functions
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
* Display the custom theme options
*/
function suffice_get_option( $setting, $default = '' ) {
	$options = get_option( 'suffice', array() );
	$value = $default;
	if ( isset( $options[ $setting ] ) ) {
		$value = $options[ $setting ];
	}

	return $value;
}

/**
 * Converts Column width to appropriate css
 *
 * @param  integer $number number of columns.
 * @return integer $width
 */
function suffice_get_column_count( $number = 1 ) {
	$width = 12;

	switch ( $number ) {
		case 1:
			$width = 12;
			break;

		case 2:
			$width = 6;
			break;

		case 3:
			$width = 4;
			break;

		case 4:
			$width = 3;
			break;

		case 6:
			$width = 2;
			break;

		case 12:
			$width = 1;
			break;

		default:
			$width = 12;
			break;
	}

	return $width;
}


/**
 * Converts Hex color code into RGB
 *
 * @param  string $color    hex color code.
 * @param  string $percentage rgba format.
 * @return string         converted rgb value
 */
function suffice_hex2rgba( $color, $percentage = 0.5 ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return $color;
	}

	return "rgba( $r, $g, $b, $percentage )";
}


/**
 * Lightens or darkens given colour
 *
 * @param  string $hex     hex color code.
 * @param  int $percent    luminous percentage.
 * @return string          hex color code
 */
function suffice_color_luminance( $hex, $percent ) {

	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';

	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}

	// convert to decimal and change luminosity.
	for ( $i = 0; $i < 3; $i++ ) {
		$dec = hexdec( substr( $hex, $i * 2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 );
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}

	return $new_hex;
}


/**
 * Lightens primary color
 *
 * @param int $percent luminance percentage.
 * @return string rgba color
 */
function suffice_get_light_primary_color( $percent = 0.1 ) {
	$primary_color = suffice_get_option( 'suffice_color_primary', '#00BAF4' );
	return suffice_color_luminance( $primary_color, $percent );
};


/**
 * Checks whether yith wishlist plugin is active or not
 *
 * @return boolean
 */
function suffice_is_yith_wishlist_active() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks whether woocommerce is active or not
 *
 * @return boolean
 */
function suffice_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks the layout of current page, post
 *
 * @return string
 */
function suffice_get_current_layout() {
	$layout = '';

	if ( is_archive() ) {
		$layout = suffice_get_option( 'suffice_layout_archive', 'right-sidebar' );

	} elseif ( is_home() ) {
		$layout = suffice_get_option( 'suffice_layout_blog', 'right-sidebar' );

	} elseif ( is_single() ) {
		$layout = suffice_get_option( 'suffice_layout_single', 'right-sidebar' );

	} elseif ( is_page() ) {
		$layout = suffice_get_option( 'suffice_layout_page', 'full-width' );

		if ( is_page_template( 'page-templates/left-sidebar.php' ) ) {
			$layout = 'left-sidebar';

		} elseif ( is_page_template( 'page-templates/right-sidebar.php' ) ) {
			$layout = 'right-sidebar';

		} elseif ( is_page_template( 'page-templates/page-builder.php' ) ) {
			$layout = 'full-width';

		} elseif ( is_page_template( 'page-templates/full-width.php' ) ) {
			$layout = 'full-width';

		}

	} elseif ( is_search() ) {
		$layout = suffice_get_option( 'suffice_layout_search', 'right-sidebar' );

	} elseif ( is_404() ) {
		$layout = suffice_get_option( 'suffice_layout_404', 'full-width' );

	} elseif ( is_front_page() && ! is_home() ) {
		$layout = suffice_get_option( 'suffice_layout_homepage', 'right-sidebar' );

	}

	return $layout;
}


/**
 * Removes the elements from body classes
 *
 * @param  array  $classes            body classes.
 * @param  array  $elements_to_remove elements to remove from body class.
 * @return array                     body classes
 */
function suffice_remove_old_body_class( $classes = array(), $elements_to_remove = array() ) {
	if ( empty( $classes ) && empty( $elements_to_remove ) ) {
		return false;
	}

	$removed_class = array_diff( $classes, $elements_to_remove );
	return $removed_class;
}
