<?php
/**
 * Suffice Toolkit Admin.
 *
 * @class    ST_Admin
 * @version  1.0.0
 * @package  SufficeToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Admin Class
 */
class ST_Admin {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'current_screen', array( $this, 'conditional_includes' ) );
		add_action( 'admin_footer', 'suffice_toolkit_print_js', 25 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}

	/**
	 * Includes any classes we need within admin.
	 */
	public function includes() {
		include_once( dirname( __FILE__ ) . '/functions-suffice-admin.php' );
		include_once( dirname( __FILE__ ) . '/functions-suffice-meta-box.php' );
		include_once( dirname( __FILE__ ) . '/class-suffice-admin-notices.php' );
		include_once( dirname( __FILE__ ) . '/class-suffice-admin-assets.php' );
		include_once( dirname( __FILE__ ) . '/class-suffice-admin-post-types.php' );
	}

	/**
	 * Include admin files conditionally.
	 */
	public function conditional_includes() {
		if ( ! $screen = get_current_screen() ) {
			return;
		}

		switch ( $screen->id ) {
			case 'options-permalink' :
				include( 'class-suffice-admin-permalink-settings.php' );
		}
	}

	/**
	 * Change the admin footer text on Suffice Toolkit admin pages.
	 * @param  string $footer_text
	 * @return string
	 */
	public function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_options' ) || ! function_exists( 'suffice_toolkit_get_screen_ids' ) ) {
			return $footer_text;
		}
		$current_screen = get_current_screen();
		$ft_pages       = suffice_toolkit_get_screen_ids();

		// Check to make sure we're on a Suffice Toolkit admin page.
		if ( isset( $current_screen->id ) && apply_filters( 'suffice_toolkit_display_admin_footer_text', in_array( $current_screen->id, $ft_pages ) ) ) {
			// Change the footer text.
			if ( ! get_option( 'suffice_toolkit_admin_footer_text_rated' ) ) {
				$footer_text = sprintf( __( 'If you like <strong>Suffice Toolkit</strong> please leave us a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. A huge thanks in advance!', 'suffice-toolkit' ), '<a href="https://wordpress.org/support/view/plugin-reviews/suffice-toolkit?filter=5#postform" target="_blank" class="suffice-toolkit-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'suffice-toolkit' ) . '">', '</a>' );
				suffice_toolkit_enqueue_js( "
					jQuery( 'a.suffice-toolkit-rating-link' ).click( function() {
						jQuery.post( '" . ST()->ajax_url() . "', { action: 'suffice_toolkit_rated' } );
						jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
					});
				" );
			} else {
				$footer_text = __( 'Thank you for creating with Suffice Toolkit.', 'suffice-toolkit' );
			}
		}

		return $footer_text;
	}
}

new ST_Admin();
