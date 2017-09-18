<?php
/**
 * SufficeToolkit ST_AJAX
 *
 * AJAX Event Handler
 *
 * @class    ST_AJAX
 * @version  1.0.0
 * @package  SufficeToolkit/Classes
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_AJAX Class
 */
class ST_AJAX {

	/**
	 * Hooks in ajax handlers.
	 */
	public static function init() {
		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		// suffice_toolkit_EVENT => nopriv
		$ajax_events = array(
			'delete_custom_sidebar' => false,
			'rated'                 => false,
		);

		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( 'wp_ajax_suffice_toolkit_' . $ajax_event, array( __CLASS__, $ajax_event ) );

			if ( $nopriv ) {
				add_action( 'wp_ajax_nopriv_suffice_toolkit_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			}
		}
	}

	/**
	 * AJAX Delete Custom Sidebar on Widgets Page.
	 */
	public static function delete_custom_sidebar() {
		ob_start();

		check_ajax_referer( 'delete-custom-sidebar', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			die(-1);
		}

		$sidebar = suffice_clean( stripslashes( $_POST['sidebar'] ) );

		if ( ! empty( $sidebar ) ) {
			ST_Sidebars::remove_sidebar( $sidebar );
			wp_send_json_success( array( $sidebar ) );
		}

		die();
	}

	/**
	 * Triggered when clicking the rating footer.
	 */
	public static function rated() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die( -1 );
		}

		update_option( 'suffice_toolkit_admin_footer_text_rated', 1 );
		die();
	}
}

ST_AJAX::init();
