<?php
/**
 * Layout Data
 *
 * Display the layout data meta box.
 *
 * @class    ST_Meta_Box_Layout_Data
 * @version  1.1.0
 * @package  SufficeToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Meta_Box_Layout_Data Class
 */
class ST_Meta_Box_Layout_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		wp_nonce_field( 'suffice_toolkit_save_data', 'suffice_toolkit_meta_nonce' );

		?>
		<ul class="layout_data">

			<?php
				do_action( 'suffice_toolkit_layout_data_start', $post->ID );

				// Layout
				suffice_toolkit_wp_select( array( 'id' => 'suffice_page_layout', 'class' => 'select side show_if_sidebar', 'label' => __( 'Layout Settings', 'suffice-toolkit' ), 'options' => array(
					'default-layout'    => __( 'Default Layout', 'suffice-toolkit' ),
					'left-sidebar'      => __( 'Left Sidebar', 'suffice-toolkit' ),
					'right-sidebar'     => __( 'Right Sidebar', 'suffice-toolkit' ),
					'full-width'        => __( 'Full Width', 'suffice-toolkit' ),
					'full-width-center' => __( 'Full Width Center', 'suffice-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Select the specific layout for this entry.', 'suffice-toolkit' ) ) );

				// Sidebar
				suffice_toolkit_wp_select( array( 'id' => 'suffice_sidebar', 'class' => 'select side', 'label' => __( 'Sidebar Settings', 'suffice-toolkit' ), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Choose a custom sidebar for this entry.', 'suffice-toolkit' ), 'options' => suffice_toolkit_get_sidebars( array( 'default' => 'Default Sidebar' ) ) ) );

				// Footer
				suffice_toolkit_wp_select( array( 'id' => 'suffice_footer', 'class' => 'select side', 'label' => __( 'Footer Settings', 'suffice-toolkit' ), 'options' => array(
					'default'     => __( 'Default Socket and Widgets', 'suffice-toolkit' ),
					'footer_both' => __( 'Both Socket and Widgets', 'suffice-toolkit' ),
					'widget_only' => __( 'Only Widgets (No Socket)', 'suffice-toolkit' ),
					'socket_only' => __( 'Only Socket (No Widgets)', 'suffice-toolkit' ),
					'footer_hide' => __( 'Hide Socket and Widgets', 'suffice-toolkit' )
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Display the socket and footer widgets?', 'suffice-toolkit' ) ) );

				// Header Transparency
				suffice_toolkit_wp_select( array( 'id' => 'suffice_transparency', 'class' => 'select side', 'label' => __( 'Header Transparency', 'suffice-toolkit' ), 'options' => array(
					'non-transparent' => __( 'No Transparency', 'suffice-toolkit' ),
					'transparent'     => __( 'Transparent Header', 'suffice-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Header transparency options on this page.', 'suffice-toolkit' ) ) );

				// Top Sidebar Position
				suffice_toolkit_wp_select( array( 'id' => 'suffice_top_sidebar_position', 'class' => 'select side', 'label' => __( 'Top Sidebar Position', 'suffice-toolkit' ), 'options' => array(
					'none'             => __( 'None', 'suffice-toolkit' ),
					'above_header'     => __( 'Above Header', 'suffice-toolkit' ),
					'below_header'     => __( 'Below Header', 'suffice-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Top Sidebar Position options on this page.', 'suffice-toolkit' ) ) );

				do_action( 'suffice_toolkit_layout_data_end', $post->ID );
			?>
		</ul>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		$layout_post_meta = array( 'suffice_layout', 'suffice_sidebar', 'suffice_footer', 'suffice_transparency', 'suffice_top_sidebar_position' );

		foreach ( $layout_post_meta as $post_meta ) {
			if ( isset( $_POST[ $post_meta ] ) ) {
				update_post_meta( $post_id, $post_meta, $_POST[ $post_meta ] );
			}
		}
	}
}
