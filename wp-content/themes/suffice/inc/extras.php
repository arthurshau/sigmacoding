<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
 * Before hook for content loop
 */
function suffice_custom_before_content_loop() {

	/**
	 * Add the row div as required
	 * 1. If post style is grid
	 * 2. If in search page and post style is grid
	 */
	if ( ( ! is_search() && ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) ) || ( is_search() && ( 'post-style-grid' === suffice_get_option( 'suffice_search_result_style', 'post-style-classic' ) ) ) ) {
		echo '<div class="row">';
	}
}
add_action( 'suffice_before_content_loop', 'suffice_custom_before_content_loop' );


/**
 * After hook for content loop
 */
function suffice_custom_after_content_loop() {

	/**
	 * Add the closing row div as required
	 * 1. If post style is grid
	 * 2. If in search page and post style is grid
	 */
	if ( ( ! is_search() && ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) ) || ( is_search() && ( 'post-style-grid' === suffice_get_option( 'suffice_search_result_style', 'post-style-classic' ) ) ) ) {
		echo '</div> <!-- .row -->';
	}
}
add_action( 'suffice_after_content_loop', 'suffice_custom_after_content_loop' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function suffice_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'suffice_pingback_header' );


/**
 * Adds the breadcrumb
 */
function suffice_add_breadcrumb() {
	if ( ( ! is_front_page() ) && ( ! is_page_template( 'page-templates/page-builder.php' ) ) && ( true == suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) ) {

		// hide on bbpress.
		if ( function_exists( 'is_bbpress' ) ) {
			if ( ! is_bbpress() ) {
				suffice_breadcrumbs();
			}
		} else {
			suffice_breadcrumbs();
		}
	}
}
add_action( 'suffice_after_header', 'suffice_add_breadcrumb', 5 );


if ( ! function_exists( 'suffice_breadcrumbs' ) ) {

	/**
	 * Shows breadcrumb
	 */
	function suffice_breadcrumbs() {

		echo '<nav class="breadcrumbs">';
		echo '<div class="container">';
		suffice_page_title();

		if ( true == suffice_get_option( 'suffice_show_breadcrumbs', true ) ) {
			suffice_breadcrumbs_trail();
		}
		echo '</div">';
		echo '</nav>';
	}
}


