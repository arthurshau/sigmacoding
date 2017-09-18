<?php
/**
 * SufficeToolkit Admin Assets.
 *
 * Load Admin Assets.
 *
 * @class    ST_Admin_Assets
 * @version  1.0.0
 * @package  SufficeToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Admin_Assets Class
 */
class ST_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'siteorigin_panel_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		global $wp_scripts;

		$screen         = get_current_screen();
		$screen_id      = $screen ? $screen->id : '';
		$jquery_version = isset( $wp_scripts->registered['jquery-ui-core']->ver ) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';

		// Register admin styles.
		wp_register_style( 'font-awesome', ST()->plugin_url() . '/assets/css/fontawesome.css', array(), '4.6.3' );
		wp_register_style( 'jquery-ui-style', '//code.jquery.com/ui/' . $jquery_version . '/themes/smoothness/jquery-ui.css', array(), $jquery_version );
		wp_register_style( 'suffice-toolkit-menu', ST()->plugin_url() . '/assets/css/menu.css', array(), ST_VERSION );
		wp_register_style( 'suffice-toolkit-admin', ST()->plugin_url() . '/assets/css/admin.css', array(), ST_VERSION );
		wp_register_style( 'suffice-toolkit-admin-widgets', ST()->plugin_url() . '/assets/css/widgets.css', array( 'font-awesome', 'wp-color-picker' ), ST_VERSION );

		// Sitewide menu CSS.
		wp_enqueue_style( 'suffice-toolkit-menu' );

		// Admin styles for ST pages only.
		if ( in_array( $screen_id, array( $screen_id, suffice_toolkit_get_screen_ids() ) ) ) {
			wp_enqueue_style( 'suffice-toolkit-admin' );
			wp_enqueue_style( 'jquery-ui-style' );
		}

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_style( 'suffice-toolkit-admin-widgets' );
		}
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_scripts() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';
		$suffix    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register admin scripts.
		wp_register_script( 'suffice-toolkit-admin', ST()->plugin_url() . '/assets/js/admin/admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip' ), ST_VERSION );
		wp_register_script( 'suffice-toolkit-admin-widgets', ST()->plugin_url() . '/assets/js/admin/widgets' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-util', 'underscore', 'backbone', 'suffice-enhanced-select', 'wp-color-picker' ), ST_VERSION );
		wp_register_script( 'suffice-toolkit-admin-sidebars', ST()->plugin_url() . '/assets/js/admin/sidebars' . $suffix . '.js', array( 'jquery' ), ST_VERSION );
		wp_register_script( 'jquery-tiptip', ST()->plugin_url() . '/assets/js/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), ST_VERSION, true );
		wp_register_script( 'select2', ST()->plugin_url() . '/assets/js/select2/select2' . $suffix . '.js', array( 'jquery' ), '4.0.3' );
		wp_register_script( 'suffice-enhanced-select', ST()->plugin_url() . '/assets/js/admin/enhanced-select' . $suffix . '.js', array( 'jquery', 'select2' ), ST_VERSION );
		wp_localize_script( 'suffice-enhanced-select', 'suffice_enhanced_select_params', array(
			'i18n_matches_1'            => _x( 'One result is available, press enter to select it.', 'enhanced select', 'suffice-toolkit' ),
			'i18n_matches_n'            => _x( '%qty% results are available, use up and down arrow keys to navigate.', 'enhanced select', 'suffice-toolkit' ),
			'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'suffice-toolkit' ),
			'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'suffice-toolkit' ),
			'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'suffice-toolkit' ),
			'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'suffice-toolkit' ),
			'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'suffice-toolkit' ),
			'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'suffice-toolkit' ),
			'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'suffice-toolkit' ),
			'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'suffice-toolkit' ),
			'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'suffice-toolkit' ),
			'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'suffice-toolkit' )
		) );
		wp_localize_script( 'suffice-toolkit-admin-widgets', 'sufficeToolkitLocalizeScript', array(
			'i18n_max_field_entries' => apply_filters( 'suffice_toolkit_maximum_repeater_field_entries', 5 ),
			'i18n_max_field_message' => esc_js( sprintf( __( 'You can add upto %s fields.', 'suffice-toolkit' ), apply_filters( 'suffice_toolkit_maximum_repeater_field_entries', 5 ) ) ),
		) );

		// SufficeToolkit admin pages.
		if ( in_array( $screen_id, suffice_toolkit_get_screen_ids() ) ) {
			wp_enqueue_script( 'suffice-toolkit-admin' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_media();
			wp_enqueue_script( 'suffice-toolkit-admin-widgets' );

			if ( 'widgets' === $screen_id && is_suffice_pro_active() ) {
				wp_enqueue_script( 'suffice-toolkit-admin-sidebars' );
				wp_localize_script( 'suffice-toolkit-admin-sidebars',	'suffice_toolkit_admin_sidebars', array(
					'ajax_url'                           => admin_url( 'admin-ajax.php' ),
					'delete_custom_sidebar_nonce'        => wp_create_nonce( 'delete-custom-sidebar' ),
					'i18n_confirm_delete_custom_sidebar' => __( 'Delete this Sidebar Permanently and store all widgets in Inactive Sidebar. Are you positive you want to delete this Sidebar?', 'suffice-toolkit' ),
				) );
			}
		}
	}

	/**
	 * Enqueue siteorigin panel scripts.
	 */
	public function siteorigin_panel_scripts() {
		wp_enqueue_style( 'suffice-toolkit-admin-widgets' );
		wp_enqueue_script( 'suffice-toolkit-admin-widgets' );
	}
}

new ST_Admin_Assets();
