<?php
/**
 * Suffice Core Functions.
 *
 * General core functions available on both the front-end and admin.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  SufficeToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include core functions (available in both admin and frontend).
include( 'functions-suffice-deprecated.php' );
include( 'functions-suffice-formatting.php' );
include( 'functions-suffice-portfolio.php' );

/**
 * is_suffice_pro_active - Check if Suffice Pro is active.
 * @return bool
 */
function is_suffice_pro_active() {
	return false !== strpos( get_option( 'template' ), 'suffice-pro' );
}

/**
 * Queue some JavaScript code to be output in the footer.
 * @param string $code
 */
function suffice_toolkit_enqueue_js( $code ) {
	global $suffice_toolkit_queued_js;

	if ( empty( $suffice_toolkit_queued_js ) ) {
		$suffice_toolkit_queued_js = '';
	}

	$suffice_toolkit_queued_js .= "\n" . $code . "\n";
}

/**
 * Output any queued javascript code in the footer.
 */
function suffice_toolkit_print_js() {
	global $suffice_toolkit_queued_js;

	if ( ! empty( $suffice_toolkit_queued_js ) ) {
		// Sanitize.
		$suffice_toolkit_queued_js = wp_check_invalid_utf8( $suffice_toolkit_queued_js );
		$suffice_toolkit_queued_js = preg_replace( '/&#(x)?0*(?(1)27|39);?/i', "'", $suffice_toolkit_queued_js );
		$suffice_toolkit_queued_js = str_replace( "\r", '', $suffice_toolkit_queued_js );

		$js = "<!-- Suffice Toolkit JavaScript -->\n<script type=\"text/javascript\">\njQuery(function($) { $suffice_toolkit_queued_js });\n</script>\n";

		/**
		 * social_icons_queued_js filter.
		 * @param string $js JavaScript code.
		 */
		echo apply_filters( 'suffice_toolkit_queued_js', $js );

		unset( $suffice_toolkit_queued_js );
	}
}

/**
 * Display a SufficeToolkit help tip.
 *
 * @param  string $tip Help tip text
 * @param  bool   $allow_html Allow sanitized HTML if true or escape
 * @return string
 */
function suffice_toolkit_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = suffice_toolkit_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="suffice-toolkit-help-tip" data-tip="' . $tip . '"></span>';
}

/**
 * Get all available sidebars.
 * @param  array $sidebars
 * @return array
 */
function suffice_toolkit_get_sidebars( $sidebars = array() ) {
	global $wp_registered_sidebars;

	foreach ( $wp_registered_sidebars as $sidebar ) {
		if ( ! in_array( $sidebar['name'], apply_filters( 'suffice_toolkit_sidebars_exclude', array( 'Display Everywhere' ) ) ) ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}
	}

	return $sidebars;
}

/**
 * SufficeToolkit Layout Supported Screens or Post types.
 * @return array
 */
function suffice_toolkit_get_layout_supported_screens() {
	return (array) apply_filters( 'suffice_toolkit_layout_supported_screens', array( 'post', 'page', 'portfolio', 'jetpack-portfolio' ) );
}

/**
 * Get and include template files.
 *
 * @param string $template_name
 * @param array  $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function suffice_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = suffice_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'suffice_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'suffice_toolkit_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'suffice_toolkit_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * Note: ST_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path   /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @param  string $template_name
 * @param  string $template_path (default: '')
 * @param  string $default_path (default: '')
 * @return string
 */
