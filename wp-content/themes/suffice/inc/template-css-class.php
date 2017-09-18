<?php
/**
 * Handles all the css class
 * adding or removing css class to certain elements
 * will be controlled from this file
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function suffice_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_archive() ) {
		/* If blog post type is grid */
		if ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) {
			$classes[] = 'archive-style-grid';
		}
		/* Adds body class on archive page */
		$classes[] = suffice_get_option( 'suffice_layout_archive', 'right-sidebar' );

	} elseif ( is_home() ) {
		/* If blog post type is grid */
		if ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) {
			$classes[] = 'archive-style-grid';
		}
		/* Adds a body class on home/blog */
		$classes[] = suffice_get_option( 'suffice_layout_blog', 'right-sidebar' );

	} elseif ( is_single() ) { /* Add class on single content*/
		$classes[] = suffice_get_option( 'suffice_layout_single', 'right-sidebar' );

	} elseif ( is_page() ) { /* Add class on page */
		$classes[] = suffice_get_option( 'suffice_layout_page', 'full-width' );
		if ( is_page_template( 'page-templates/full-width.php' ) ) {
			/* Adds body class on full with page tempalte */
			$classes   = suffice_remove_old_body_class( $classes, array( 'full-width', 'left-sidebar', 'right-sidebar' ) );
			$classes[] = 'full-width';

		} elseif ( is_page_template( 'page-templates/right-sidebar.php' ) ) {
			$classes   = suffice_remove_old_body_class( $classes, array( 'full-width', 'left-sidebar', 'right-sidebar' ) );
			/* Adds body class on right sidebar page tempalte */
			$classes[] = 'right-sidebar';

		} elseif ( is_page_template( 'page-templates/left-sidebar.php' ) ) {
			$classes   = suffice_remove_old_body_class( $classes, array( 'full-width', 'left-sidebar', 'right-sidebar' ) );
			/* Adds body class on left sidebar page tempalte */
			$classes[] = 'left-sidebar';

		} elseif ( is_page_template( 'page-templates/page-builder.php' ) ) {
			$classes   = suffice_remove_old_body_class( $classes, array( 'full-width', 'left-sidebar', 'right-sidebar' ) );
			/* Adds body class on page builder page tempalte */
			$classes[] = 'full-width';
		}

	} elseif ( is_search() ) {
		/* Add class on search page*/
		$classes[] = suffice_get_option( 'suffice_layout_search', 'right-sidebar' );

	} elseif ( is_404() ) {
		/* Add class on 404 page*/
		$classes[] = suffice_get_option( 'suffice_layout_404', 'full-width' );

	}

	/* Adds a class whether layout is boxed or wide */
	$classes[] = suffice_get_option( 'suffice_layout_style', 'wide' );

	return $classes;
}
add_filter( 'body_class', 'suffice_body_classes' );


/**
 * Adds custom classes to post class
 *
 * @param  array $classes css classes.
 * @return array
 */
function suffice_post_classes( $classes ) {

	/* Add classes on blog */
	if ( is_home() || is_archive() ) {
		$classes[] = suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' );

		/* Add column class if post type is grid */
		if ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) {
			$classes[] = suffice_get_option( 'suffice_blog_grid_layout_col', 'col-md-4' );
		}
	}

	/* If on search result add css classes */
	if ( is_search() ) {
		$classes[] = suffice_get_option( 'suffice_search_result_style', 'post-style-classic' );

		/* If post style type if grid then add boostrap grid class*/
		if ( 'post-style-grid' === suffice_get_option( 'suffice_search_result_style', 'post-style-classic' ) ) {
			$classes[] = suffice_get_option( 'suffice_search_grid_col', 'col-md-6' );
		}
	}

	$classes = array_map( 'esc_attr', $classes );

	return $classes;
}
add_filter( 'post_class', 'suffice_post_classes' );


/**
 * Adds custom classes to the array of header classes
 */
function suffice_header_class() {
	$classes = array();

	// add header style.
	$classes[] = suffice_get_option( 'suffice_header_style', 'logo-left-menu-right' );

	// checks whether header is sticky or not.
	if ( true == suffice_get_option( 'suffice_sticky_header', true ) ) {
		$classes[] = 'header-sticky';
		$classes[] = 'header-sticky-desktop';
		$classes[] = suffice_get_option( 'suffice_sticky_header_style', 'header-sticky-style-full-slide' );
	}

	// if current page has enabled header transparency, add header-transparent class.
	if ( is_page() ) {
		global $post;

		if ( true == get_post_meta( $post->ID, 'suffice_header_transparency', true ) && true == suffice_get_option( 'suffice_sticky_header', true ) ) {
			$classes[] = 'header-transparent';

			// if transparent logo is set.
			if ( suffice_get_option( 'suffice_header_transparent_logo' ) ) {
				$classes[] = 'header-transparent-logo';
			}
		}
	}

	$classes = array_map( 'esc_attr', $classes );

	echo esc_attr( join( ' ', $classes ) );
}

/**
 * Adds css class to main navigation menu
 *
 * @since 1.0.0
 */
function suffice_navigation_class() {
	$classes = array();

	// add menu style.
	$classes[] = suffice_get_option( 'suffice_menu_style', 'navigation-default' );

	// box shadow for dropdown.
	if ( true == suffice_get_option( 'suffice_menu_submenu_show_shadow', true ) ) {
		$classes[] = 'menu-has-submenu-shadow';
	}

	// shows border on dropdown list item.
	if ( true == suffice_get_option( 'suffice_menu_submenu_show_devider', true ) ) {
		$classes[] = 'menu-has-submenu-devider';
	}

	// shows down arrow on dropdown.
	if ( true == suffice_get_option( 'suffice_menu_submenu_show_indicator', true ) ) {
		$classes[] = 'menu-has-submenu-indicator';
	}

	echo esc_attr( join( ' ', $classes ) );
}


/**
 * Gets the widget additional class
 *
 * @return string
 */
function suffice_get_widget_class() {
	$classes = '';
	if ( true == suffice_get_option( 'sufficet_show_widget_title_ribbon', true ) ) {
		$classes = 'widget--ribbon';
	}

	return esc_attr( $classes );
}

/**
 * Gets the column with class for widget on footer
 *
 * @return string
 */
function suffice_get_footer_widget_class() {
	$footer_column_class = esc_attr( suffice_get_option( 'suffice_footer_columns_count', 'footer-widgets-col--four' ) );
	return $footer_column_class;
}


/**
 * Checks if class exist on bodyclass
 *
 * @param string $class css body class.
 * @return boolean
 */
function suffice_is_in_bodyclass( $class ) {
	$classes = get_body_class();

	if ( in_array( $class, $classes, true ) ) {
		return true;
	} else {
		return false;
	}
}