if ( ! function_exists( 'suffice_breadcrumbs_trail' ) ) {

	/**
	 * Breadcrumb Trail
	 *
	 * @since 1.0.0
	 *
	 * @global array $post global post variable
	 * @global array $wp_query global query variable
	 */
	function suffice_breadcrumbs_trail() {
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb('
				<p id="yoast-breadcrumbs">','</p>
				');
			return false;
		}
		if ( suffice_is_woocommerce_active() ) {
			woocommerce_breadcrumb();
			return false;
		}

		// Settings.
		$separator          = '&gt;';
		$home_title         = esc_html__( 'Home', 'suffice' );

		// Get the query & post information.
		global $post,$wp_query;

		// Do not display on the homepage.
		if ( suffice_get_option( 'suffice_show_breadcrumbs_mobile' ) !== 1 ) {
			$breadcrumbs_class = esc_attr( 'hide-on-mobile' );
		} else {
			$breadcrumbs_class = '';
		}
		// Build the breadcrums.
		echo '<ul class="breadcrumbs-trail ' . esc_attr( $breadcrumbs_class ) . '">';

		// Home page.
		echo '<li class="trail-item trail-begin"><a class="trail-home" href="' . esc_html( get_home_url() ) . '" title="' . esc_attr( $home_title ) . '"><span>' . esc_attr( $home_title ) . '</span></a></li>';

		if ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {

			// If post is a custom post type.
			$post_type = get_post_type();

			$post_type_object       = get_post_type_object( $post_type );
			$post_type_archive_link = get_post_type_archive_link( $post_type );

			echo '<li class="trail-item"><a class="item-taxonomy" href="' . esc_url( $post_type_archive_link ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '"><span>' . esc_html( $post_type_object->labels->name ) . '</span></a></li>';
			$custom_taxonomy = get_queried_object()->name;
			echo '<li class="trail-item"><span>' . esc_html( $custom_taxonomy ) . '</span></li>';

		} elseif ( is_single() ) {

			// If post is a custom post type.
			$post_type = get_post_type();

			$post_type_object = get_post_type_object( $post_type );
			$post_type_archive_link = get_post_type_archive_link( $post_type );

			echo '<li class="trail-item"><a class="item-custom-post-type" href="' . esc_url( $post_type_archive_link ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '"><span>' . esc_html( $post_type_object->labels->name ) . '</span></a></li>';

			// Get post category info.
			$category = get_the_category();

			if ( ! empty( $category ) ) {

				// Get last category post is in.
				$slice_array   = array_slice( $category, -1 );
				$last_category = array_pop( $slice_array );

				// Get parent any categories and create array.
				$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ),',' );
				$cat_parents     = explode( ',', $get_cat_parents );

				// Loop through parent categories and store in variable $cat_display.
				$cat_display = '';
				foreach ( $cat_parents as $parents ) {
					$cat_display .= '<li class="trail-item item-category"><span>' . $parents . '</span></li>';
				}
			}

			// Check if the post is in a category.
			if ( ! empty( $last_category ) ) {
				echo  $cat_display;
				echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';

			} else {
				echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';
			}
		} elseif ( is_category() ) {
			// Category page.
			echo '<li class="trail-item"><span>' . single_cat_title( '', false ) . '</span></li>';

		} elseif ( is_page() ) {

			// Standard page.
			if ( $post->post_parent ) {
				// If child page, get parents.
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order.
				$anc = array_reverse( $anc );
				$parents = '';

				// Parent page loop.
				foreach ( $anc as $ancestor ) {
					$parents .= '<li class="trail-item"><a class="item-parent" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '"><span>' . esc_html( get_the_title( $ancestor ) ) . '</span></a></li>';
				}

				// Display parent pages.
				echo $parents;

				// Current page.
				echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';

			} else {
				// Just display current page if not parents.
				echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';
			}
		} elseif ( is_tag() ) {
			// Tag page.
			// Get tag information.
			$term_id        = get_query_var( 'tag_id' );
			$taxonomy       = 'post_tag';
			$args           = 'include=' . $term_id;
			$terms          = get_terms( $taxonomy, $args );
			$get_term_id    = $terms[0]->term_id;
			$get_term_slug  = $terms[0]->slug;
			$get_term_name  = $terms[0]->name;

			// Display the tag name.
			echo '<li class="trail-item"><span>' . esc_html( $get_term_name ) . '</span></li>';

		} elseif ( is_day() ) {

			// Day archive.
			// Year link.
			echo '<li class="trail-item"><a class="item-year" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'suffice' ) ) ) ) . '" title="' . esc_attr( get_the_time( __( 'Y', 'suffice' ) ) ) . '"><span>' . esc_html( get_the_time( __( 'Y', 'suffice' ) ) ) . '</span></a></li>';

			// Month link.
			echo '<li class="trail-item"><a class="item-month" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'suffice' ) ), get_the_time( __( 'M', 'suffice' ) ) ) ) . '" title="' . esc_attr( get_the_time( __( 'M', 'suffice' ) ) ) . '"><span>' . esc_html( get_the_time( __( 'M', 'suffice' ) ) ) . '</span></a></li>';

			// Day display.
			echo '<li class="trail-item"><span>' . esc_html( get_the_time( __( 'jS', 'suffice' ) ) . get_the_time( __( 'M', 'suffice' ) ) ) . '</span></li>';

		} elseif ( is_month() ) {

			// Month Archive.
			// Year link.
			echo '<li class="trail-item"><a class="item-year" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'suffice' ) ) ) ) . '" title="' . esc_attr( get_the_time( __( 'Y', 'suffice' ) ) ) . '"><span>' . esc_html( get_the_time( __( 'Y', 'suffice' ) ) ) . '</span></a></li>';

			// Month link.
			echo '<li class="trail-item"><span>' . esc_html( get_the_time( __( 'M', 'suffice' ) ) ) . '</span></li>';

		} elseif ( is_year() ) {

			// Display year archive.
			echo '<li class="trail-item"><span>' . esc_html( get_the_time( __( 'Y', 'suffice' ) ) ) . '</span></li>';

		} elseif ( is_author() ) {

			// Auhor archive.
			// Get the author information.
			global $author;
			$userdata = get_userdata( $author );

			// Display author name.
			echo '<li class="trail-item"><span>' .  $userdata->display_name . '</span></li>';

		} elseif ( get_query_var( 'paged' ) ) {
			// Paginated archives.
			echo '<li class="trail-item"><span>' . esc_html__( 'Page', 'suffice' ) . esc_html( get_query_var( 'paged' ) ) . '</span></li>';

		} elseif ( is_search() ) {
			// Search results page.
			echo '<li class="trail-item"><span>' . esc_html__( 'Search results for: ', 'suffice' ) . esc_html( get_search_query() ) . '</span></li>';

		} elseif ( is_404() ) {
			// 404 page.
			echo '<li class="trail-item"><span>' . esc_html__( '404 Error', 'suffice' ) . '</span></li>';
		}

		echo '</ul>';

	}
}