function suffice_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = ST()->template_path();
	}

	if ( ! $default_path ) {
		$default_path = ST()->plugin_path() . '/templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/
	if ( ! $template || ST_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'suffice_toolkit_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'suffice_get_google_fonts' ) ) {

	/**
	 * Get Google Font lists.
	 * @return array
	 */
	function suffice_get_google_fonts() {
		return apply_filters( 'suffice_get_google_fonts', include( ST()->plugin_path() . '/i18n/google-fonts.php' ) );
	}
}

if ( ! function_exists( 'suffice_get_fontawesome_icons' ) ) {

	/**
	 * Get fontawesome icon lists.
	 * @return array
	 */
	function suffice_get_fontawesome_icons() {
		return apply_filters( 'suffice_get_fontawesome_icons', include( ST()->plugin_path() . '/i18n/fontawesome.php' ) );
	}
}

/**
 * Get Column Class.
 * @return string
 */
function suffice_get_column_class( $column ) {
	$class = '';
	switch ($column) {
		case '1':
			$class = 'col-md-12';
			break;

		case '2':
			$class = 'col-md-6';
			break;

		case '3':
			$class = 'col-md-4';
			break;

		case '4':
			$class = 'col-md-3';
			break;

		case '6':
			$class = 'col-md-2';
			break;

		case '12':
			$class = 'col-md-1';
			break;
	}

	return $class;
}

/**
 * Get Terms List
 *
 * @return string List of Terms joined with ', '
 */

function suffice_get_terms_list($id, $taxonomy) {

	$terms = get_the_terms( $id, $taxonomy );

	if ( $terms && ! is_wp_error( $terms ) ) :

    $joined_terms_array = array();

    foreach ( $terms as $term ) {
        $joined_terms_array[] = $term->name;
    }

    $joined_terms_string = join( ", ", $joined_terms_array );

    endif;

    return $joined_terms_string;
}

/**
 * Get First Category Name
 *
 * @return string First Category from Loop
 */

function suffice_get_first_category_name($source, $cat_id) {
	if( $source == 'latest' ) {
		$category      = get_the_category();
		$category_name = $category[0]->cat_name;
	} else {
		$category_name = get_cat_name( $cat_id );
	}

	return $category_name;
}

/**
 * Get First Category Link
 *
 * @return string First Link from Loop
 */

function suffice_get_first_category_link($source, $cat_id){
	$category_name = suffice_get_first_category_name($source, $cat_id);
	$category_ID   = get_cat_ID( $category_name );
	$category_link = get_category_link( $category_ID );

	return $category_link;
}

/**
 * Get first category id
 *
 * @return int category id
 */
function suffice_get_first_category_id($source, $cat_id){
	$category_name = suffice_get_first_category_name($source, $cat_id);
	$category_ID   = get_cat_ID( $category_name );

	return $category_ID;
}

/**
 * Get WooCommerce Category lists.
 * @return array
 */
function suffice_get_woocommerce_categories() {
	$terms = get_terms( array_values ( array(
		'taxonomy' => 'category',
		'hide_empty' => true,
	) ) );

	$terms_array     = array();
	$term_id_array   = array();
	$term_name_array = array();

	foreach ($terms as $term ) {
		$term_id_array[]   = $term->term_id;
		$term_name_array[] = $term->name;
	}

	$terms_array = array_combine($term_id_array, $term_name_array);

	return $terms_array;
}

// This filter allow a wp_dropdown_categories select to return multiple items
add_filter( 'wp_dropdown_cats', 'suffice_wp_dropdown_cats_multiple', 10, 2 );
function suffice_wp_dropdown_cats_multiple( $output, $r ) {
	if ( ! empty( $r['multiple'] ) ) {
		$output = preg_replace( '/<select(.*?)>/i', '<select$1 multiple="multiple" style="width:100%">', $output );
		$output = preg_replace( '/name=([\'"]{1})(.*?)\1/i', 'name=$2[]', $output );
	}
	return $output;
}

// This Walker is needed to match more than one selected value
class Suffice_Walker_CategoryDropdown extends Walker_CategoryDropdown {
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		 $pad = str_repeat('&nbsp;', $depth * 3);

	    $cat_name = apply_filters('list_cats', $category->name, $category);
	    $output .= "<option class=\"level-{$depth}\" value=\"{$category->term_id}\"";

	    if( is_array( $args['selected'] ) ) {
		    if ( in_array( $category->term_id, $args['selected'] ) ) {
		        $output .= ' selected="selected"';
		    }
		}

	    $output .= '>';
	    $output .= $pad.$cat_name;
	    if ( $args['show_count'] )
	        $output .= "({$category->count})";
	    $output .= "</option>";
	}
}
