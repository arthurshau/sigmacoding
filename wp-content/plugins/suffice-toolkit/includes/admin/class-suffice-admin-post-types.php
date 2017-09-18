<?php
/**
 * Post Types Admin
 *
 * @class    ST_Admin_Post_Types
 * @version  1.1.0
 * @package  SufficeToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Admin_Post_Types Class
 *
 * Handles the edit posts views and some functionality on the edit post screen for ST post types.
 */
class ST_Admin_Post_Types {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_post_updated_messages' ), 10, 2 );

		// Edit post screens
		add_filter( 'enter_title_here', array( $this, 'enter_title_here' ), 1, 2 );
		add_filter( 'default_hidden_meta_boxes', array( $this, 'hidden_meta_boxes' ), 10, 2 );

		// Disable DFW feature pointer
		add_action( 'admin_footer', array( $this, 'disable_dfw_feature_pointer' ) );

		// Disable post type view mode options
		add_filter( 'view_mode_post_types', array( $this, 'disable_view_mode_options' ) );
	}

	/**
	 * Change messages when a post type is updated.
	 * @param  array $messages
	 * @return array
	 */
	public function post_updated_messages( $messages ) {
		global $post, $post_ID;

		$messages['portfolio'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __( 'Project updated. <a href="%s">View Project</a>', 'suffice-toolkit' ), esc_url( get_permalink( $post_ID ) ) ),
			2 => __( 'Custom field updated.', 'suffice-toolkit' ),
			3 => __( 'Custom field deleted.', 'suffice-toolkit' ),
			4 => __( 'Project updated.', 'suffice-toolkit' ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'suffice-toolkit' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __( 'Project published. <a href="%s">View Project</a>', 'suffice-toolkit' ), esc_url( get_permalink( $post_ID ) ) ),
			7 => __( 'Project saved.', 'suffice-toolkit' ),
			8 => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview project</a>', 'suffice-toolkit' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			9 => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'suffice-toolkit' ),
			  date_i18n( __( 'M j, Y @ G:i', 'suffice-toolkit' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
			10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'suffice-toolkit' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		);

		return $messages;
	}

	/**
	 * Specify custom bulk actions messages for different post types.
	 * @param  array $bulk_messages
	 * @param  array $bulk_counts
	 * @return array
	 */
	public function bulk_post_updated_messages( $bulk_messages, $bulk_counts ) {

		$bulk_messages['portfolio'] = array(
			'updated'   => _n( '%s project updated.', '%s projects updated.', $bulk_counts['updated'], 'suffice-toolkit' ),
			'locked'    => _n( '%s project not updated, somebody is editing it.', '%s projects not updated, somebody is editing them.', $bulk_counts['locked'], 'suffice-toolkit' ),
			'deleted'   => _n( '%s project permanently deleted.', '%s projects permanently deleted.', $bulk_counts['deleted'], 'suffice-toolkit' ),
			'trashed'   => _n( '%s project moved to the Trash.', '%s projects moved to the Trash.', $bulk_counts['trashed'], 'suffice-toolkit' ),
			'untrashed' => _n( '%s project restored from the Trash.', '%s projects restored from the Trash.', $bulk_counts['untrashed'], 'suffice-toolkit' ),
		);

		return $bulk_messages;
	}

	/**
	 * Change title boxes in admin.
	 * @param  string $text
	 * @param  object $post
	 * @return string
	 */
	public function enter_title_here( $text, $post ) {
		switch ( $post->post_type ) {
			case 'portfolio' :
				$text = __( 'Project name', 'suffice-toolkit' );
			break;
		}

		return $text;
	}

	/**
	 * Hidden default Meta-Boxes.
	 * @param  array  $hidden
	 * @param  object $screen
	 * @return array
	 */
	public function hidden_meta_boxes( $hidden, $screen ) {
		if ( 'portfolio' === $screen->post_type && 'post' === $screen->base ) {
			$hidden = array_merge( $hidden, array( 'postcustom' ) );
		}

		return $hidden;
	}

	/**
	 * Disable DFW feature pointer.
	 */
	public function disable_dfw_feature_pointer() {
		$screen = get_current_screen();

		if ( $screen && 'portfolio' === $screen->id && 'post' === $screen->base ) {
			remove_action( 'admin_print_footer_scripts', array( 'WP_Internal_Pointers', 'pointer_wp410_dfw' ) );
		}
	}

	/**
	 * Removes portfolio from the list of post types that support "View Mode" switching.
	 * View mode is seen on posts where you can switch between list or excerpt. Our post types don't support
	 * it, so we want to hide the useless UI from the screen options tab.
	 *
	 * @param  array $post_types Array of post types supporting view mode
	 * @return array             Array of post types supporting view mode, without portfolio
	 */
	public function disable_view_mode_options( $post_types ) {
		unset( $post_types['portfolio'] );
		return $post_types;
	}
}

new ST_Admin_Post_Types();