if ( ! function_exists( 'suffice_page_title' ) ) {

	/**
	 * Title for page
	 *
	 * @since 1.0.0
	 */
	function suffice_page_title() {
		if ( is_archive() ) {
			$suffice_header_title = get_the_archive_title();
		} elseif ( is_404() ) {
			$suffice_header_title = esc_html__( 'Page NOT Found', 'suffice' );
		} elseif ( is_search() ) {
			$suffice_header_title  = sprintf( esc_html__( 'Search Results for: %s', 'suffice' ), esc_html( get_search_query() ) );
		} elseif ( is_singular() ) {
			$suffice_header_title = get_the_title();
		} elseif ( is_home() ) {
			$queried_id = get_option( 'page_for_posts' );
			$suffice_header_title = get_the_title( $queried_id );
		} else {
			$suffice_header_title = '';
		}

		echo '<div class="breadcrumbs-page">';
			echo '<h1 class="breadcrumbs-page-title">';
				echo $suffice_header_title;
			echo '</h1>';
		echo '</div> <!--.breadcrumbs-page-->';
	}
}


if ( ! function_exists( 'suffice_top_header_left_content' ) ) {

	/**
	 * Header top left content
	 *
	 * Displays content in left section of Top Header.
	 *
	 * @since 1.0.0
	 */
	function suffice_top_header_left_content() {

		$header_top_left_content = suffice_get_option( 'suffice_header_content_left', 'contact-info' );

		if ( 'contact-info' === $header_top_left_content ) {
			get_template_part( 'template-parts/header/contact', 'info' );
		} elseif ( 'social-icon' === $header_top_left_content ) {
			get_template_part( 'template-parts/header/social', 'icon' );
		}
	}
}


if ( ! function_exists( 'suffice_top_header_right_content' ) ) {

	/**
	 * Header top right content
	 *
	 * Displays content in right section of Top Header.
	 *
	 * @since 1.0.0
	 */
	function suffice_top_header_right_content() {
		$header_top_right_content = suffice_get_option( 'suffice_header_content_right', 'social-icon' );

		if ( 'social-icon' === $header_top_right_content ) {
			get_template_part( 'template-parts/header/social', 'icon' );
		} elseif ( 'contact-info' === $header_top_right_content ) {
			get_template_part( 'template-parts/header/contact', 'info' );
		}
	}
}


if ( ! function_exists( 'suffice_footer_copyright_text' ) ) {

	/**
	 * Displays the footer copyright text information
	 */
	function suffice_footer_copyright_text() {
		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="'.esc_url( 'https://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'suffice' ) . '"><span>' . __( 'WordPress', 'suffice' ) . '</span></a>';

		$tg_link =  '<a href="'.esc_url( 'https://themegrill.com/themes/suffice' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'suffice' ).'" rel="designer"><span>'.__( 'ThemeGrill', 'suffice') .'</span></a>';

		$default_footer_value = sprintf( __( 'Copyright %1$s %2$s. All rights reserved.', 'suffice' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Powered by %s.', 'suffice' ), $wp_link ).' '.sprintf( __( 'Theme: %1$s by %2$s.', 'suffice' ), 'Suffice', $tg_link );

		$suffice_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
		echo $suffice_footer_copyright;
	}
}
add_action( 'suffice_footer_copyright_text', 'suffice_footer_copyright_text', 10 );

if ( ! function_exists( 'suffice_excerpt_length' ) ) {

	/**
	 * Change the excerpt length
	 */
	function suffice_excerpt_length( $length ) {
		return 40;
	}

}
add_filter( 'excerpt_length', 'suffice_excerpt_length' );

if ( ! function_exists( 'suffice_continue_reading' ) ) {

	/**
	 * Returns a "Continue Reading" link for excerpts
	 */
	function suffice_continue_reading() {
		return '';
	}

}
add_filter( 'excerpt_more', 'suffice_continue_reading' );

add_action( 'tgmpa_register', 'suffice_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function suffice_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(

		// Include ThemeGrill Demo Importer as recommended
		array(
			'name'      => 'ThemeGrill Demo Importer',
			'slug'      => 'themegrill-demo-importer',
			'required'  => false,
		),

		// SiteOrigin Pagebuilder
		array(
			'name'      => 'SiteOrigin Pagebuilder',
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),

		// Suffice Toolkit
		array(
			'name'         => 'Suffice Toolkit', // The plugin name.
			'slug'         => 'suffice-toolkit', // The plugin slug (typically the folder name).
			'required'     => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'suffice',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'suffice' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'suffice' ),
			/* translators: %s: plugin name. */
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'suffice' ),
			/* translators: %s: plugin name. */
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'suffice' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'suffice' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'suffice'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'suffice'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'suffice'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'suffice'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'suffice'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'suffice'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'suffice'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'suffice'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'suffice'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'suffice' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'suffice' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'suffice' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'suffice' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'suffice' ),
			/* translators: 1: dashboard link. */
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'suffice' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'suffice' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'suffice' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'suffice' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );
}
